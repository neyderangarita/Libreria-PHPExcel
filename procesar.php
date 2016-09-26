<?php
        /** Invocacion de Clases necesarias */
        require_once('Classes/PHPExcel.php');
        require_once('Classes/PHPExcel/Reader/Excel2007.php');
        /** Cargar el archivo al directorio **/
        copy( $_FILES['foto']['tmp_name'], $_FILES['foto']['name']);
        //echo "Archivo subido exitosamente";          
        $nombre = $_FILES['foto']['name'];

        if (file_exists ($nombre)) //validacion para saber si el archivo ya existe previamente
        {  
            /** Declaración de variables de mysql **/
            $tmpfname = $nombre;   
            $host = "localhost";
            $user = "root";
            $pw = "";
            $db = "encuestas";
            /** Conexión a mysql **/
            $con = mysql_connect($host,$user,$pw) or die("problemas al conectar");

            mysql_select_db($db, $con)  or die("problemas al conectar");
            /** Leer la inofrmación del archivo de excel **/
            	$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
                $excelObj = $excelReader->load($tmpfname);
				$sheetData = $excelObj->getSheetByName("Base1")->toArray(null,true,true,true);
				$escaped_values = array_map('mysql_real_escape_string', array_values($sheetData[5]));
				$values  = implode("', '", $escaped_values);
			/** Guardado en la base de datos  **/		
				$sql = "INSERT INTO base_1 (sicom, nombre_estacion, municipio, departamento, direccion1, telefono1, celular1, cargo, nombre, identificacion, celular2, correo, telefono2, ubicacion, ubicacion_via, TkGasNo1, TkGasNo2, TkGasNo3, TkGasNo4, TkGasNo5, TkGasNo6, TkGasNo7, TkGasNo8, TkGasNo9, TkDisNo1, TkDisNo2, TkDisNo3, TkDisNo4, TkDisNo5, TkDisNo6, TkDisNo7, TkDisNo8, TkDisNo9, SurtGasNo1, MangGasNo1, SurtGasNo2, MangGasNo2, SurtGasNo3, MangGasNo3, SurtGasNo4, MangGasNo4, SurtGasNo5, MangGasNo5, SurtGasNo6, MangGasNo6, SurtGasNo7, MangGasNo7, SurtGasNo8, MangGasNo8, SurtGasNo9, MangGasNo9, SurtDisNo1, MangDisNo1, SurtDisNo2, MangDisNo2, SurtDisNo3, MangDisNo3, SurtDisNo4, MangDisNo4, SurtDisNo5, MangDisNo5, SurtDisNo6, MangDisNo6, SurtDisNo7, MangDisNo7, SurtDisNo8, MangDisNo8, SurtDisNo9, MangDisNo9, Mayorista, GasCompra, GasCupo, DisCompra, DisCupo, OtroCompra, OtroCupo, Blanco1, Blanco2, Nota11, Nota12, Nota13, Nota14, CobmCont1, NomCont1, SecCont1, VolCont1, CobmCont2, NomCont2, SecCont2, VolCont2, CobmCont3, NomCont3, SecCont3, VolCont3, CobmCont4, NomCont4, SecCont4, VolCont4, CobmCont5, NomCont5, SecCont5, VolCont5, CobmCont6, NomCont6, SecCont6, VolCont6, CobmCont7, NomCont7, SecCont7, VolCont7, CobmCont8, NomCont8, SecCont8, VolCont8, CobmCont9, NomCont9, SecCont9, VolCont9, CobmCont10, NomCont10, SecCont10, VolCont10) 
					VALUES ('$values')";
				mysql_query("SET NAMES 'utf8'");
				$resultado = mysql_query($sql, $con);
				if (!$resultado) {
				    die('Consulta no válida: ' . mysql_error());
				}else{
					echo "Total de registros cargados: ".$resultado;
				}
				

			/**********************Base 2***************************/
            /** Leer la inofrmación del archivo de excel **/
            	$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
                $excelObj = $excelReader->load($tmpfname);

            //Guardado en la base de datos 
            for ($x=0; $x < 3; $x++) { 
                $inicio = 5;
                $aux = $inicio + $x;
                $rango = 'A'.$aux.':CX'.$aux;
                $sheetData = $excelObj->getSheetByName("Base2")->rangeToArray($rango);	
				$escaped_values = array_map('mysql_real_escape_string', array_values($sheetData[0]));	
				$values  = implode("', '", $escaped_values);

				$sql = "INSERT INTO base2 (visita, sicom, codigoenc, nombreenc, fecha, horaini, horafin, consacumgas, consacumdis, filamax, tkgasvolini1, tkgasvolfin1, tkgasvolini2, tkgasvolfin2, tkgasvolini3, tkgasvolfin3, tkgasvolini4, tkgasvolfin4, tkgasvolini5, tkgasvolfin5, tkgasvolini6, tkgasvolfin6, tkgasvolini7, tkgasvolfin7, tkgasvolini8, tkgasvolfin8, tkgasvolini9, tkgasvolfin9, tkdisvolini1, tkdisvolfin1, tkdisvolini2, tkdisvolfin2, tkdisvolini3, tkdisvolfin3, tkdisvolini4, tkdisvolfin4, tkdisvolini5, tkdisvolfin5, tkdisvolini6, tkdisvolfin6, tkdisvolini7, tkdisvolfin7, tkdisvolini8, tkdisvolfin8, tkdisvolini9, tkdisvolfin9, MangGasNo1, MangGasNo1ini, MangGasNo1fin, MangGasNo2, MangGasNo2ini, MangGasNo2fin, MangGasNo3, MangGasNo3ini, MangGasNo3fin, MangGasNo4, MangGasNo4ini, MangGasNo4fin, MangGasNo5, MangGasNo5ini, MangGasNo5fin, MangGasNo6, MangGasNo6ini, MangGasNo6fin, MangGasNo7, MangGasNo7ini, MangGasNo7fin, MangGasNo8, MangGasNo8ini, MangGasNo8fin, MangGasNo9, MangGasNo9ini, MangGasNo9fin, MangdisNo1, MangdisNo1ini, MangdisNo1fin, MangdisNo2, MangdisNo2ini, MangdisNo2fin, MangdisNo3, MangdisNo3ini, MangdisNo3fin, MangdisNo4, MangdisNo4ini, MangdisNo4fin, MangdisNo5, MangdisNo5ini, MangdisNo5fin, MangdisNo6, MangdisNo6ini, MangdisNo6fin, MangdisNo7, MangdisNo7ini, MangdisNo7fin, MangdisNo8, MangdisNo8ini, MangdisNo8fin, MangdisNo9, MangdisNo9ini, MangdisNo9fin, nombreencuestado, ccencuestado) VALUES ('$values')";
				//echo $sql; 
				mysql_query("SET NAMES 'utf8'");
				$resultado = mysql_query($sql, $con);

				if (!$resultado) {
				    die('Consulta no válida: ' . mysql_error());
				}else{
					echo "Total de registros cargados: ".$resultado;
				}
            }   

                     
    }
    else
    {
        echo "Necesitas primero importar el archivo";
    }
?>