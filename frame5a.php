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

if(isset($_REQUEST["pos"])){
    $posizione = $_REQUEST["pos"];
    $var = $_REQUEST["var"];
    $riferimento = $_REQUEST["riferimento"];
}

?>


<div class="container dark">
    <div class="h2 text-center">Scegli file</div>

    <form action="frame2.php" target="centro">
        <select name="var">
          <?php
          for ($i = 0; $i < sizeof($id); $i++) {
            echo '<option value="' . $nome[$i] . '">' . $nome[$i] . '</option>';
          }
          ?>
        </select>
        <input type="hidden" name="pos" value="<?php echo $posizione ; ?>">

        <input type="hidden" name="riferimento" value="1">
        <input type="submit">
    </form>
    <form action="frame6.php" target="centro_conf">
        <input type="hidden" name="op" value="conf">
        <select name="var" id="l_confronta" >
            <?php
          for ($i = 0; $i < sizeof($id); $i++) {
                echo '<option value="' . $nome[$i] . '">' . $nome[$i] . '</option>';
            }
            ?>
        </select>
        <input type="hidden" name="pos" value="<?php echo $posizione ; ?>">

        <input type="hidden" name="riferimento" value="2">
        <input type="submit" id="b_confronta" >
    </form>



<!--   TENTATIVO
    <select name="var" id="grafico1">
    <?php
    //for ($i = 0; $i < sizeof($id); $i++) {
          //echo '<option value="' . $nome[$i] . '">' . $nome[$i] . '</option>';
      //}
      ?>
      </select>
      <select name="var2" id="grafico2">
      <?php
      //for ($i = 0; $i < sizeof($id); $i++) {
//echo '<option value="' . $nome[$i] . '">' . $nome[$i] . '</option>';
        //}
      ?>
        </select>
        <input type="button" value="invia" onClick="invia()">

  <script>
  function invia(){
    alert("ciao");
    let target = 0;
    let action = 0;
    let grafico;
    action = "frame2.php";
    target = "centro";
    grafico = document.getElementById("grafico1").value;
    alert(grafico);
    invia_dati(grafico,action,target,1);
    action = "frame6.php";
    target = "centro_conf";
    grafico = document.getElementById("grafico2").value;
    invia_dati(grafico,action,target,2);
  }

  function invia_dati(grafico,action,target,destinazione){
     var method = "POST"; // il metodo POST è usato di default
     var form = document.createElement("form");
     form.setAttribute("method", method);
     form.setAttribute("action", action);
     form.setAttribute("target", target);
     var tabella = document.createElement("input");
     tabella.setAttribute("type", "hidden");
     tabella.setAttribute("name", "var");
     tabella.setAttribute("value", grafico );
     form.appendChild(tabella);
     var destinatario = document.createElement("input");
     destinatario.setAttribute("type", "hidden");
     destinatario.setAttribute("name", "destinatario");
     destinatario.setAttribute("value", destinazione );
     form.appendChild(destinatario);
     document.body.appendChild(form);
     form.submit();
 }
  </script>
-->


  <!-- selezione grafico -->
    <div class="row">
        <div class="col">
            <div class="h3 text-center">Seleziona</div>
            <!--<a href="frame2.php?var=culo" target="centro">Cacca</a>-->
            <form action="frame2.php" target="centro">
                <input type="checkbox" name="grafici[]" value="gas">Gas<br>
                <input type="checkbox" name="grafici[]" value="brake">Brake<br>
                <input type="checkbox" name="grafici[]" value="gear">Gear<br>
                <input type="checkbox" name="grafici[]" value="boost">Boost<br>
                <input type="checkbox" name="grafici[]" value="rpm">RPM<br>
                <input type="checkbox" name="grafici[]" value="speed">Speed<br>
                <div class="text-center"><input type="submit"></div>
            </form>
             <form action="frame6.php" target="centro_conf">
                <input type="checkbox" name="grafici[]" value="gas">Gas<br>
                <input type="checkbox" name="grafici[]" value="brake">Brake<br>
                <input type="checkbox" name="grafici[]" value="gear">Gear<br>
                <input type="checkbox" name="grafici[]" value="boost">Boost<br>
                <input type="checkbox" name="grafici[]" value="rpm">RPM<br>
                <input type="checkbox" name="grafici[]" value="speed">Speed<br>
                <div class="text-center"><input type="submit"></div>
            </form>
        </div>
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
</div>
