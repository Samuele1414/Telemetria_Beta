<!--
NOTE:
Lettura file e creazione tabelle

FUNZIONAMENTO:

-->
<?php

include "config.php";
if (isset($_REQUEST["nuovo"])) {
    $nometab = $_REQUEST["nome"];
    $sql = "CREATE TABLE $nometab ( 
    ID INT NOT NULL AUTO_INCREMENT ,
    Gas INT NOT NULL ,
    Brake INT NOT NULL ,
    Gear INT NOT NULL ,
    Boost INT NOT NULL ,
    RPM INT NOT NULL ,
    Speed INT NOT NULL ,
    Temp_A_S INT NOT NULL , 
    Temp_A_D INT NOT NULL ,
    Temp_P_S INT NOT NULL , 
    Temp_P_D INT NOT NULL ,
    PRIMARY KEY (ID)); ";
    if ($conn->query($sql) === TRUE) {
        //echo "<script>alert('Utente Aggiunto correttamente'); </script>";
        echo "Crezione tabella completato <br>";
    } else {
        echo "Errore: " . $sql . "<br>" . $conn->error;
    }
    //SALVATAGGIO CSV
    $cartella = "upload/";
    $file_nome = $_FILES["file"]["name"];
    echo $file_nome . "<br>";
    $nomenuovo = $nometab . "_csv.csv";
    $destinazione = $cartella . $file_nome;
    $destinazione = $cartella . $nomenuovo;
    move_uploaded_file($_FILES['file']['tmp_name'], $destinazione);
    //rename($cartella . $_FILES['file']['tmp_name'],$cartella.$nomenuovo);

    $fileHandle = fopen($destinazione, "r");
    $i = 0;
    while (($row = fgetcsv($fileHandle, 0, ",")) !== FALSE) {
        $acceleratore[$i] = $row[0];
        $freno[$i] = $row[1];
        $marcia[$i] = $row[2];
        $boost[$i] = $row[3];
        $rpm[$i] = $row[4];
        $velocita[$i] = $row[5];
        $i++;
    }
    for ($i = 0; $i < sizeof($acceleratore); $i++) {
        $sql = "INSERT INTO $nometab (Gas,Brake,Gear,Boost,RPM,Speed) VALUES('$acceleratore[$i]','$freno[$i]','$marcia[$i]','$boost[$i]','$rpm[$i]', '$velocita[$i]')";
        if ($conn->query($sql) === TRUE) {
            //echo "<script>alert('Utente Aggiunto correttamente'); </script>";
        } else {
            echo "Errore: " . $sql . "<br>" . $conn->error;
        }
    }
    echo "Caricamento completato<br>";

    $sql = "INSERT INTO tabelle (Nome) VALUES('$nometab')";
    if ($conn->query($sql) === TRUE) {
        //echo "<script>alert('Utente Aggiunto correttamente'); </script>";
        echo "Inserimento dentro la tabella avvenuto con successo<br>";
    } else {
        echo "Errore: " . $sql . "<br>" . $conn->error;
    }
}

?>