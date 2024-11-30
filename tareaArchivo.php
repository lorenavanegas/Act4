
<?
	$cident=15;
	$cnomb=40;
	$cedad=3;
	
	$identificacion=$_POST['identificacion'];
		$nombre=$_POST['nombre'];
		$edad=$_POST['edad'];
		
		$carac_ident= strlen ($_POST['identificacion']);
		$carac_nom= strlen ($_POST['nombre']);
		$carac_edad= strlen ($_POST['edad']);
		
		if($carac_ident<=$cident){
			$difcid=$cident-$carac_ident;
			for($j=0;$j<$difcid;$j++){
				$identificacion .=" ";
			}
		}else{
			$error=1;
			echo "<script>alert('te faltan numeros');</script>";
		}
		
		if($carac_nom<=$cnomb){
			$difcnom=$cnomb-$carac_nom;
			for($j=0;$j<$difcnom;$j++){
				$nombre .=" ";
			}
		}else{
			$error=1;
			echo "<script>alert('La cantidad de caracteres de la Nombre no es valida');</script>";
		}
		
		if($carac_edad<=$cedad){
			$difcedad=$cedad-$carac_edad;
			for($j=0;$j<$difcedad;$j++){
				$cedad .=" ";
			}
		}else{
			$error=1;
			echo "<script>alert('La cantidad de caracteres de la Edad no es valida');</script>";
		}
	
	if($_POST['accion']=='Nuevo'){
		if($error!=1){
			$file = fopen("datos.txt", "a");
			fwrite($file, $identificacion.";".$nombre.";".$edad . PHP_EOL);
			fclose($file);
		}
		
	}
	
	if($_POST['accion']=='Guardar'){
		if($error!=1){
			$file = fopen("datos.txt", "r+");
			$acum_caracter=$_POST['acum_caracter'];
			fseek($file,$acum_caracter);
			fwrite($file, $identificacion.";".$nombre.";".$edad);
			fclose($file);
		}
	}
	
	if($_GET['accion']=='Eliminar'){
		if($error!=1){
			$file = fopen("datos.txt",'r');
			while(!feof($file)) { 
				$name = fgets($file);
				$lineas[] = $name;
			}
			fclose($file);

			
			unset($lineas[$_GET['pos']]);
			$lineas = array_values($lineas);
			// GUARDAMOS
			$file = fopen("datos.txt", "w");
			foreach( $lineas as $linea ) {
				fwrite( $file, $linea );
			} 
			fclose( $file );  
			
			echo "<script>location.href='tareaArchivo.php';</script>";
		}
	}
	
?>


<!DOCTYPE HTML>
<html>
    <head>
	<meta charset="UTF-8">
        <title>Personaje</title>
		
		
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css"></style>
       
      
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		
	
        <script type="text/javascript">
			$(function(){
			

            });//main

        </script>
		<style>
			thead{
				background-color: black;
				color: white;
			}
			thead th{
				color: white;
				text-align: center;
			}
			input{
				margin: 10px;
			}
			input {
				margin: 10px;
				background: transparent;
				border: solid 1px;
			}
			.fondalttabl{
				background-color: #c6d2fd;
			}
			td{
				font-weight: bold;
			}
		</style>
		<script>
			function eliminar(pos){
				if(confirm("Esta seguro que desea eliminar esta persona?")){
					location.href='tareaArchivo.php?accion=Eliminar&pos='+pos;
				}
			}
		</script>
    </head>
    <body>

		
		
        <div id="contenido" style='width:90%;float:none' class="container">
			
		
			
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<fieldset class="fieldset_rh">
						<legend>Personas</legend>
						<div class="datagrid">
							<form action="" method=post>
								<table align="center">
									<thead>
										
										<tr>
											<th>Editar</th>
											<th>Eliminar</th>
											<th>Identificacion</th>
											<th>Nombre</th>
											<th>Edad</th>
										</tr>
									</thead>
								
									<tbody id="tblbody">
									
										<?
											$file = fopen("datos.txt", "r");
											$i=0;
											$caracteres=0;
											while(!feof($file)) {
												
												$i++;
												$lineas=  fgets($file);
												$linea=explode(";",$lineas);
												if($i%2 == 0){
													$color="class=''";
												}else{
													$color="class='fondalttabl'";
												}
												$acumulado_caracter+=$caracteres;
												$caracteres= strlen ($lineas);
												
												
								
												if($linea[0]!=''){
													
												
											
										?>
										<form method="POST" action="">
										<tr <?echo $color;?>>
											<td>
												<input type="submit" name="accion"  value="Guardar">
												<input type="hidden" name="acum_caracter" value="<?echo $acumulado_caracter?>">
											</td>
											<td><input type="button" value="Eliminar" onclick="eliminar(<?echo $i-1;?>)"></td>
											<td><input type="text" name="identificacion" placeholder="Identificacion" value="<?echo trim($linea[0])?>"></td>
											<td><input type="text" name="nombre" placeholder="Nombre" value="<?echo trim($linea[1])?>"></td>
											<td><input type="text" name="edad" placeholder="Edad" value="<?echo trim($linea[2])?>">Años</td>
										</tr>
										</form>
										<?}}?>
										
										
										<form method="POST" action="">
										<tr style="background:#000000">
											<td><input type="submit" name="accion" value="Nuevo"></td>
											<td><input type="button" value="Eliminar"></td>
											<td><input type="text" name="identificacion" placeholder="Identificacion"></td>
											<td><input type="text" name="nombre" placeholder="Nombre"></td>
											<td><input type="number" name="edad" placeholder="Edad">Años</td>
										</tr>
										</form>
									</tbody>
								</table>
							</form>
						</div>
					</fieldset>
				</div>
			</div>
  
			
		</div>
      
        
    </body>
</html>

