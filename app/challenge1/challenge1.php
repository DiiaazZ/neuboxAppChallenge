<?php
class Challenge1{
    function comprobarArchivo(string $ubicacionMensaje, string $nombreArchivo){
        // COMPROBAR LA EXISTENCIA DE LA CARPETA CONTENEDORA, DE LO CONTRARIO CREARLA
        if(!file_exists($ubicacionMensaje)){
            mkdir($ubicacionMensaje);
        }
        // COMPROBAR LA EXISTENCIA DEL ARCHIVO "mensaje.txt", DE LO CONTRARIO CREARLO
        if(!file_exists($ubicacionMensaje.$nombreArchivo)){
            $file = fopen($ubicacionMensaje.$nombreArchivo, "w");
            fwrite($file, '11 15 38'."\n");
            fwrite($file, 'CeseAlFuego'."\n");
            fwrite($file, 'CorranACubierto'."\n");
            fwrite($file, 'XXcaaamakkCCessseAAllFueeegooDLLKmmNNN');
            fclose($file);
        }
    }

    function validarPrimeraLinea(array $arrayEnteros, int $validacionPrimerEntero, int $validacionSegundoEntero, int $validacionTercerEntero){
        // VALIDANDO PRIMER ENTERO
        if(!ctype_digit($arrayEnteros[0])){
            echo '<br>'.'Estructura de la información incorrecta';
            echo '<br>'.'Primer valor incorrecto, la primera línea deben ser 3 números enteros.'.'<br><br>';
            exit();
        }else if($validacionPrimerEntero < 2 || $validacionPrimerEntero > 50){
            echo '<br>'.'Estructura de la información incorrecta';
            echo '<br>'.'Primer valor incorrecto, se espera un valor que esté entre 2 y 50.'.'<br><br>';
            exit();
        }

        // VALIDANDO SEGUNDO ENTERO
        if(!ctype_digit($arrayEnteros[1])){
            echo '<br>'.'Estructura de la información incorrecta';
            echo '<br>'.'Segundo valor incorrecto, la primera línea deben ser 3 números enteros.'.'<br><br>';
            exit();
        }else if($validacionSegundoEntero < 2 || $validacionSegundoEntero > 50){
            echo '<br>'.'Estructura de la información incorrecta';
            echo '<br>'.'Segundo valor incorrecto, se espera un valor que esté entre 2 y 50..'.'<br><br>';
            exit();
        }

        // VALIDANDO TERCER ENTERO
        if(!ctype_digit($arrayEnteros[2])){
            echo '<br>'.'Estructura de la información incorrecta';
            echo '<br>'.'Tercer valor incorrecto, la primera línea deben ser 3 números enteros.'.'<br><br>';
            exit();
        }else if($validacionTercerEntero < 3 || $validacionTercerEntero > 5000){
            echo '<br>'.'Estructura de la información incorrecta';
            echo '<br>'.'Tercer valor incorrecto, se espera un valor que esté entre 3 y 5000.'.'<br><br>';
            exit();
        }
    }

    function validarPrimeraInstruccion(array $primeraInstruccion, int $validacionPrimerEntero){
        // VALIDANDO SEGUNDA LINEA, PRIMERA INSTRUCCIÓN =============================================
        $tipoValorPrimeraInstruccion = intval($primeraInstruccion[0]);
        if(!ctype_alnum($primeraInstruccion[0])){ // VALIDANDO QUE NO SEA UN INTEGER
            echo '<br>'.'Estructura de la información incorrecta';
            echo '<br>'.'Primera instrucción incorrecta, la segunda línea debe contener el texto de la primera instrucción.'.'<br><br>';
            exit();
        }else if(count($primeraInstruccion[1]) != $validacionPrimerEntero){ // VALIDANDO EL NUMERO DE CARACTERES.
            echo '<br>'.'Estructura de la información incorrecta';
            echo '<br>'.'El primer valor de la primera línea no coincide con el número de caracteres de la primera instrucción.'.'<br><br>';
            exit();
        }
    }

