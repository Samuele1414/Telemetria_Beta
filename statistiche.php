<!--
NOTE:
Zona inferiore con statistiche
-->
<?php
include "top.php";
include "config.php";
include "lettura.php";
$n_dati = 1000;
$media_acc = 0;
$media_fren = 0;
$max_velocita = 0;
$min_velocita = 300;
$media_velocita = 0;
$max_rpm = 0;
$min_rpm = 10000;
$media_rpm = 0;
for ($i = 0; $i < $n_dati; $i++) {
    $media_acc += $gas[$i];
    $media_fren += $brake[$i];
    if ($max_velocita < $speed[$i]) {
        $max_velocita = $speed[$i];
    }
    if ($min_velocita > $speed[$i]) {
        $min_velocita = $speed[$i];
    }
    $media_velocita += $speed[$i];
    if ($max_rpm < $rpm[$i]) {
        $max_rpm = $rpm[$i];
    }
    if ($min_rpm > $rpm[$i]) {
        $min_rpm = $rpm[$i];
    }
    $media_rpm += $rpm[$i];
}

?>
<div class="container">
    <div class="row">
        <div class="col-sm">
            <div class="h3">Medie</div>
            <?php
            echo "Media Gas " . $media_acc / 1000 . "%<br>";
            echo "Media Freno " . $media_fren / 1000 . "%<br>";
            ?>
        </div>
        <div class="col-sm">
            <div class="h3">Velocità</div>
            <?php
            echo "Velocità Max " . $max_velocita . "<br>";
            echo "Velocità Min " . $min_velocita . "<br>";
            echo "Velocità Media " . $media_velocita / 1000 . "<br>";
            ?>
        </div>
        <div class="col-sm">
            <div class="h3">RPM</div>
            <?php
            echo "RPM Max " . $max_rpm . "<br>";
            echo "RPM Min " . $min_rpm . "<br>";
            echo "RPM Media " . $media_rpm / 1000 . "<br>";
            ?>
        </div>
    </div>
</div>