<!--
NOTE:
Lettura tabelle e scelta del grafico
Riquadro centrale in basso a destra
-->
<?php
include "top.php";
include "config.php";
include "lettura.php";
$sql = "SELECT ID_Tabella, Nome FROM tabelle";
$risultato = $conn->query($sql);
$i = 0;
if ($risultato->num_rows > 0) {
    while ($row = $risultato->fetch_assoc()) {
        $id[$i] = $row["ID_Tabella"];
        $nome[$i] = $row["Nome"];
        $i++;
    }
}
?>


<div class="container dark">
    <div class="h2 text-center">Scegli file</div>
    <!-- FORM SCELTA -->
    <form action="frame2.php" target="centro">
        <select name="var">
            <?php
            for ($i = 0; $i < sizeof($id); $i++) {
                echo '<option value="' . $nome[$i] . '">' . $nome[$i] . '</option>';
            }
            ?>
        </select>
        <input type="submit">
    </form>

    <div class="row">
        <div class="col">
            <div class="h3 text-center">Seleziona</div>
            <!--<a href="frame2.php?var=culo" target="centro">Cacca</a>-->
            <form action="frame2.php" target="centro">
              <input type="hidden" name="var" value="<?php echo $var; ?>">
                <input type="checkbox" name="grafici[]" value="gas">Gas<br>
                <input type="checkbox" name="grafici[]" value="brake">Brake<br>
                <input type="checkbox" name="grafici[]" value="gear">Gear<br>
                <input type="checkbox" name="grafici[]" value="boost">Boost<br>
                <input type="checkbox" name="grafici[]" value="rpm">RPM<br>
                <input type="checkbox" name="grafici[]" value="speed">Speed<br>
                <div class="text-center"><input type="submit"></div>
            </form>
        </div>

        <!--
        <div class="col ">
            <div class="h3 text-center">Aggiungi</div>
            <form action="leggi.php" method="POST" target="_blank" enctype="multipart/form-data">
                <div class="text-center">Nome</div>
                <div class="text-center"><input type="text" name="nome" required></div>
                <div class="text-center"><input type="file" name="file" required></div>
                <input type="hidden" name="nuovo" value="1">
                <div class="text-center"><input type="submit" value="Aggiungi"></div>
            </form>
        </div>
    </div>
          -->
</div>
