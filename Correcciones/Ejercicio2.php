<?php
    define("PATRONNOMBRE", '/^[A-Z][a-z]{2,}\s[A-Z][a-z]{2,}\s[A-Z][a-z]{2,}$/');
    define("PATRONEXPEDIENTE", '/^[0-9]{2}[A-Z]{3}\/[0-9]{2}$/');

    function enviado()
    {
        if(isset($_REQUEST["Enviado"]))
            return true;
        return false;    
    }

    function vacio($texto)
    {
        if(enviado())
            if(empty($_REQUEST[$texto]))
                return true;
            return false;    
    }

    function select()
    {
        if(enviado())
            if($_REQUEST["curso"]==no)
                return true;
            else
                return false;    
    }

    

?>