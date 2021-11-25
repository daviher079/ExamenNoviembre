<!DOCTYPE html>

<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>
    <style>
        *,
        input {
            margin: 10px;
        }
    </style>
    <?php
    $array = array(
        "1DAM" => array("ENDE", "BD", "LM", "SI", "FOL"),
        "2DAM" => array("DI", "SGE", "ACDA", "EIE", "PSP"),
        "2DAW" => array("DWES", "DWEC", "DIW", "EIE")
    );

    require_once("./validacionesFormulario.php");

    if(validarFormulario())
    {
        
        if(segunda())
        {
            header('Location: mostrar.php?nombre='.$_REQUEST['nombre'].'&expediente'.$_REQUEST['exp'].'&curso'.$_REQUEST['curso'].'&asignaturas'.$_REQUEST['checks']);
        }
        
        
    }

    ?>
    <form action="./examen2.php" method="post">
        <label for="nombre">Nombre y apellidos:</label> <input type="text" name="nombre" id="nombre" value="<?php recordarGenerico("nombre")?>">
        <?php
            if(isset($_REQUEST['Enviado']) && expresionGenerico(PATRONNOMBRE, $_REQUEST['nombre'])==false)
            {
                echo"<label>El nombre introducido no es valido. Minimo 3 caracteres  Nnn Aaa Aaa</label><br>";
            }
            comprobarGenerico("nombre");
        ?>
        <br> <label for="exp">Expediente</label> <input type="text" name="exp" id="exp" value="<?php recordarGenerico("exp")?>">
        <?php
            if(isset($_REQUEST['Enviado']) && expresionGenerico(PATRONEXPEDIENTE, $_REQUEST['exp'])==false)
            {
                echo"<label>El expediente introducido no es valido. Ej. 00XXX/00 </label><br>";
            }
            comprobarGenerico("exp");
        ?>
        <br> <label for="curso">Curso:</label> 
        <select name="curso" id="curso">
            <option value="no" <?php recordarSelect("no")?>>Selecione una opcion</option>
            <?php
                foreach ($array as $key => $value) {
                    echo"<option value='".$key."'".recordarSelect($key).">".$key."</option>";
                }
            ?>
        </select>
        <br>
        <?php
            comprobarSelect();


            
                if(validarFormulario())
                {
                   echo" <label>Asignaturas</label>";
                    foreach ($array as $ciclo => $asignaturas) {
                        if($ciclo==$_REQUEST['curso'])
                        {
                            foreach ($asignaturas as $key) {
                                echo $key, " ";
                                
                                echo "<input type='checkbox' name='checks[]' id='".$key."' value='".$key."'".recordarChecks("check1").">";
                            }
                        }
                    }
                }
                
            
        ?>
        <br>
        


        <!--<input type="hidden" name="curso" value="">-->
        <br><input type="submit" name="Enviado" value="Enviar">
    </form>

                

</body>

</html>