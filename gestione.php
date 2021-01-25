<?php
switch ($operazione) {
    case "elimina":
        $sql = "DELETE FROM anagrafica WHERE idanagrafica = '$id_ricevuto'";
        if ($conn->query($sql) === TRUE) {
            include("tabella.php");
        } else {
            echo "Errore: " . $sql . "<br>" . $conn->error;
        }
        break;
    case "aggiungi":
        $id_creato = $_REQUEST["id"];
        $nome_modificare = $_REQUEST["nome_modifica"];
        $cognome_modificare = $_REQUEST["cognome_modifica"];
        $eta_modificare = $_REQUEST["eta_modifica"];
        $citta_modificare = $_REQUEST["citta_modifica"];
        if (isset($_REQUEST["patente_modifica"])) {
            $patente_modificare = 1; //SE ESISTE
        } else {
            //SE NON ESITE patente_modificare
            $patente_modificare = 0;
        }
        $sql = "INSERT INTO anagrafica (idanagrafica,nome,cognome,eta,citta,patentato) VALUES('$id_creato','$nome_modificare','$cognome_modificare','$eta_modificare','$citta_modificare','$patente_modificare')";

        if ($conn->query($sql) === TRUE) {
            //echo "<script>alert('Utente Aggiunto correttamente'); </script>";
            include("tabella.php");
        } else {
            echo "Errore: " . $sql . "<br>" . $conn->error;
        }
        break;
    case "modifica":
        $id_modificare = $_REQUEST["id"];
        $nome_modificare = $_REQUEST["nome_modifica"];
        $cognome_modificare = $_REQUEST["cognome_modifica"];
        $eta_modificare = $_REQUEST["eta_modifica"];
        $citta_modificare = $_REQUEST["citta_modifica"];
        if (isset($_REQUEST["patente_modifica"])) {
            $patente_modificare = 1; //SE ESISTE
        } else {
            //SE NON ESITE patente_modificare
            $patente_modificare = 0;
        }
        //echo $nome_modificare; //DEBUG
        //QUERY UPDATE
        $sql = "UPDATE anagrafica 
				SET 
					cognome = '$cognome_modificare',
					nome = '$nome_modificare',
					eta = '$eta_modificare',
					citta = '$citta_modificare',
					patentato = '$patente_modificare'
				WHERE
					idanagrafica = '$id_modificare'";

        if ($conn->query($sql) === TRUE) {
            include("tabella.php");
        } else {
            echo "Errore: " . $sql . "<br>" . $conn->error;
        }
        break;


}


?>