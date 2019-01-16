<!-- Format of Data Output
c000s000g000t086r000p000h53b10020 
It outputs 37 bytes per second, including the end CR/LF.
Data Parser:
c000：air direction, degree
s000：air speed(1 minute), 0.1 miles per hour
g000：air speed(5 minutes), 0.1 miles per hour
t086：temperature, Fahrenheit
r000：rainfall(1 hour), 0.01 inches
p000：rainfall(24 hours), 0.01 inches
h53：humidity,% (00％= 100)
b10020：atmosphere,0.1 hpa -->
<?php
include 'head.php';
?>
<body>
<?php
include "menu.php";
?>

<div class="container-fluid">
<div class="row ">
    <div class="col-12 page-header">
        <h1 class="center text-center">Insercción medidas de Sensores </h1>
    </div>
</div>
    <div class="row">
        
        <div class="col-md-12  md-auto">   
            <p>
            <?php
        include("conexion.php");
            /* comprobamos la conexión */
            if ($mysqli->connect_errno) { 
                echo '
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Oopsss...!</strong> La conexión no falló.
                </div>';
                exit();
                
            }else {
                echo '
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Enhorabuena!</strong> Todo ha ido genial.
                </div>';
                
            }
            ?>
            </p>
        
            
            <form action="carga.php" method="GET">
                <div class="form-group">
                    <label for="fecha" >Fecha actual de configuracion</label>
                    <?php //Establecer la información local en castellano de España
                        setlocale(LC_TIME,"es_ES");
                    // echo strftime("Hoy es %A y son las %H:%M");
                    ?>
                    <input type="text" name="fecha" value="<?php echo strftime("Hoy es %A y son las %H:%M"); ?>" class="form-control" disabled />
                    <small id="emailHelp" class="form-text text-muted text-center">Es la hora actual del sistema que guarda en BBDD</small>
                </div>
                <div class="row">
                   <!-- <div class="col-md-4">
                    <label for="id" >ID día </label>
                    <?php 
/*
                        echo "<div class='form-group'>";

                        $consulta = $mysqli->query("SELECT * FROM dia");
                        $filas = mysqli_num_rows($consulta);
                    
                        if ($filas > 0) {
                            //cargamos el valor y lo enviamos a la url
                            echo "<select id='id' name='id' class='form-control'>";
                      

                            while ($row1 = $consulta->fetch_array()) {
                            
                                echo "<option value='" . $row1["id"] . "'>" . $row1["id"] . "</option>";
                            }
                            echo "</select>";
                        }
                        else {
                            echo "<input type='text'  value=' no hay elementos' class='form-control' disabled=''>";
                        }

                    
                        echo "</div>";*/
                    ?>
                    <small id="emailHelp" class="form-text text-muted text-center">Por ser clave foranea de la tabla sensor ha de existir.</small>
                    
        
                
                        
                        
                    </div>
                    -->
                    <div class="col-md-4">
                         <script>
                            jQuery(document).ready(function($) {
                               
                                // Change es un evento que se ejecuta cada vez que se cambia el valor de un elemento (input, select, etc).
                                $('#tipocultivo').change(function(e) {
 
                                    $('#descripcion').html($('#tipocultivo option:selected').val());
                                    
                                });
                            });
                        </script>
                        <div class="form-group">
                            <label for="tipocultivo" >Tipo cultivo</label>
                            <div class='form-group'>
                                <select id='tipocultivo' name='tipocultivo' class='form-control'>
                                
                                            <option value='10'>germinacion</option>
                                            <option value='18'>crecimiento</option>
                                            <option value='12'>floracion</option>
                                            <option value='12'>personalizado</option>
                                </select>
                            </div>    
                        </div>
                        <small id="" class="form-text text-muted text-center">Va ha funcionar durante <strong><span id="descripcion"></span></strong> horas al día.</small>
                        
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="horaencendidoluz" >Hora encendido</label>
                            <input type='time' id='horaencendidoluz' name='horaencendidoluz'  class='form-control' placeholder='17:30' />
                            <small id="" class="form-text text-muted text-center">Hora que dará comienzo el clico de cultivo con sus características.</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="diadecomienzo" >Día de comienzo</label>
                            <input type='date' id='diadecomienzo' name='diadecomienzo'  class='form-control' placeholder='17:30' />
                            <small id="" class="form-text text-muted text-center">Por ser clave foranea de la tabla sensor ha de existir.</small>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="valor" ><span class="text-bold h2">Duración horas de luz</span></label>
                    <input type="numeric" name="valor"  class="form-control" placeholder="ejemplo de valor: 8.30 (horas)" required/>
                    
                </div>
                <div class="row">
                    
                    <div class="col-md-12 text-right" >
                        <input type="submit" value="Guardar medida" class="btn btn-primary mb-5" >

                    </div>
                </div>
            </form>
        </div>
    </div>
<div class="row">
        
        <div class="col ml-auto mt">
            <?php

            include("conexion.php");
                //////////////////////////////////////////// insertar ////////////////////////////////////////////

                //////////////////////////////////////////// consulta ////////////////////////////////////////////

            $consulta = $mysqli->query("SELECT * FROM dia ORDER BY id");
            $filas = mysqli_num_rows($consulta);

            if ($filas > 0) {
                echo "<table class='table table-striped'>";
                echo "<thead class='thead-dark'>";
                echo "<tr>";

                echo "<th scope='col'> id</th>";
                echo "<th scope='col'> tipo_cultivo</th>";
                echo "<th scope='col'> hora_encendido_luz</th>";
                echo "<th scope='col'> fecha</th>";

                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while ($row1 = $consulta->fetch_array()) {
                    echo "<tr>";
                    echo "<td>" . $row1['id'] . "</td>";
                    echo "<td>" . $row1['tipo_cultivo'] . "</td>";
                    echo "<td>" . $row1['2'] . "</td>";
                    echo "<td>" . $row1['3'] . "</td>";
                    echo "</tr>";

                }
                echo "</tbody>";
            } else {
                echo "<div class='alert alert-danger mt-5 fade show '>
                            <strong>Lo sentimos!</strong> no hay registros para mostrar.
                        </div>";
            }
            echo "</table>";

            ?>
        </div>
        
        </div>
</div>
</div>


</body>
</html>

