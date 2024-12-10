<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">	
	<title>Document</title>
</head>
<body>
<?php
	session_start();
	$id = session_id();
    $nombre = session_name();
	
	$id = session_id();
    $nombre = session_name();

	if(!isset($_SESSION["idioma"])){
		echo "No hay idioma, creandio sesion nueva...";
		$_SESSION["idioma"] = "Español";	
	}
	$idioma = $_SESSION["idioma"];


	echo "<table border>";
    echo "<tr><td> Id Sesión </td><td> $id </td></tr>";
    echo "<tr><td> Nombre Sesión </td><td> $nombre </td></tr>";
    echo "<tr><td> Idioma Sesión </td><td> $idioma </td></tr>";
    echo "</table>";
	
?>
<h1><a href="index.php">Volver</a></h1>
</body>
</html>