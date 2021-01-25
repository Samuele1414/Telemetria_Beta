<!--
NOTE:
Informazioni di connessione
-->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "telemetria";
/* Connessione e selezione del database */
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connessione fallita: " . $conn->connect_error); //SE la connessione va bene
?>
