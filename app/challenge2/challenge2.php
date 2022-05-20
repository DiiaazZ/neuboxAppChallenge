<?php
class Challenge2{
    function validarPath(string $pathJuego, string $salto){
        // VALIDAR QUE EL ARCHIVO SEA UN ARCHIVO DE TEXTO
        if(!file_exists($pathJuego)){
            print($salto.'No existe la ruta: "'.$pathJuego.'", path incorrecto.'.$salto);
            print($salto.'La entrada al programa debe ser un archivo de texto.'.$salto);
            exit();
        }else if(substr($pathJuego, -4) != '.txt' && substr($pathJuego, -4) != '.TXT'){
            print($salto.'La entrada al programa debe ser un archivo de texto.'.$salto);
            exit();
        }
    }

    function validarRondas(int $rondas, $leyendoFichero, string $salto){
        // VALIDANDO EL PRIMER VALOR, SI ES DE TIPO ENTERO
        if(!ctype_digit(trim($leyendoFichero[0]))){
            echo $salto.'La estructura de la información es incorrecta, el número de rondas debe ser un número entero.'.$salto;
            exit();
        }else if($rondas == 0 || $rondas > 10000){ // VALIDANDO SI EL ENTERO SE ENCUENTRA ENTRE EL 0 Y EL 1000
            echo $salto.'Estructura de la información incorrecta, las rondas debe ser mayor a 0 y menores a 10000.'.$salto;
            exit();
        }else if($rondas != (count($leyendoFichero)-1)){ // VALIDANDO EL NUMERO DE RONDAS CON LA CANTIDAD DE DATOS POR RONDA
            echo $salto.'Estructura de la información incorrecta, la cantidad de datos debe ser igual al número de rondas.'.$salto;
            exit();
        }
    }

