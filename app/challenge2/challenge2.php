<?php
class Challenge2{
    function resolverChallenge2(){
        $ubicacionArchivos = 'juegos/';

        // COMPROBAR LA EXISTENCIA DE LA CARPETA CONTENEDORA, DE LO CONTRARIO CREARLA
        if(!file_exists($ubicacionArchivos)){
            mkdir($ubicacionArchivos);
            echo '<br>'.'Carpeta "juegos" creada en la ruta actual, favor de agregar sus juegos adentro.'.'<br>';
        }

        //OBTENER CONTENIDO DE CARPETA
        $arrayFicheros = scandir($ubicacionArchivos);
        $arrayNombreArchivos = [];

        // VALIDAR SI LA CARPETA NO SE ENCUENTRA VACÍA
        if(count($arrayFicheros) >= 3){
            /* 
            1.- RECORRER ACHIVOS DENTRO DE LA CARPETA.
            2.- VALIDA SI, SU EXTENCION ES .TXT
            3.- ALMACENA LOS ARCHIVOS .TXT EN UN ARREGLO.
            */
            for($x = 2; $x < count($arrayFicheros); $x++){
                if(substr($arrayFicheros[$x], -4) == '.txt' || substr($arrayFicheros[$x], -4) == '.TXT'){
                    array_push($arrayNombreArchivos, $arrayFicheros[$x]);
                }
            }
        }
        
        // VALIDA SI SE ENCONTRARON ARCHIVOS DENTRO DE LA CARPETA
        if(count($arrayNombreArchivos) != 0){
            // LEYENDO JUEGOS...
            foreach($arrayNombreArchivos as $verArchivo){
                $leyendoFichero = file($ubicacionArchivos.$verArchivo);
                echo '================ Leyendo el archivo "'.$verArchivo.'" ....... ============='.'<br><br>';
                echo 'Validando archivo .....'.'<br>';

                // VALIDANDON QUE EL ARCHIVO NO ESTE VACÍO
                if(count($leyendoFichero) == 0){
                    echo '<br>'.'El archivo "'.$verArchivo.'", encuentra vacío.'.'<br><br>';
                    continue;
                }

                $rondas = intval($leyendoFichero[0]);

                // VALIDANDO EL PRIMER VALOR, SI ES DE TIPO ENTERO
                if($rondas == 0){
                    echo '<br>'.'El archivo "'.$verArchivo.'", no cumple la estructura de la información correcta.'.'<br><br>';
                    continue;
                }
                // VALIDANDO SI EL ENTERO SE ENCUENTRA ENTRE EL 0 Y EL 1000
                if($rondas == 0 || $rondas > 10000){
                    echo '<br>'.'El archivo "'.$verArchivo.'", no cumple la estructura de la información correcta.'.'<br><br>';
                    continue;
                }
                // VALIDANDO EL NUMERO DE RONDAS CON LA CANTIDAD DE DATOS POR RONDA
                if($rondas != (count($leyendoFichero)-1)){
                    echo '<br>'.'El archivo "'.$verArchivo.'", no cuenta con la cantidad de datos de cada ronda o la estructura de la información es incorrecta.'.'<br><br>';
                    continue;
                }
                
                // RECORIENDO EL MARCADOR ==========================
                echo 'Recoriendo Marcado .....'.'<br>';
                $arrayJuego = [];
                for($i = 1; $i <= $rondas; $i++){
                    $arrayMarcador = explode(' ', $leyendoFichero[$i]);
                    array_push($arrayJuego, $arrayMarcador);
                }
                
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
                            <td><?php echo $arrayJuego[$i][$x]; ?></td>
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
                $file = fopen($rutaSalida.$verArchivo, "w");
                
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
                echo '<br>'.'El resultado del archivo "'.$verArchivo.'", se encuentra en la ruta: "'.$rutaSalida.$verArchivo.'"<br><br>';
            }
        }else{
            echo '<br>'.'Carpeta Vacía.'.'<br>';
            echo '<br>'.'Carpeta "juegos" en la ruta actual, favor de agregar sus juegos adentro.'.'<br>';
        }
    }
}

$challenge = new Challenge2;
$challenge->resolverChallenge2();
?>