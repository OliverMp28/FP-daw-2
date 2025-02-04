<?php
	require_once "./config.php";


    // empezar a hacer la funciones

	/**
	 * Validar una apikey
	 */
	function validarApiKey($apiKeysValidos) {
		//estos son los headers que envia el cliente y la usamos para verificar la apikey
		$headers = getallheaders();

		if (!isset($headers['X-API-KEY'])) {
			http_response_code(403);
			echo json_encode(["error" => "Acceso no autorizado: No hay API Key "]);
			die();
		}

		$apiKeyEnviada = $headers['X-API-KEY'];
		
		if (!in_array($apiKeyEnviada, $apiKeysValidos)) {
			http_response_code(403);
			echo json_encode(["error" => "Acceso no autorizado: API Key invalida"]);
			die();
		}
	}
	

	//---------------------------------------------------------------
	//--------------------Funciones de GET --------------------------
	//---------------------------------------------------------------
	function obtenerProducto($conexion, $id_producto){
		global $tabla_productos;
		global $RUTA_API;

		$consulta = "SELECT * FROM {$tabla_productos} WHERE id = ?";
		$sentencia=$conexion->prepare($consulta);
		$sentencia->bind_param("i", $id_producto);
		$sentencia->execute();

		$resultado=$sentencia->get_result();
		if($resultado->num_rows==1){
			$datos=[];
			while($fila=$resultado->fetch_assoc()){
				$datos=[
                    "id"=>$fila["id"],
                    "nombre"=>$fila["nombre"],
                    "descripcion"=>$fila["descripcion"],
                    "precio"=>$fila["precio"],
					"stock"=>$fila["stock"],
					"categoria"=>$fila["categoria"],
					"imagen"=>$RUTA_API . $fila["imagen"],
					"fecha_creacion"=>$fila["fecha_creacion"]
                ];
			}

			$salida["http"]=200;
			$salida["respuesta"]=["datos"=>$datos];
		}else{
			$salida["http"]=404;
			$salida["respuesta"]=["error"=>"No se encuentra el producto"];
		}
		$sentencia->close();

		return $salida;
	}
	

	/**
	 * Esta funcion me obtiene los productos paginados, 
	 * tiene parametros adicionales como nombre, categoria y precios minimos y maximos
	 * estos parametros por defecto son null pero si se le pasan estos datos
	 * entonces la funcion filtra por el concepto que pusiste, por ejemplo filtrado por nombre
	 *
	 */
	function obtenerProductosPag($conexion, $pagina, $limite, $nombre=null, $precioMin=null, $precioMax=null, $categoria=null){
		global $tabla_productos;
		global $RUTA_API;

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
					"imagen"=>$RUTA_API . $fila["imagen"],
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
		global $RUTA_API;
	
		// Procesar imagen
		$rutaImagen = null;
		if ($imagen && $imagen['error'] === UPLOAD_ERR_OK) {
			// Crear directorio si no existe
			$directorioImagenes = './img/';
			if (!file_exists($directorioImagenes)) {
				mkdir($directorioImagenes, 0755, true);
			}
	
			// Generar nombre único seguro
			$nombreArchivo = time() . "_" . str_replace(' ', '_', $imagen['name']);
			$rutaGuardado = $directorioImagenes . $nombreArchivo;
	
			if (!move_uploaded_file($imagen['tmp_name'], $rutaGuardado)) {
				return [
					"http" => 500,
					"respuesta" => ["error" => "Error al guardar la imagen"]
				];
			}
	
			$rutaImagen = '/img/' . $nombreArchivo;
		}
	
		// Antes de bind_param(), define las variables
		$nombre = $datos['nombre'];
		$descripcion = $datos['descripcion'] ?? null;
		$precio = $datos['precio'];
		$stock = $datos['stock'];
		$categoria = $datos['categoria'] ?? null;
		$urlImagen = $rutaImagen;
		
		
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
	
		//con "->insert_id" obtengo la nueva id generada para el nuevo producto creado
		$nuevoId = $conexion->insert_id;
	
		return [
			"http" => 201,
			"respuesta" => [
				"mensaje" => "Producto creado exitosamente",
				"id" => $nuevoId,
				"imagen_url" => $rutaImagen ? $RUTA_API . $rutaImagen : null
			]
		];
	}


	/**
	 * Comprueba si existe o no un producto con el nombre seleccionado, devuelve true o false.
	 * Si se le pasa una id, es por que queremos que en la comprobacion de nombre se compruebe todo
	 * excepto el producto con esa id, esto lo uso para actualizar un producto
	 * ya que al actualizar un producto compruebo que el nombre no exita pero no compruebo el nombre del producto
	 * que se esta actualizando ya que ese nuevo nombre ira en ese producto.
	 */
	function existeProductoConEsteNombre($conexion, $nombre, $idExcluir = null) {
		global $tabla_productos;
	
		$sentencia = "SELECT COUNT(*) FROM $tabla_productos WHERE nombre = ?";
		if ($idExcluir !== null) {
			$sentencia .= " AND id != ?";
		}
	
		$sentencia = $conexion->prepare($sentencia);
		if (!$sentencia) {
			return false;
		}
	
		if ($idExcluir !== null) {
			$sentencia->bind_param("si", $nombre, $idExcluir);
		} else {
			$sentencia->bind_param("s", $nombre);
		}
	
		$count = 0;
		$sentencia->execute();
		$sentencia->bind_result($count);
		$sentencia->fetch();
		$sentencia->close();
	
		return $count > 0;
	}
	


	//---------------------------------------------------------------
	//--------------------Funciones de PUT--------------------------
	//---------------------------------------------------------------
	
	function actualizarProducto($conexion, $id, $campos) {
		global $tabla_productos;
	
		//verifico si el producto existe
		$productoExistente = obtenerProducto($conexion, $id);
		if ($productoExistente["http"] !== 200) {
			return [
				"http" => 404,
				"respuesta" => ["error" => "Producto no encontrado"]
			];
		}
	
		//Valido la unicidad del nombre(si se actualiza)
		if (isset($campos['nombre'])) {
			if (existeProductoConEsteNombre($conexion, $campos['nombre'], $id)) {
				return [
					"http" => 409,
					"respuesta" => ["error" => "Ya existe un producto con este nombre"]
				];
			}
		}
	
		//empiezo la consulta
		$set = [];
		$tipos = '';
		$valores = [];
	
		foreach ($campos as $campo => $valor) {
			$set[] = "$campo = ?";
			$tipos .= obtenerTipoDato($campo, $valor);
			$valores[] = $valor;
		}
	
		$consulta = "UPDATE $tabla_productos SET " . implode(', ', $set) . " WHERE id = ?";
		$tipos .= 'i';
		$valores[] = $id;
	
		// 4. Ejecutar la actualización
		$sentencia = $conexion->prepare($consulta);
		$sentencia->bind_param($tipos, ...$valores);
	
		if (!$sentencia->execute()) {
			return [
				"http" => 500,
				"respuesta" => ["error" => "Error al actualizar el producto: " . $conexion->error]
			];
		}
	
		// 5. Obtener el producto actualizado
		$productoActualizado = obtenerProducto($conexion, $id);
		return [
			"http" => 200,
			"respuesta" => [
				"mensaje" => "Producto actualizado exitosamente",
				"datos" => $productoActualizado["respuesta"]["datos"]
			]
		];
	}

	
	/**
	 * Esto lo uso para comprobar los tipos de datos
	 */
	function obtenerTipoDato($campo, $valor) {
		switch ($campo) {
			case 'precio':
				return 'd';
			case 'stock':
				return 'i';
			default:
				return 's';
		}
	}

	/**
	 * recorre la entrada y devuelve un arreglo con los campos permitidos para actualizar.
	 *
	 * @return array  con los campos a actualizar.
	 */
	function obtenerCamposActualizar($entrada, $camposPermitidos) {
		$camposActualizar = [];
		foreach ($camposPermitidos as $campo) {
			if (isset($entrada[$campo])) {
				$camposActualizar[$campo] = $entrada[$campo];
			}
		}
		return $camposActualizar;
	}


	//---------------------------------------------------------------
	//--------------------Funciones de DELETE------------------------
	//---------------------------------------------------------------

	function eliminarProducto($conexion, $id) {
		global $tabla_productos;
		global $RUTA_API; 
	
		// Verificar si el producto existe
		$productoExistente = obtenerProducto($conexion, $id);
		if ($productoExistente["http"] !== 200) {
			return [
				"http" => 404,
				"respuesta" => ["error" => "Producto no encontrado"]
			];
		}
	
		// quita la imagen del servidor si existe
		if (!empty($productoExistente["respuesta"]["datos"]["imagen"])) {
			$rutaImagen = $productoExistente["respuesta"]["datos"]["imagen"];
			// Eliminar la parte de la URL base para obtener la ruta relativa
			$rutaRelativa = str_replace($RUTA_API, '', $rutaImagen);
			$rutaRelativa = ltrim($rutaRelativa, '/');
			
			// Verificar y eliminar el archivo utilizando la ruta relativa
			if (file_exists($rutaRelativa)) {
				unlink($rutaRelativa);
			} else {
				error_log("No se encontró el archivo para eliminar: " . $rutaRelativa);
			}
		}
	
		// Preparar y ejecutar la consulta DELETE en la base de datos
		$consulta = "DELETE FROM $tabla_productos WHERE id = ?";
		$sentencia = $conexion->prepare($consulta);
		$sentencia->bind_param("i", $id);
	
		if (!$sentencia->execute()) {
			return [
				"http" => 500,
				"respuesta" => ["error" => "Error al eliminar el producto: " . $conexion->error]
			];
		}
	
		return [
			"http" => 200,
			"respuesta" => ["mensaje" => "Producto eliminado exitosamente"]
		];
	}
	
	
	