    function resolverChallenge2(string $pathJuego, string $salto){
        echo 'Validando Path .....'.$salto;
        $this->validarPath($pathJuego, $salto);

        // LEYENDO ARCHIVO juego.txt ....
        $leyendoFichero = file($pathJuego);
        // COMPROBANDO LA CARGA DEL ARCHIVO EN EL ARRAY
        if($leyendoFichero != false){
            echo '================ Leyendo el archivo "'.$pathJuego.'" ....... ============='.$salto;
            echo 'Validando archivo .....'.$salto;
            
            // OBTENIENDO NUMERO DE RONDAS
            $rondas = intval(trim($leyendoFichero[0]));

            // VALIDAR RONDAS
            $this->validarRondas($rondas, $leyendoFichero, $salto);
            
            // RECORIENDO EL MARCADOR ==========================
            $arrayJuego = [];
            for($i = 1; $i <= $rondas; $i++){
                $arrayMarcador = explode(' ', trim($leyendoFichero[$i]));
                array_push($arrayJuego, $arrayMarcador);

                // VALIDANDO INFORMACION DEL MARCADOR
                if(count($arrayMarcador) > 2){
                    echo $salto.'Estructura de la información incorrecta, los datos de cada ronda solo pueden ser de 2 jugadores.'.$salto;
                    exit();
                }else if(count($arrayMarcador) < 2){
                    echo $salto.'Estructura de la información incorrecta, los datos de cada ronda deben ser de los 2 jugadores.'.$salto;
                    exit();
                }else if(!ctype_digit($arrayMarcador[0]) || !ctype_digit($arrayMarcador[1])){
                    echo $salto.'Estructura de la información incorrecta, los datos de cada ronda deben ser dos números enteros separados por un espacio.'.$salto;
                    exit();
                }
            }
            echo 'Recoriendo Marcado .....'.$salto;
            
            // MOSTRANDO MARCADOR DEL JUEGO
            echo $salto.'Mostrando marcador del juego .....'.$salto;
            ?>
            <table>
                <thead>
                    <tr>
                        <th># Ronda</th>
                        <th>Jugador 1</th>
                        <th>Jugador 2</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for($i = 0; $i < $rondas; $i++){
                    ?>
                    <tr>
                        <td><?php echo ($i+1); ?></td>
                        <?php
                        for($x = 0; $x < 2; $x++){
                        ?>
                        <td><?php echo intval($arrayJuego[$i][$x]); ?></td>
                        <?php
                        }
                        ?>
                    </tr>
                    <?php
                    } 
                    ?>
                </tbody>
            </table><br>
            <?php

            // GENERANDO MARCADOR ACOMULADO Y VENTAJA OBTENIDA
            echo 'Generando marcador acomulado .....'.$salto;
            $arrayMarcadorAcumulado = [];
            $puntosPorRondaJugador1 = 0;
            $puntosPorRondaJugador2 = 0;
            
            // RECORRER EL ARREGLO PARA SUMA PUNTOS ACOMULADOR POR JUGADOR Y PARCEANDOLOS A TIPO ENTERO
            for($i = 0; $i < $rondas; $i++){
                for($x = 0; $x < 2; $x++){
                    if($x == 0){
                        $puntosPorRondaJugador1 += intval($arrayJuego[$i][$x]);
                    }else{
                        $puntosPorRondaJugador2 += intval($arrayJuego[$i][$x]);
                    }
                }
                
                // COMPROBAR QUIEN ES EL GANAOR DE CADA RONDA Y SUS PUNTOS DE VENTAJA
                if($puntosPorRondaJugador1 > $puntosPorRondaJugador2){
                    $ventaja = ($puntosPorRondaJugador1 - $puntosPorRondaJugador2);
                    $arrayGanador = [$puntosPorRondaJugador1, $puntosPorRondaJugador2, 'Jugador 1', $ventaja];
                    array_push($arrayMarcadorAcumulado, $arrayGanador);
                }else{
                    $ventaja = ($puntosPorRondaJugador2 - $puntosPorRondaJugador1);
                    $arrayGanador = [$puntosPorRondaJugador1, $puntosPorRondaJugador2, 'Jugador 2', $ventaja];
                    array_push($arrayMarcadorAcumulado, $arrayGanador);
                }
            }
            
            // MOSTRANDO MARCADOR ACUMULADO
            echo $salto.'Mostrando marcador acomulado .....'.$salto;
            ?>
            <table>
                <thead>
                    <tr>
                        <th># Ronda</th>
                        <th>Jugador 1</th>
                        <th>Jugador 2</th>
                        <th>Líder</th>
                        <th>Ventaja</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for($i = 0; $i < $rondas; $i++){
                    ?>
                    <tr>
                        <td><?php echo ($i+1); ?></td>
                        <?php
                        for($x = 0; $x < 4; $x++){
                        ?>
                        <td><?php echo $arrayMarcadorAcumulado[$i][$x]; ?></td>
                        <?php
                        }
                        ?>
                    </tr>
                    <?php
                    } 
                    ?>
                </tbody>
            </table><br>
            <?php

            /* SALIDA
            1.- COMPROBAR LA EXISTENCIA DEL ARCHIVO, DE LO CONTRARIO CREARLO 
            2.- ESCRIBIR EL RESULTADO DE LAS INSTRUCCIONES
            */
            $nombreArchivo = basename($pathJuego);
            $rutaSalida = 'resultadoJuegos/';
            if(!file_exists($rutaSalida)){
                mkdir($rutaSalida);
            }
            $file = fopen($rutaSalida.'resultado_'.$nombreArchivo, "w");
            
            // ESCRIBIENDO ARCHIVO, CON EL RESULTADO DE LA MAYOR VENTAJA DE TODAS LA RONDAS
            $jugadorGanador = '';
            $ventajaMayor = 0;
            for($i = 0; $i < $rondas; $i++){
                if($arrayMarcadorAcumulado[$i][3] > $ventajaMayor){
                    $arrayNombreJugador = explode(' ', $arrayMarcadorAcumulado[$i][2]);

                    $jugadorGanador = $arrayNombreJugador[1];
                    $ventajaMayor = $arrayMarcadorAcumulado[$i][3];
                }
            }
            fwrite($file, $jugadorGanador.' '.$ventajaMayor);

            fclose($file);
            echo $salto.'El resultado del juego, se encuentra en la ruta: "'.$rutaSalida.'resultado_'.$nombreArchivo.'"<br><br>';
        }else{
            echo $salto.'El archivo se encuentra vacío.'.$salto;
        }
    }
}


// VALIDANDO TIPO DE EJECUCION =================================
if(!isset($_SERVER['HTTP_USER_AGENT'])){ // EJECUCION POR TERMINAL
    $pathJuego = readline("Ingresa el PATH de la ubicacion del juego: ");
    $salto = "\n";
}else{ // EJECUCION POR NAVEGADOR
    ?><form method="POST" action="challenge2.php">
        <label>Ingresa el PATH de la ubicacion del juego: </label><br>
        <input name="pathJuego" type="text" height="100" autocomplete="off" style="width: 50%;" required>
        <button type="submit">Ejecutar</button>
        <button type="button"><a href="../../">Salir</a></button>
    </form><?php
    if(isset($_POST['pathJuego'])) $pathJuego = $_POST['pathJuego'];
    $salto = '<br>';
}
// ================================================================

// INICIAR PROGRAMA
if(isset($pathJuego)){
    $challenge = new Challenge2;
    $challenge->resolverChallenge2($pathJuego, $salto);
}
?>