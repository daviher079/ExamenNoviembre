<?php
    $ruta="./ips.xml";

    if(file_exists($ruta))
    {
        $xmlSimple = simplexml_load_file($ruta);

        $xml = dom_import_simplexml($xmlSimple)->ownerDocument;

        $xml->formatOutput = true;

        // Leo el xml
        // Leo las etiquetas ip
        $ips = $xml->getElementsByTagName("ip");

        // Boleano que indica si existe la ip
        $existeIP = false;

        // Por cada etiqueta imprimo sus datos
        foreach($ips as $valor)
        {
            echo "IP: " . $valor->nodeValue . "; Veces: " . $valor->getAttribute("veces") . "; fecha: " . $valor->getAttribute("fecha");

            // Si la ip se corresponde con la conexion -> suma 1 y pone la fecha
            if($_SERVER["REMOTE_ADDR"] == $valor->nodeValue)
            {
                $existeIP = true;
                $veces = $valor->getAttribute("veces") + 1;
                $valor->setAttribute("veces",$veces);
                $valor->setAttribute("fecha",date(DATE_RFC822));
            }

        }

        if(!$existeIP)
        {
            $raiz = $xml->firstChild;

            $conexion = $raiz->appendChild($xml->createElement("Conexion"));

            $ip = $xml->createElement("ip",$_SERVER["REMOTE_ADDR"]);
            $ip->setAttribute("veces",1);
        }



    }else
    {
        echo "No hay datos aun";

        $xml=new DOMDocument("1.0", "utf-8");

        $xml->formatOutput=true;

        $raiz=$xml->appendChild($xml->createElement("Conexiones"));
        $conexion=$raiz->appendChild($xml->createElement("Conexion"));

        $ip=$xml->createElement("ip", $_SERVER['REMOTE_ADDR']);
        $ip->setAttribute("veces",1);
        $ip->setAttribute("fecha", date(DATE_RFC2822));

        $conexion->appendChild($ip);

    }
    $xml->save($ruta);
?>