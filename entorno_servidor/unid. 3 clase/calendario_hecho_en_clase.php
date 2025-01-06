<html>
<body>
	<?php
		$mes[0][0]='Enero';
		$mes[0][1]=31;
		$mes[1][0]='Febrero';
		$mes[1][1]=28;
		$mes[2][0]='Marzo';
		$mes[2][1]=31;
		$mes[3][0]='Abril';
		$mes[3][1]=30;
		$mes[4][0]='Mayo';
		$mes[4][1]=31;
		$mes[5][0]='Junio';
		$mes[5][1]=30;
		$mes[6][0]='Julio';
		$mes[6][1]=31;
		$mes[7][0]='Agosto';
		$mes[7][1]=31;
		$mes[8][0]='Septiembre';
		$mes[8][1]=30;
		$mes[9][0]='Octubre';
		$mes[9][1]=31;
		$mes[10][0]='Noviembre';
		$mes[10][1]=30;
		$mes[11][0]='Diciembre';
		$mes[11][1]=31;
		
		
		$dia=1;
		
		//Empiezo el calendario
		
		for($m=0; $m<12; $m++)
		{
			echo $mes[$m][0];
			echo "<table border=1>";
			echo "<tr><td>Lunes</td><td>Martes</td><td>Miercoles</td><td>Jueves</td><td>Viernes</td><td>Sabado</td><td>Domingo</td></tr>";
			echo "<tr>";
			for($j=1; $j<$dia; $j++)
			{
				echo "<td></td>";
			}
			for ($i=1; $i<=$mes[$m][1]; $i++)
			{
				echo "<td>$i</td>";
				$dia++;
				if ($dia>7)
				{
					$dia=1;
					echo "</tr><tr>";
				}
			}
			
			echo "</tr></table>";
		}
	
	?>
</body>
</html>