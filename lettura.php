<!--
NOTE:
Lettura Database per grafici telemetria
-->
<?php
if(isset($_REQUEST["riferimento"])){
    $pagina = $_REQUEST["riferimento"];
    echo $pagina;
}



if (isset($_REQUEST["var"])) {
    $var = $_REQUEST["var"];
    if($var == -1){
      $sql = "SELECT Gas, Brake, Gear, Boost,RPM,Speed FROM cazzo"; 
    }else{ 
        $sql = "SELECT Gas, Brake, Gear, Boost,RPM,Speed FROM $var";   
    }
    
} else {
   $sql = "SELECT Gas, Brake, Gear, Boost,RPM,Speed FROM cazzo"; 
    $var = -1;
}
echo $var; //DEBUG
$risultato = $conn->query($sql);
$i = 0;
if (isset($_REQUEST["grafici"])) {
    $grafici_check = $_REQUEST["grafici"];
    // for($i = 0; $i < sizeof($grafici_check); $i++){
    // echo $grafici_check[$i];
    //}
    if ($risultato->num_rows > 0) {
        while ($row = $risultato->fetch_assoc()) {
            if (in_array("gas", $grafici_check)) {
                $gas[$i] = $row["Gas"];
            } else {
                $gas[$i] = -1;
            }
            if (in_array("brake", $grafici_check)) {
                $brake[$i] = $row["Brake"];
            } else {
                $brake[$i] = -1;
            }
            if (in_array("gear", $grafici_check)) {
                $gear[$i] = $row["Gear"];
            } else {
                $gear[$i] = -1;
            }
            if (in_array("boost", $grafici_check)) {
                $boost[$i] = $row["Boost"];
            } else {
                $boost[$i] = -1;
            }
            if (in_array("rpm", $grafici_check)) {
                $rpm[$i] = $row["RPM"];
            } else {
                $rpm[$i] = -1;
            }
            if (in_array("speed", $grafici_check)) {
                $speed[$i] = $row["Speed"];
            } else {
                $speed[$i] = -1;
            }
            $i++;
        }
    }
} else {
    if ($risultato->num_rows > 0) {
        while ($row = $risultato->fetch_assoc()) {
            $gas[$i] = $row["Gas"];
            $brake[$i] = $row["Brake"];
            $gear[$i] = $row["Gear"];
            $boost[$i] = $row["Boost"];
            $rpm[$i] = $row["RPM"];
            $speed[$i] = $row["Speed"];
            $i++;
        }
    }
}

if(isset($_REQUEST["pos"])){
    $posizione = $_REQUEST["pos"];
    //echo $posizione;
}else{
    $posizione = -1;
}

?>


