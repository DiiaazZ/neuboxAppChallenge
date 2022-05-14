<?php
class Challenge1{
    function resolverChallenge1(){
        $ubicacionMensajes = 'mensajes/';

        // COMPROBAR LA EXISTENCIA DE LA CARPETA CONTENEDORA, DE LO CONTRARIO CREARLA
        if(!file_exists($ubicacionMensajes)){
            mkdir($ubicacionMensajes);
            echo '<br>'.'Carpeta "mensajes" creada en la ruta actual, agregue sus mensajes dentro agente!.'.'<br>';
        }
        
        //OBTENER CONTENIDO DE CARPETA
        $arrayFicheros = scandir($ubicacionMensajes);
        $arrayMensajes = [];

        // VALIDAR SI LA CARPETA NO SE ENCUENTRA VACÍA
        if(count($arrayFicheros) >= 3){
            /* 
            1.- RECORRER ACHIVOS DENTRO DE LA CARPETA.
            2.- VALIDA SI, SU EXTENCION ES .TXT
            3.- ALMACENA LOS ARCHIVOS .TXT EN UN ARREGLO.
            */
            for($x = 2; $x < count($arrayFicheros); $x++){
                if(substr($arrayFicheros[$x], -4) == '.txt' || substr($arrayFicheros[$x], -4) == '.TXT'){
                    array_push($arrayMensajes, $arrayFicheros[$x]);
                }
            }
        }
        
        // VALIDA SI SE ENCONTRARON MENSAJES DENTRO DE LA CARPETA
        if(count($arrayMensajes) != 0){
            // LEYENDO MENSAJES...
            foreach($arrayMensajes as $verArchivo){
                $leyendoFichero = file('mensajes/'.$verArchivo);
                echo '================ Leyendo el archivo "'.$verArchivo.'" ....... ============='.'<br><br>';
                
                // COMPROBAR LA EXISTENCIA AL MENOS UNA INSTRUCCIÓN DENTRO DEL MENSAJE
                if(count($leyendoFichero) >= 3){
                    $arrayEnteros = [];
                    $primeraInstruccion = [];
                    $validacionPrimeraInstruccion = false;
                    $segundaInstruccion = [];
                    $validacionSegundaInstruccion = false;
                    $mensajeEncriptado = [];

                    //EXTRAYENDO DATOS DEL MENSAJE
                    for($i = 0; $i < count($leyendoFichero); $i++){
                        if($i == 0){
                            $arrayEnteros = explode(' ', $leyendoFichero[$i]);
                        }else if($i == 1){
                            array_push($primeraInstruccion, $leyendoFichero[$i], str_split($leyendoFichero[$i]));
                        }else if($i == 2){
                            array_push($segundaInstruccion, $leyendoFichero[$i], str_split($leyendoFichero[$i]));
                        }else if($i == 3){
                            $mensajeEncriptado = str_split($leyendoFichero[$i]);
                        }
                    }
                    echo 'Primera Instrucción: "'.$primeraInstruccion[0].'"<br>';
                    echo 'Segunda Instrucción: "'.$segundaInstruccion[0].'"<br>';

                    // DECODIFICANDO MENSAJE ==========================================
                    /*
                    1.- Se recorre cada instruccion, letra por letra buscando si la letra se encuentra entro del mensaje codificado.
                    2.- La condicion para comparar cada letra es de triple igualdad, de esa forma se validaran las mayusculas.
                    3.- Si la letra se encuentra en el mensaje se concatenara para asi formar el mensaje, para una posterior validación.
                    */
                    // PRIMERA INSTRUCCION ==============
                    $contadorDeLetrasPrimeraInstruccion = '';
                    for($y = 0; $y < $arrayEnteros[0]; $y++){
                        for($f = 0; $f < $arrayEnteros[2]; $f++){
                            if($primeraInstruccion[1][$y] === $mensajeEncriptado[$f]){
                                $contadorDeLetrasPrimeraInstruccion .= $mensajeEncriptado[$f];
                                break;
                            }
                        }
                    }

                    echo '<br>'.'Decodificando Mensaje .......'.'<br>';

                    // COMPROBANDO PRIMERA INSTRUCCION
                    $validacionPrimeraInstruccion = (strcmp(trim($contadorDeLetrasPrimeraInstruccion), trim($primeraInstruccion[0])) === 0) ? true : false;
                    
                    // SEGUNDA INSTRUCCION ===============
                    $contadorDeLetrasSegundaInstruccion = '';
                    for($y = 0; $y < $arrayEnteros[1]; $y++){
                        for($f = 0; $f < $arrayEnteros[2]; $f++){
                            if($segundaInstruccion[1][$y] === $mensajeEncriptado[$f]){
                                $contadorDeLetrasSegundaInstruccion .= $mensajeEncriptado[$f];
                                break;
                            }
                        }
                    }

                    echo 'Validando Decodificación .......'.'<br>';

                    // COMPROBANDO SEGUNDA INSTRUCCION
                    $validacionSegundaInstruccion = (strcmp(trim($contadorDeLetrasSegundaInstruccion), trim($segundaInstruccion[0])) === 0) ? true : false;
                    
                    /* SALIDA
                    1.- COMPROBAR LA EXISTENCIA DEL ARCHIVO, SI EXISTE REMPLAZA SU CONTENIDO CON EL NUEVO,
                        DE LO CONTRARIO LO CREA. 
                    2.- ESCRIBIR EL RESULTADO DE LAS INSTRUCCIONES.
                    */
                    $rutaSalida = 'salida/';
                    if(!file_exists($rutaSalida)){
                        mkdir($rutaSalida);
                    }
                    $file = fopen($rutaSalida.$verArchivo, "w");
                    
                    if($validacionPrimeraInstruccion == true){
                        fwrite($file, "SI\n");
                    }else{
                        fwrite($file, "NO\n");
                    }
                    if($validacionSegundaInstruccion == true){
                        fwrite($file, "SI");
                    }else{
                        fwrite($file, "NO");
                    }

                    fclose($file);
                    echo '<br>'.'El resultado del archivo "'.$verArchivo.'", se encuentra en la ruta: "'.$rutaSalida.$verArchivo.'"<br><br>';
                    
                }else{
                    echo '<br>'.'El archivo "'.$verArchivo.'", no cuenta con la cantidad de instrucciones válidas o se encuentra vacío.'.'<br><br>';
                }
            }
        }else{
            echo '<br>'.'Sin mensajes disponibles'.'<br>';
            echo '<br>'.'Carpeta "mensajes" en la ruta actual, agregue sus mensajes dentro agente!.'.'<br>';
        }
    }
}

$challenge = new Challenge1;
$challenge->resolverChallenge1();
?>