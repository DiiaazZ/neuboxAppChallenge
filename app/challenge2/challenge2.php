<?php
class Challenge2{
    function comprobarArchivo(string $ubicacionArchivo, string $nombreArchivo){
        // COMPROBAR LA EXISTENCIA DE LA CARPETA CONTENEDORA, DE LO CONTRARIO CREARLA
        if(!file_exists($ubicacionArchivo)){
            mkdir($ubicacionArchivo);
        }
        // COMPROBAR LA EXISTENCIA DEL ARCHIVO "juego.txt", DE LO CONTRARIO CREARLO
        if(!file_exists($ubicacionArchivo.$nombreArchivo)){
            $file = fopen($ubicacionArchivo.$nombreArchivo, "w");
            fwrite($file, '5'."\n");
            fwrite($file, '140 82'."\n");
            fwrite($file, '89 134'."\n");
            fwrite($file, '90 110'."\n");
            fwrite($file, '112 106'."\n");
            fwrite($file, '88 90');
            fclose($file);
        }
    }

    function validarRondas(int $rondas, $leyendoFichero){
        // VALIDANDO EL PRIMER VALOR, SI ES DE TIPO ENTERO
        if(!ctype_digit(trim($leyendoFichero[0]))){
            echo '<br>'.'La estructura de la información es incorrecta, el número de rondas debe ser un número entero.'.'<br><br>';
            exit();
        }else if($rondas == 0 || $rondas > 10000){ // VALIDANDO SI EL ENTERO SE ENCUENTRA ENTRE EL 0 Y EL 1000
            echo '<br>'.'Estructura de la información incorrecta, las rondas debe ser mayor a 0 y menores a 10000.'.'<br><br>';
            exit();
        }else if($rondas != (count($leyendoFichero)-1)){ // VALIDANDO EL NUMERO DE RONDAS CON LA CANTIDAD DE DATOS POR RONDA
            echo '<br>'.'Estructura de la información incorrecta, la cantidad de datos debe ser igual al número de rondas.'.'<br><br>';
            exit();
        }
    }

    function resolverChallenge2(){
        $ubicacionArchivo = 'juego/';
        $nombreArchivo = 'juego.txt';

        $this->comprobarArchivo($ubicacionArchivo, $nombreArchivo);

        // LEYENDO ARCHIVO juego.txt ....
        $leyendoFichero = file($ubicacionArchivo.$nombreArchivo);
        // COMPROBANDO LA CARGA DEL ARCHIVO EN EL ARRAY
        if($leyendoFichero != false){
            echo '================ Leyendo el archivo "'.$ubicacionArchivo.$nombreArchivo.'" ....... ============='.'<br><br>';
            echo 'Validando archivo .....'.'<br>';
            
            // OBTENIENDO NUMERO DE RONDAS
            $rondas = intval(trim($leyendoFichero[0]));

            // VALIDAR RONDAS
            $this->validarRondas($rondas, $leyendoFichero);
            
            // RECORIENDO EL MARCADOR ==========================
            $arrayJuego = [];
            for($i = 1; $i <= $rondas; $i++){
                $arrayMarcador = explode(' ', trim($leyendoFichero[$i]));
                array_push($arrayJuego, $arrayMarcador);

                // VALIDANDO INFORMACION DEL MARCADOR
                if(count($arrayMarcador) > 2){
                    echo '<br>'.'Estructura de la información incorrecta, los datos de cada ronda solo pueden ser de 2 jugadores.'.'<br><br>';
                    exit();
                }else if(count($arrayMarcador) < 2){
                    echo '<br>'.'Estructura de la información incorrecta, los datos de cada ronda deben ser de los 2 jugadores.'.'<br><br>';
                    exit();
                }else if(!ctype_digit($arrayMarcador[0]) || !ctype_digit($arrayMarcador[1])){
                    echo '<br>'.'Estructura de la información incorrecta, los datos de cada ronda deben ser dos números enteros separados por un espacio.'.'<br><br>';
                    exit();
                }
            }
            echo 'Recoriendo Marcado .....'.'<br>';
            
            // MOSTRANDO MARCADOR DEL JUEGO
            echo '<br>'.'Mostrando marcador del juego .....'.'<br>';
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
            echo 'Generando marcador acomulado .....'.'<br>';
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
            echo '<br>'.'Mostrando marcador acomulado .....'.'<br>';
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
            $rutaSalida = 'resultadoJuegos/';
            if(!file_exists($rutaSalida)){
                mkdir($rutaSalida);
            }
            $file = fopen($rutaSalida.$nombreArchivo, "w");
            
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
            echo '<br>'.'El resultado del juego, se encuentra en la ruta: "'.$rutaSalida.$nombreArchivo.'"<br><br>';
        }else{
            echo '<br>'.'El archivo se encuentra vacío.'.'<br><br>';
        }
    }
}

$challenge = new Challenge2;
$challenge->resolverChallenge2();
?>