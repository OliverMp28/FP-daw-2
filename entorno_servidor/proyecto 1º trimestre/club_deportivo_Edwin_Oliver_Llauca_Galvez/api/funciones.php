<?php
	require_once "./config.php";


    // empezar a hacer la funciones

	
	function obtenerProducto($conexion, $id_producto){
		global $tabla_productos;

		$consulta = "SELECT * FROM {$tabla_productos} WHERE id = ?";
		$sentencia=$conexion->prepare($consulta);
		$sentencia->bind_param("i", $id_producto);
		$sentencia->execute();

		$resultado=$sentencia->get_result();
		if($resultado->num_rows==1){
			$producto=$resultado->fetch_assoc();
			$salida["http"]=200;
			$salida["respuesta"]=["datos"=>$producto];
		}else{
			$salida["http"]=404;
			$salida["respuesta"]=["error"=>"No se encuentra el producto"];
		}
		$sentencia->close();

		return $salida;
	}
	
	function obtenerProductosPag($conexion, $pagina, $limite, $nombre=null, $precioMin=null, $precioMax=null, $categoria=null){
		global $tabla_productos;

		$offset=($pagina-1)*$limite;

		// Construir consulta dinámica
		$where = [];
		$params = [];
		$types = '';
	
		//filtros
		if ($nombre !== null) {
			$where[] = "nombre LIKE ?";
			$params[] = "%$nombre%";
			$types .= 's';
		}
	
		if ($precioMin !== null && $precioMax !== null) {
			$where[] = "precio BETWEEN ? AND ?";
			$params[] = $precioMin;
			$params[] = $precioMax;
			$types .= 'dd';
		} elseif ($precioMin !== null) {
			$where[] = "precio >= ?";
			$params[] = $precioMin;
			$types .= 'd';
		} elseif ($precioMax !== null) {
			$where[] = "precio <= ?";
			$params[] = $precioMax;
			$types .= 'd';
		}

		if ($categoria !== null) {
			$where[] = "categoria = ?";
			$params[] = $categoria;
			$types .= 's';
		}
	
		$whereClause = empty($where) ? '' : 'WHERE ' . implode(' AND ', $where);
	
		$consulta = "SELECT * FROM $tabla_productos $whereClause LIMIT ? OFFSET ?";
		$params[] = $limite;
		$params[] = $offset;

		$consultaTotal = "SELECT COUNT(*) FROM $tabla_productos $whereClause";

		$sentencia = $conexion->prepare($consulta);
		if (!empty($params)) {
			$sentencia->bind_param($types . "ii", ...$params);
		}
		$sentencia->execute();
		$resultado = $sentencia->get_result();



		if($resultado->num_rows>0){
			$datos=[];
			while($fila=$resultado->fetch_assoc()){
				$datos[]=[
                    "id"=>$fila["id"],
                    "nombre"=>$fila["nombre"],
                    "descripcion"=>$fila["descripcion"],
                    "precio"=>$fila["precio"],
					"stock"=>$fila["stock"],
					"categoria"=>$fila["categoria"],
					"imagen"=>$fila["imagen"],
					"fecha_creacion"=>$fila["fecha_creacion"]
                ];
			}

			// Calcular total con filtros
        $sentenciaTotal = $conexion->prepare($consultaTotal);
        if (!empty($params)) {
			//se quitan los 2 ultimos parametros antes de consultar, en este caso se estarian quitando el limit y el offset ya que solo quiero contar no paginar
			
			array_pop($params);
            array_pop($params);
			
			if(!empty($types)){
				$sentenciaTotal->bind_param($types, ...$params);
			}
        }
        $sentenciaTotal->execute();
        $total = $sentenciaTotal->get_result()->fetch_row()[0];

        $salida["http"] = 200;
        $salida["respuesta"] = [
								"datos" => $datos,
								"paginacion" => [
									"actual" => $pagina,
									"limite" => $limite,
									"total" => $total,
									"paginas" => ceil($total / $limite)
								]
							];
		}else{
			$salida["http"]=404;
            $salida["respuesta"]=["error"=>"No hay productos encontrados"];
		}

		$sentencia->close();
		return $salida;
	}


	//---------------------------------------------------------------
	//--------------------Funciones de POST--------------------------
	//---------------------------------------------------------------
	/**
	 * Crea un producto, la descripcion, categoria y la imagen son opcionales
	 */
	function crearProducto($conexion, $datos, $imagen = null) {
		global $tabla_productos;
	
		// Procesar imagen
		$rutaImagen = null;
		if ($imagen && $imagen['error'] === UPLOAD_ERR_OK) {
			// Crear directorio si no existe
			$directorioImagenes = './img/';
			if (!file_exists($directorioImagenes)) {
				mkdir($directorioImagenes, 0755, true);
			}
	
			// Generar nombre único seguro
			$nombreArchivo = time() . "_" . $imagen['name'];
			$rutaGuardado = $directorioImagenes . $nombreArchivo;
	
			if (!move_uploaded_file($imagen['tmp_name'], $rutaGuardado)) {
				return [
					"http" => 500,
					"respuesta" => ["error" => "Error al guardar la imagen"]
				];
			}
	
			$rutaImagen = 'img/' . $nombreArchivo;
		}
	
		// Antes de bind_param(), define las variables
		$nombre = $datos['nombre'];
		$descripcion = $datos['descripcion'] ?? null;
		$precio = $datos['precio'];
		$stock = $datos['stock'];
		$categoria = $datos['categoria'] ?? null;
		if($rutaImagen != null){
			$urlImagen = "http://localhost/FP%20daw%202/entorno_servidor/proyecto%201%c2%ba%20trimestre/club_deportivo_Edwin_Oliver_Llauca_Galvez/api/" . $rutaImagen;
		}else{
			$urlImagen = $rutaImagen;
		}
		
		
		// Insertar en BD
		$consulta = "INSERT INTO $tabla_productos (
			nombre, 
			descripcion, 
			precio, 
			stock, 
			categoria, 
			imagen
		) VALUES (?, ?, ?, ?, ?, ?)";


		$sentencia = $conexion->prepare($consulta);
		$sentencia->bind_param(
			"ssdiss",
			$nombre,
			$descripcion,
			$precio,
			$stock,
			$categoria,
			$urlImagen
		);
	
		$existeNombre = existeProductoConEsteNombre($conexion, $nombre);
		if($existeNombre){
			return [
				"http" => 409,
				"respuesta" => ["error" => "Ya existe un producto con este nombre"]
			];
		}
		if (!$sentencia->execute()) {
			return [
				"http" => 500,
				"respuesta" => ["error" => "Error al crear el producto: " . $sentencia->error]
			];
		}
	
		// Obtener el ID del nuevo producto
		$nuevoId = $conexion->insert_id;
	
		return [
			"http" => 201,
			"respuesta" => [
				"mensaje" => "Producto creado exitosamente",
				"id" => $nuevoId,
				"imagen_url" => $rutaImagen ? "http://localhost/FP%20daw%202/entorno_servidor/proyecto%201%c2%ba%20trimestre/club_deportivo_Edwin_Oliver_Llauca_Galvez/api/" . $rutaImagen : null
			]
		];
	}


	/**
	 * SComprueba si existe o no un producto con el nombre seleccionado, devuelve true o false
	 */
	function existeProductoConEsteNombre($conexion, $nombre) {
		global $tabla_productos;
	
		$sql = "SELECT COUNT(*) FROM $tabla_productos WHERE nombre = ?";
		$sentencia = $conexion->prepare($sql);
		
		$count = 0;
		if ($sentencia) {
			$sentencia->bind_param("s", $nombre);
			$sentencia->execute();
			$sentencia->bind_result($count);
			$sentencia->fetch();
			$sentencia->close();
	
			return $count > 0;
		} else {
			return false;
		}
	}
	





	function obtenerAsignaturasPag($conexion,$pagina,$limite){
		global $tabla_asignaturas;

		$offset=($pagina-1)*$limite;
		$consulta="SELECT * FROM $tabla_asignaturas 
		           LIMIT ? OFFSET ?";
		$sentencia=$conexion->prepare($consulta);
		$sentencia->bind_param("ii",$limite,$offset);
		$sentencia->execute();
		$resultado=$sentencia->get_result();
		if($resultado->num_rows>0){
			$datos=[];
			while($fila=$resultado->fetch_assoc()){
				$datos[]=[
					"id_asignatura"=>$fila["id_asignatura"],
					"nombre_asignatura"=>$fila["nombre_asignatura"],
					"creditos"=>$fila["creditos"]
				];
			}

			$consulta="SELECT count(*) FROM $tabla_asignaturas";
			$resultado=$conexion->query($consulta);
			$fila=$resultado->fetch_row();
			$total=$fila[0];

			$salida["http"]=200;
			$salida["respuesta"]=["datos"=>$datos,
								  "paginacion"=>[
									"actual"=>$pagina,
									"limite"=>$limite,
									"total"=>$total,
									"paginas"=>ceil($total/$limite)
									// "anterior"=>null
									// "siguiente"=>"http://...api.php?page=3&limit=$limit"

								  ]	
								];
			$sentencia->close();
		}else{
			$salida["http"]=404;
			$salida["respuesta"]=["error"=>"No hay resultados"];
		}
		
		return $salida;
	}
?>