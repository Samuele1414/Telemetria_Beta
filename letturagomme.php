<?php
    include "config.php";
    $sql = "SELECT Temp_A_S, Temp_A_D, Temp_P_S, Temp_P_D FROM alpha";
    $risultato = $conn->query($sql);
    $i = 0;
    if ($risultato->num_rows > 0) {
        while ($row = $risultato->fetch_assoc()) {
            $gomma_f_l[$i] = $row["Temp_A_S"];
            $gomma_f_r[$i] = $row["Temp_A_D"];
            $gomma_r_l[$i] = $row["Temp_P_S"];
            $gomma_r_r[$i] = $row["Temp_P_D"];
            $i++;
        }
    }

?>