    function validarSegundaInstruccion(array $segundaInstruccion, int $validacionSegundoEntero){
        // VALIDANDO TERCERA LINEA, SEGUNDA INSTRUCCIÓN =============================================
        $tipoValorSegundaInstruccion = intval($segundaInstruccion[0]);
        if(!ctype_alnum($segundaInstruccion[0])){ // VALIDANDO QUE NO SEA UN INTEGER
            echo '<br>'.'Estructura de la información incorrecta';
            echo '<br>'.'Segunda instrucción incorrecta, la tercera línea debe contener el texto de la segunda instrucción.'.'<br><br>';
            exit();
        }else if(count($segundaInstruccion[1]) != $validacionSegundoEntero){ // VALIDANDO EL NUMERO DE CARACTERES.
            echo '<br>'.'Estructura de la información incorrecta';
            echo '<br>'.'El segundo valor de la primera línea no coincide con el número de caracteres de la segunda instrucción.'.'<br><br>';
            exit();
        }
    }

    function validarMensaje(array $mensajeEncriptado, int $validacionTercerEntero){
        // VALIDANDO CUARTA LINEA, MENSAJE =============================================
        // $tipoValorMensaje = intval($mensajeEncriptado[0]);
        if(!ctype_alnum($mensajeEncriptado[0])){ // VALIDANDO QUE NO SEA UN INTEGER
            echo '<br>'.'Estructura de la información incorrecta';
            echo '<br>'.'Estructura del mensaje incorrecta, la cuarta línea debe contener solo caracteres [a-zA-Z0-9].'.'<br><br>';
            exit();
        }else if(count($mensajeEncriptado[1]) != $validacionTercerEntero){ // VALIDANDO EL NUMERO DE CARACTERES.
            echo '<br>'.'Estructura de la información incorrecta';
            echo '<br>'.'El tercer valor de la primera línea, no coincide con el número de caracteres del mensaje.'.'<br><br>';
            exit();
        }
    }

