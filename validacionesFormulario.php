<?php

    define("PATRONNOMBRE", '/^[A-Z]{1}[a-z]{2,}\s[A-Z]{1}[a-z]{2,}\s[A-Z]{1}[a-z]{2,}$/');
    define("PATRONEXPEDIENTE", '/^[0-9]{2}[A-Z]{3}\/[0-9]{2}/');

    $array = array(
        "1DAM" => array("ENDE", "BD", "LM", "SI", "FOL"),
        "2DAM" => array("DI", "SGE", "ACDA", "EIE", "PSP"),
        "2DAW" => array("DWES", "DWEC", "DIW", "EIE")
    );


    function validarFormulario(){
        $bandera=true;
        if(isset($_REQUEST['Enviado']))
        {
            
            
            if(validarNombre()==true && validarExpediente()==true && validarDesplegable()==true)
            {
               $bandera=true;
   
                
            }   
            else{
                
                $bandera = false;
            }     
        } else
        {
            $bandera= false;
        }
        
        return $bandera;
    }

    function segunda()
    {
        $bandera=false;
        if(isset($_REQUEST['Enviado']))
        {
            if($_REQUEST['curso']=='1DAM' || $_REQUEST['curso']=='2DAM' || $_REQUEST['curso']=='2DAW')
            {
                $bandera=true;
            }      
        }
        return $bandera;
    }



    function recordarGenerico($var){
        if(!empty($_REQUEST[$var])&& isset($_REQUEST['Enviado']))
        {
            echo $_REQUEST[$var];        
        }
    }

    function comprobarGenerico($var){
        if(empty($_REQUEST[$var]) && isset($_REQUEST['Enviado'])){
            
            echo "<label>Debe haber un campo ".$var."</label>";
           
        }           
    }

    function expresionGenerico($patron, $var){
        
        $bandera=true;

        if(!empty($var) && isset($_REQUEST['Enviado']) && preg_match($patron, $var)==false)
        {
            $bandera=false;
        }

        return $bandera;
    }

    function validarNombre()
    {
        
        $bandera=true;
        if(!empty($_REQUEST['nombre']) && isset($_REQUEST['Enviado']) && expresionGenerico(PATRONNOMBRE, $_REQUEST['nombre'])==true)
        {
            $bandera=true;    
        }
        else
        {
            $bandera=false;
        }
        return $bandera;
    }

    function validarExpediente()
    {
        
        $bandera=true;
        if(!empty($_REQUEST['exp']) && isset($_REQUEST['Enviado']) && expresionGenerico(PATRONEXPEDIENTE, $_REQUEST['exp'])==true)
        {
            $bandera=true;    
        }
        else
        {
            $bandera=false;
        }
        return $bandera;
    }

    function comprobarSelect()
    {
        if(isset($_REQUEST['Enviado']))
         if($_REQUEST['curso']=='no'){
            
            echo "<label>Debe haber un campo Curso</label>";
        }           
    }

    function recordarSelect($var)
    {
        if(isset($_REQUEST['Enviado']) && !empty($_REQUEST['curso']) && $_REQUEST['curso']==$var)
        {
            echo "selected";
        }    
    }

    function validarDesplegable()
    {
        $bandera=true;
        
        if(($_REQUEST['curso']=='1DAM' || $_REQUEST['curso']=='2DAM' || $_REQUEST['curso']=='2DAW') && isset($_REQUEST['Enviado']))
        {
            $bandera=true; 
             
        }else
        {
            $bandera=false;
        }
    
        return $bandera;
    }

    function mostrarAsignaturas()
    {
        foreach ($array as $ciclo => $asignaturas) {
            if($ciclo==$_REQUEST['curso'])
            {
                foreach ($asignaturas as $key) {
                    echo $key, " ";
                }
            }
        }
    }


    function recordarChecks($var)
    {
        if(isset($_REQUEST['checks']) && isset($_REQUEST['Enviado']))
        {
            $arrayChecks=$_REQUEST['checks'];
            
            for ($i=0; $i < count($arrayChecks); $i++) { 
                if($arrayChecks[$i]==$var)
                {
                    echo "checked";
                }
            }
        }
    }


?>