<!--
NOTE:
In questa pagina vengono disegnati i grafici
-->



<!-- Passaggio valori -->
<script>
    var acc = <?php echo json_encode($gas); ?>;
    var freno = <?php echo json_encode($brake); ?>;
    var marcia = <?php echo json_encode($gear); ?>;
    var boost = <?php echo json_encode($boost); ?>;
    var rpm = <?php echo json_encode($rpm); ?>;
    var velocita = <?php echo json_encode($speed); ?>;
    var quantita = <?php echo sizeof($gas); ?>;
    var posizione = <?php echo $posizione; ?>;
    var grafico = <?php echo json_encode($var); ?>;
</script>
<script>
    function range_valori() {
        var variabile_range = document.getElementById("valori");
        var valore_range = variabile_range.value;
        alert(valore_range);
    }
</script>
<script>

    var moltiplica = 1;
    var valore_prima = 0;
    var valore_dopo = 0;
    var assex_prima = 0;
    var assex_dopo = 0;

    function setup() {
        var quantita = <?php echo sizeof($gas); ?>;
        var canvastelemetria = createCanvas(quantita, 1500);
        canvastelemetria.parent("idnameofdiv");
        disegna_compresso();
        //VERSIONE VECCHIA NON COMPRESSA
        //disegna();
        if(posizione == -1){

        }else{
            disengna_linea(posizione);
        }
    }

    function disegna_compresso(){
        var r = 0;
        var g = 0;
        var b = 0;
        var moltiplica = 1;
        var moltiplica_y = 1;
        var y = 0;
        //gas
        g = 255;
        y = 300;
        draw(acc,r,g,b,moltiplica,moltiplica_y,y,quantita);
        //freno
        r = 255;
        g = 0;
        y = 300;
        draw(freno,r,g,b,moltiplica,moltiplica_y,y,quantita);
        //marce
        r = 30;
        g = 144;
        b = 255;
        y = 500;
        moltiplica_y = 20;
        draw(marcia,r,g,b,moltiplica,moltiplica_y,y,quantita);
        //velocita
        r = 255;
        g = 255;
        b = 0;
        y = 850;
        moltiplica_y = 1;
        draw(velocita,r,g,b,moltiplica,moltiplica_y,y,quantita);
        //rpm
        r = 0;
        g = 255;
        b = 255;
        y = 1100;
        moltiplica_y = 0.02;
        draw(rpm,r,g,b,moltiplica,moltiplica_y,y,quantita);
    }

    function draw(vettore,r,g,b,moltiplica,moltiplica_y,y,quantita){
        for (var i = 0; i < quantita; i++) {
            //line(1000- acc[i],i-1,1000-acc[i+1],i);
            stroke(r, g, b);
            valore_prima = vettore[i] * moltiplica_y;
            assex_prima = (i - 1) * moltiplica;
            valore_dopo = vettore[i + 1] * moltiplica_y;
            assex_dopo = i * moltiplica;
            if (vettore[i] != -1) {
                line(assex_prima, y - valore_prima, assex_dopo, y - valore_dopo);
            }
        }
    }


    function mouseClicked() {
        stroke(255, 255, 255);
        background(27, 30, 37);
        textSize(16);
        fill(255,255,255);
        text("Valore " + Math.floor(mouseX), 10, 60);
        if (acc[Math.floor(mouseX)] != -1) {
            text("Gas " + Math.floor(acc[Math.floor(mouseX)]) + "%", 10, 80);
        }
        if (freno[Math.floor(mouseX)] != -1) {
            text("Freno " + Math.floor(freno[Math.floor(Math.floor(mouseX))]) + "%", 10, 100);
        }
        if (marcia[Math.floor(mouseX)] != -1) {
            text("Marcia " + marcia[Math.floor(mouseX)], 10, 120);
        }
        if (velocita[Math.floor(mouseX)] != -1) {
            text("Velocità " + Math.floor(velocita[Math.floor(mouseX)]) + "Km/h", 10, 140);
        }
        if (rpm[Math.floor(mouseX)] != -1) {
            text("RPM " + Math.floor(rpm[Math.floor(mouseX)]) + "Rpm", 10, 160);
        }
        stroke(255, 255, 255);
        line(mouseX, 0, mouseX, 2000);
        disegna_compresso();
        var grafico = <?php echo json_encode($var); ?>;
        var riferimento = <?php echo $riferimento; ?>;
        let target = 0;
        let action = 0;
        action = "frame4.php";
        target = "auto";
        invia_dati(mouseX, grafico,action,target,riferimento);
        action = "frame2.php";
        target = "centro";
        invia_dati(mouseX, grafico,action,target,riferimento);
        action = "frame5.php";
        target = "main";
        invia_dati(mouseX, grafico,action,target,riferimento);

    }
     function invia_dati(mouseX, grafico,action,target,riferimento){
        var method = "POST"; // il metodo POST è usato di default
        var form = document.createElement("form");
        form.setAttribute("method", method);
        form.setAttribute("action", action);
        form.setAttribute("target", target);
        var hiddenField = document.createElement("input");
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", "pos");
        hiddenField.setAttribute("value", mouseX);
        var tabella = document.createElement("input");
        tabella.setAttribute("type", "hidden");
        tabella.setAttribute("name", "var");
        tabella.setAttribute("value", grafico );
        form.appendChild(tabella);
        var invia_riferimento = document.createElement("input");
        invia_riferimento.setAttribute("type", "hidden");
        invia_riferimento.setAttribute("name", "riferimento");
        invia_riferimento.setAttribute("value", riferimento );
        form.appendChild(invia_riferimento);
        form.appendChild(hiddenField);
        document.body.appendChild(form);
        form.submit();
    }


    function disengna_linea(posizione){
        stroke(255, 255, 255);
        background(27, 30, 37);
        textSize(16);
        fill(255,255,255);
        text("Valore " + Math.floor(posizione), posizione, 60);
        if (acc[Math.floor(posizione)] != -1) {
            text("Gas " + Math.floor(acc[Math.floor(posizione)]) + "%", posizione, 80);
        }
        if (freno[Math.floor(posizione)] != -1) {
            text("Freno " + Math.floor(freno[Math.floor(Math.floor(posizione))]) + "%", posizione, 100);
        }
        if (marcia[Math.floor(posizione)] != -1) {
            text("Marcia " + marcia[Math.floor(posizione)], posizione, 120);
        }
        if (velocita[Math.floor(posizione)] != -1) {
            text("Velocità " + Math.floor(velocita[Math.floor(posizione)]) + "Km/h", posizione, 140);
        }
        if (rpm[Math.floor(posizione)] != -1) {
            text("RPM " + Math.floor(rpm[Math.floor(posizione)]) + "Rpm", posizione, 160);
        }
        stroke(255, 255, 255);
        line(posizione, 0, posizione, 2000);
        disegna_compresso();
    }
</script>