    function resolverChallenge1(){
        $ubicacionMensaje = 'mensaje/';
        $nombreArchivo = 'mensaje.txt';

        $this->comprobarArchivo($ubicacionMensaje, $nombreArchivo);

        // LEYENDO ARCHIVO
        $leyendoFichero = file($ubicacionMensaje.$nombreArchivo);
        if($leyendoFichero){
            echo '================ Leyendo el archivo "'.$ubicacionMensaje.$nombreArchivo.'" ....... ============='.'<br><br>';
            echo 'Validando archivo....'.'<br><br>';

            // VALIDANDO LA ESTRUCTURA DEL ARCHIVO =====================
            if(count($leyendoFichero) < 4 || count($leyendoFichero) > 4){
                echo '<br>'.'Estructura de la información del archivo incorrecta, el archivo debe contener 4 líneas.'.'<br><br>';
                exit();
            }
            
            $arrayEnteros = [];
            $primeraInstruccion = [];
            $segundaInstruccion = [];
            $mensajeEncriptado = [];

            //EXTRAYENDO DATOS DEL ARCHIVO
            for($i = 0; $i < count($leyendoFichero); $i++){
                if($i == 0){
                    $arrayEnteros = explode(' ', trim($leyendoFichero[$i]));
                }else if($i == 1){
                    array_push($primeraInstruccion, trim($leyendoFichero[$i]), str_split(trim($leyendoFichero[$i])));
                }else if($i == 2){
                    array_push($segundaInstruccion, trim($leyendoFichero[$i]), str_split(trim($leyendoFichero[$i])));
                }else if($i == 3){
                    array_push($mensajeEncriptado, trim($leyendoFichero[$i]), str_split(trim($leyendoFichero[$i])));
                }
            }

            // VALIDANDO PRIMERA LINEA DE 3 ENTEROS
            if(count($arrayEnteros) < 3 || count($arrayEnteros) > 3){
                echo '<br>'.'Estructura de la información incorrecta, la primera línea deben ser 3 números enteros separados por un espacio.'.'<br><br>';
                exit();
            }

            $validacionPrimerEntero = intval($arrayEnteros[0]);
            $validacionSegundoEntero = intval($arrayEnteros[1]);
            $validacionTercerEntero = intval($arrayEnteros[2]);
            
            echo 'Validando datos de la primera línea.....'.'<br><br>';
            $this->validarPrimeraLinea($arrayEnteros, $validacionPrimerEntero, $validacionSegundoEntero, $validacionTercerEntero);
            
            echo 'Validando primera instrcción.....'.'<br><br>';
            $this->validarPrimeraInstruccion($primeraInstruccion, $validacionPrimerEntero);

            echo 'Validando segunda instrucción.....'.'<br><br>';
            $this->validarSegundaInstruccion($segundaInstruccion, $validacionSegundoEntero);

            echo 'Validando mensaje .....'.'<br><br>';
            $this->validarMensaje($mensajeEncriptado, $validacionTercerEntero);

            echo 'Primera Instrucción: "'.$primeraInstruccion[0].'"'.'<br>';
            echo 'Segunda Instrucción: "'.$segundaInstruccion[0].'"'.'<br>';
            echo 'Mensaje: "'.$mensajeEncriptado[0].'"'.'<br>';
            
            // DECODIFICANDO MENSAJE ==========================================
            echo '<br>'.'Decodificando Mensaje .......'.'<br>';
            /*
            1.- Se recorre cada instruccion, letra por letra buscando si la letra se encuentra entro del mensaje codificado.
            2.- La condicion para comparar cada letra es de triple igualdad, de esa forma se validaran las mayusculas.
            3.- Si la letra se encuentra en el mensaje se concatenara para asi formar el mensaje, para una posterior validación.
            */
            // PRIMERA INSTRUCCION ==============
            $contadorDeLetrasPrimeraInstruccion = '';
            for($y = 0; $y < $arrayEnteros[0]; $y++){
                for($f = 0; $f < $arrayEnteros[2]; $f++){
                    if($primeraInstruccion[1][$y] === $mensajeEncriptado[1][$f]){
                        $contadorDeLetrasPrimeraInstruccion .= $mensajeEncriptado[1][$f];
                        break;
                    }
                }
            }
            // COMPROBANDO PRIMERA INSTRUCCION
            $validacionPrimeraInstruccion = false;
            $validacionPrimeraInstruccion = (strcmp($contadorDeLetrasPrimeraInstruccion, $primeraInstruccion[0]) === 0) ? true : false;
            
            // SEGUNDA INSTRUCCION ===============
            $contadorDeLetrasSegundaInstruccion = '';
            for($y = 0; $y < $arrayEnteros[1]; $y++){
                for($f = 0; $f < $arrayEnteros[2]; $f++){
                    if($segundaInstruccion[1][$y] === $mensajeEncriptado[1][$f]){
                        $contadorDeLetrasSegundaInstruccion .= $mensajeEncriptado[1][$f];
                        break;
                    }
                }
            }

            // COMPROBANDO SEGUNDA INSTRUCCION
            $validacionSegundaInstruccion = false;
            $validacionSegundaInstruccion = (strcmp($contadorDeLetrasSegundaInstruccion, $segundaInstruccion[0]) === 0) ? true : false;
            /* SALIDA
            1.- COMPROBAR LA EXISTENCIA DEL ARCHIVO, SI EXISTE REMPLAZA SU CONTENIDO CON EL NUEVO,
                DE LO CONTRARIO LO CREA. 
            2.- ESCRIBIR EL RESULTADO DE LAS INSTRUCCIONES.
            */
            $rutaSalida = 'salida/';
            if(!file_exists($rutaSalida)){
                mkdir($rutaSalida);
            }
            $file = fopen($rutaSalida.$nombreArchivo, "w");
            
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
            echo '<br>'.'El resultado del programa, se encuentra en la ruta: "'.$rutaSalida.$nombreArchivo.'"<br><br>';
        }else{
            echo '<br>'.'El archivo se encuentra vacío.'.'<br><br>';
        }
    }
}

$challenge = new Challenge1;
$challenge->resolverChallenge1();
?>