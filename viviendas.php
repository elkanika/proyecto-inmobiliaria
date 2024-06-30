<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viviendas</title>

    <SCRIPT LANGUAGE='JavaScript'>
        <!--
        function actualizaPagina() {
          // Obtener el índice de la opción seleccionada en el formulario
          i = document.forms.selecciona.zona.selectedIndex;
         // Obtener el valor de la zona seleccionada
           zona = document.forms.selecciona.zona.options[i].value;
           // Redireccionar a la misma página con la zona seleccionada como parámetro
            window.location = 'viviendas.php?zona=' + zona;
         }
         // -->
         </SCRIPT>
</head>
<body>
<h1 style="color: rgb(48, 118, 248);">Consulta de viviendas</h1>

<?php 
include 'db_config.php'; 

echo "<table class='tabla-viviendas'>";

echo ("<FORM NAME='selecciona' ACTION='viviendas.php' METHOD='POST'>\n");
echo ("<P>Mostrar viviendas de la zona:\n");
echo ("<SELECT NAME='zona' ONCHANGE='actualizaPagina()'>\n");
  // Obtener las zonas disponibles de la base de datos
  $instruccion = "SELECT DISTINCT zona FROM viviendas";
  $consulta = mysqli_query($conn, $instruccion) or die("Fallo en la consulta");

  $zona = $_REQUEST['zona'];
if (isset($zona))
   $selected = $zona;
else
   $selected = "Todas";
while ($row = mysqli_fetch_array($consulta)) {
   $zona_db = $row['zona'];
   if ($zona_db == $selected)
   echo ("   <OPTION VALUE='$zona_db' SELECTED>$zona_db\n");
   else
   echo ("   <OPTION VALUE='$zona_db'>$zona_db\n");
}

echo ("</SELECT></P>\n");
echo ("</FORM>\n");

// Construir la consulta a la base de datos
$instruccion = "SELECT * FROM viviendas";
if (isset($zona) && $zona != "Todas")
   $instruccion = $instruccion . " WHERE zona ='$zona'";
$instruccion = $instruccion . " ORDER BY id ASC";

// Realizar la consulta a la base de datos
    $consulta = mysqli_query($conn, $instruccion) or die("Fallo en la consulta");

    $nfilas = mysqli_num_rows($consulta);
if ($nfilas > 0) {
   echo ("<TR>\n");
   echo ("<TH>Tipo</TH>\n");
   echo ("<TH>Zona</TH>\n");
   echo ("<TH>Dirección</TH>\n");
   echo ("<TH>Número de dormitorios</TH>\n");
   echo ("<TH>Precio</TH>\n");
   echo ("<TH>Tamaño</TH>\n");
   echo ("<TH>Extras</TH>\n");
   echo ("<TH>Foto</TH>\n");
   echo ("<TH>Observaciones</TH>\n");
   echo ("<TH>Detalles</TH>\n");
   echo ("</TR>\n");

   while ($resultado = mysqli_fetch_array($consulta)) {
      echo ("<TR>\n");
      echo ("<TD>" . $resultado['tipo'] . "</TD>\n");
      echo ("<TD>" . $resultado['zona'] . "</TD>\n");
      echo ("<TD>" . $resultado['direccion'] . "</TD>\n");
      echo ("<TD>" . $resultado['ndormitorios'] . "</TD>\n");
      echo ("<TD>" . $resultado['precio'] . "</TD>\n");
      echo ("<TD>" . $resultado['tamano'] . "</TD>\n");
      echo ("<TD>" . $resultado['extras'] . "</TD>\n");
      // Mostrar la imagen con la ruta completa
      echo ("<TD><img src='uploads/" . $resultado['foto'] . "' alt='Foto de la vivienda'><br>" . $resultado['foto'] . "</TD>\n");                                                                                        
      echo ("<TD>" . $resultado['observaciones'] . "</TD>\n");
      echo ("<TD>" . '<a href="detalle.php?id=' . $resultado['id'] . '" class="btn btn-primary">Ver más detalles</a>' . "</TD>\n");
      echo ("</TR>\n");   
       }  
    } else                                                                                                      
    echo ("No hay viviendas disponibles");    
?>
<a href="dashboard.html">Volver al inicio</a>
</body>
</html>
