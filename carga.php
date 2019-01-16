<?php
include 'head.php';
?>
<body>
<a href="javascript:history.go(-1);">Atras</a>
<?php
include "menu.php";
?>
    
    <div class="container">
        <div class="row">
        
        <div class="col ml-auto mt-5">
        <h1>Guardada consulta<small class="float-right"><a href="javascript:history.go(-1);" class="btn btn btn-primary">Atras</a></small></h1>
        <p>id = <?php echo $_REQUEST["id"]?></p>
        <p>tipo de cultivo= <?php echo $_REQUEST["tipocultivo"] ?></p>
        <p>horas de encendido de la luz= <?php echo $_REQUEST["horaencendidoluz"] ?></p>
        

    <p>&tipocultivo=germinacion&horaencendidoluz=8&valor=3</p>
    
            <?php
                
                include("conexion.php");
                //////////////////////////////////////////// insertar ////////////////////////////////////////////
                //INSERT INTO `dia` (`id`, `tipo_cultivo`, `hora_encendido_luz`, `fecha_comienzo`) VALUES (NULL, 'germinacion', '09.30', CURRENT_DATE());
                $query = "INSERT INTO `dia` (`id`, `tipo_cultivo`, `hora_encendido_luz`, `fecha_comienzo`) VALUES (NULL, 'germinacion', '09.30', CURRENT_DATE())";
                $mysqli->query($query);
                //////////////////////////////////////////// consulta ////////////////////////////////////////////

                $consulta = $mysqli->query("SELECT * FROM dia ORDER BY id");
                $filas = mysqli_num_rows($consulta);
                
                if($filas>0){
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
                        while($row1 = $consulta->fetch_array())
                        {
                            echo "<tr>";
                            echo "<td>".$row1['id']."</td>";
                            echo "<td>".$row1['tipo_cultivo']. "</td>"; 
                            echo "<td>".$row1['2']. "</td>"; 
                            echo "<td>".$row1['3']. "</td>"; 
                            echo "</tr>";
                            
                        }
                    echo "</tbody>";
                } else {
                    echo "<div class='alert alert-danger mt-5 '>
                            <strong>Lo sentimos!</strong> no hay registros para mostrar.
                        </div>";
                }
                echo "</table>";
            
            ?>
        </div>
        
        </div>
    </div>
</body>
</html>