<?php
class Challenge1{
    function validarArchivo(string $pathMensaje, string $salto){
        // VALIDAR QUE EL ARCHIVO SEA UN ARCHIVO DE TEXTO
        if(!file_exists($pathMensaje)){
            print($salto.'No existe la ruta: "'.$pathMensaje.'", path incorrecto.'.$salto);
            print($salto.'La entrada al programa debe ser un archivo de texto.'.$salto);
            exit();
        }else if(substr($pathMensaje, -4) != '.txt' && substr($pathMensaje, -4) != '.TXT'){
            print($salto.'La entrada al programa debe ser un archivo de texto.'.$salto);
            exit();
        }
    }

    function validarPrimeraLinea(array $arrayEnteros, int $validacionPrimerEntero, int $validacionSegundoEntero, int $validacionTercerEntero, string $salto){
        // VALIDANDO PRIMER ENTERO
        if(!ctype_digit($arrayEnteros[0])){
            print($salto.'Estructura de la información incorrecta');
            print($salto.'Primer valor incorrecto, la primera línea deben ser 3 números enteros.'.$salto);
            exit();
        }else if($validacionPrimerEntero < 2 || $validacionPrimerEntero > 50){
            print($salto.'Estructura de la información incorrecta');
            print($salto.'Primer valor incorrecto, se espera un valor que esté entre 2 y 50.'.$salto);
            exit();
        }

        // VALIDANDO SEGUNDO ENTERO
        if(!ctype_digit($arrayEnteros[1])){
            print($salto.'Estructura de la información incorrecta');
            print($salto.'Segundo valor incorrecto, la primera línea deben ser 3 números enteros.'.$salto);
            exit();
        }else if($validacionSegundoEntero < 2 || $validacionSegundoEntero > 50){
            print($salto.'Estructura de la información incorrecta');
            print($salto.'Segundo valor incorrecto, se espera un valor que esté entre 2 y 50..'.$salto);
            exit();
        }

        // VALIDANDO TERCER ENTERO
        if(!ctype_digit($arrayEnteros[2])){
            print($salto.'Estructura de la información incorrecta');
            print($salto.'Tercer valor incorrecto, la primera línea deben ser 3 números enteros.'.$salto);
            exit();
        }else if($validacionTercerEntero < 3 || $validacionTercerEntero > 5000){
            print($salto.'Estructura de la información incorrecta');
            print($salto.'Tercer valor incorrecto, se espera un valor que esté entre 3 y 5000.'.$salto);
            exit();
        }
    }

    function validarPrimeraInstruccion(array $primeraInstruccion, int $validacionPrimerEntero, string $salto){
        // VALIDANDO SEGUNDA LINEA, PRIMERA INSTRUCCIÓN =============================================
        $tipoValorPrimeraInstruccion = intval($primeraInstruccion[0]);
        if(!ctype_alnum($primeraInstruccion[0])){ // VALIDANDO QUE NO SEA UN INTEGER
            print($salto.'Estructura de la información incorrecta');
            print($salto.'Primera instrucción incorrecta, la segunda línea debe contener el texto de la primera instrucción.'.$salto);
            exit();
        }else if(count($primeraInstruccion[1]) != $validacionPrimerEntero){ // VALIDANDO EL NUMERO DE CARACTERES.
            print($salto.'Estructura de la información incorrecta');
            print($salto.'El primer valor de la primera línea no coincide con el número de caracteres de la primera instrucción.'.$salto);
            exit();
        }

        // VALIDANDO DOS LETRAS IGUALES SEGUIDAS
        $i = 1;
        do{
            if(strcmp($primeraInstruccion[1][$i-1], $primeraInstruccion[1][$i]) === 0){
                print($salto.'Estructura de la información incorrecta');
                print($salto.'Primera instrucción incorrecta, ninguna instrucción puede contener dos letras iguales seguidas.'.$salto);
                exit();
            }
            $i++;
        }while($i < count($primeraInstruccion[1]));
    }

    function validarSegundaInstruccion(array $segundaInstruccion, int $validacionSegundoEntero, string $salto){
        // VALIDANDO TERCERA LINEA, SEGUNDA INSTRUCCIÓN =============================================
        $tipoValorSegundaInstruccion = intval($segundaInstruccion[0]);
        if(!ctype_alnum($segundaInstruccion[0])){ // VALIDANDO QUE NO SEA UN INTEGER
            print($salto.'Estructura de la información incorrecta');
            print($salto.'Segunda instrucción incorrecta, la tercera línea debe contener el texto de la segunda instrucción.'.$salto);
            exit();
        }else if(count($segundaInstruccion[1]) != $validacionSegundoEntero){ // VALIDANDO EL NUMERO DE CARACTERES.
            print($salto.'Estructura de la información incorrecta');
            print($salto.'El segundo valor de la primera línea no coincide con el número de caracteres de la segunda instrucción.'.$salto);
            exit();
        }

        // VALIDANDO DOS LETRAS IGUALES SEGUIDAS
        $i = 1;
        do{
            if(strcmp($segundaInstruccion[1][$i-1], $segundaInstruccion[1][$i]) === 0){
                print($salto.'Estructura de la información incorrecta');
                print($salto.'Segunda instrucción incorrecta, ninguna instrucción puede contener dos letras iguales seguidas.'.$salto);
                exit();
            }
            $i++;
        }while($i < count($segundaInstruccion[1]));
    }

    function validarMensaje(array $mensajeEncriptado, int $validacionTercerEntero, string $salto){
        // VALIDANDO CUARTA LINEA, MENSAJE =============================================
        $cantidadMensajes = explode(' ', $mensajeEncriptado[0]);
        if(count($cantidadMensajes) > 1){ // VALIDANDO CANTIDAD DE MENSAJES
            print($salto.'Estructura de la información incorrecta');
            print($salto.'Estructura del mensaje incorrecta, solo puede existir un mensaje.'.$salto);
            exit();
        }else if(!ctype_alnum($mensajeEncriptado[0])){ // VALIDANDO QUE NO SEA UN INTEGER
            print($salto.'Estructura de la información incorrecta');
            print($salto.'Estructura del mensaje incorrecta, la cuarta línea debe contener solo caracteres [a-zA-Z0-9].'.$salto);
            exit();
        }else if(count($mensajeEncriptado[1]) != $validacionTercerEntero){ // VALIDANDO EL NUMERO DE CARACTERES.
            print($salto.'Estructura de la información incorrecta');
            print($salto.'El tercer valor de la primera línea, no coincide con el número de caracteres del mensaje.'.$salto);
            exit();
        }
    }

    function resolverChallenge1(string $pathMensaje, string $salto){
        print('Validando Path....'.$salto);
        $this->validarArchivo($pathMensaje, $salto);

        // LEYENDO ARCHIVO
        $leyendoFichero = file($pathMensaje);
        if($leyendoFichero){
            print('================ Leyendo el archivo "'.$pathMensaje.'" ....... ============='.$salto);
            
            print('Validando archivo....'.$salto);
            // VALIDANDO LA ESTRUCTURA DEL ARCHIVO =====================
            if(count($leyendoFichero) < 4 || count($leyendoFichero) > 4){
                print($salto.'Estructura de la información del archivo incorrecta, el archivo debe contener 4 líneas.'.$salto);
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
                print($salto.'Estructura de la información incorrecta, la primera línea deben ser 3 números enteros separados por un espacio.'.$salto);
                exit();
            }

            $validacionPrimerEntero = intval($arrayEnteros[0]);
            $validacionSegundoEntero = intval($arrayEnteros[1]);
            $validacionTercerEntero = intval($arrayEnteros[2]);
            
            print('Validando datos de la primera línea.....'.$salto);
            $this->validarPrimeraLinea($arrayEnteros, $validacionPrimerEntero, $validacionSegundoEntero, $validacionTercerEntero, $salto);
            
            print('Validando primera instrcción.....'.$salto);
            $this->validarPrimeraInstruccion($primeraInstruccion, $validacionPrimerEntero, $salto);

            print('Validando segunda instrucción.....'.$salto);
            $this->validarSegundaInstruccion($segundaInstruccion, $validacionSegundoEntero, $salto);
            
            print('Validando mensaje .....'.$salto);
            $this->validarMensaje($mensajeEncriptado, $validacionTercerEntero, $salto);

            print($salto.'Primera Instrucción: "'.$primeraInstruccion[0].'"'.$salto);
            print('Segunda Instrucción: "'.$segundaInstruccion[0].'"'.$salto);
            print('Mensaje: "'.$mensajeEncriptado[0].'"'.$salto);
            
            // DECODIFICANDO MENSAJE ==========================================
            print($salto.'Decodificando Mensaje .......'.$salto);
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
            $nombreArchivo = basename($pathMensaje);
            $rutaSalida = 'resultados/';
            if(!file_exists($rutaSalida)){
                mkdir($rutaSalida);
            }
            $file = fopen($rutaSalida.'resultado_'.$nombreArchivo, "w");

            // VALIDAR INSTRUCCIONES REPETIDAS
            if($validacionPrimeraInstruccion == true && $validacionSegundaInstruccion == true){
                print($salto.'Estructura de la información incorrecta, máximo puede existir una instrucción escondida por mensaje.'.$salto);
                exit();
            }

            ($validacionPrimeraInstruccion == true) ? fwrite($file, "SI\n") : fwrite($file, "NO\n");
            ($validacionSegundaInstruccion == true) ? fwrite($file, "SI") : fwrite($file, "NO");

            fclose($file);
            print($salto.'El resultado del programa, se encuentra en la ruta: "'.$rutaSalida.'resultado_'.$nombreArchivo.'"');
        }else{
            print($salto.'El archivo se encuentra vacío.'.$salto);
        }
    }
}

// VALIDANDO TIPO DE EJECUCION =================================
if(!isset($_SERVER['HTTP_USER_AGENT'])){ // EJECUCION POR TERMINAL
    $pathMensaje = readline("Ingresa el PATH de la ubicacion del mensaje: ");
    $salto = "\n";
}else{ // EJECUCION POR NAVEGADOR
    ?><form method="POST" action="challenge1.php">
        <label>Ingresa el PATH de la ubicacion del mensaje: </label><br>
        <input name="pathMensaje" type="text" height="100" autocomplete="off" style="width: 50%;" required>
        <button type="submit">Ejecutar</button>
        <button type="button"><a href="../../">Salir</a></button>
    </form><?php
    if(isset($_POST['pathMensaje'])) $pathMensaje = $_POST['pathMensaje'];
    $salto = '<br>';
}
// ================================================================

// INICIAR PROGRAMA
if(isset($pathMensaje)){
    $challenge = new Challenge1;
    $challenge->resolverChallenge1($pathMensaje, $salto);
}
?>