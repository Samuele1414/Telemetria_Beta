<!--
NOTE:
In questa pagina viene disegnata la struttura della macchina
-->
<?php
    include "letturagomme.php";
    if(isset($_REQUEST["pos"])){
        $posizione = $_REQUEST["pos"];
    }else{
        $posizione = -1;
    }
    
?>
<script>
    
    function setup() {
        var canvasauto = createCanvas(500, 500);
        canvasauto.parent("divauto");
        var gomma_f_l = <?php echo json_encode($gomma_f_l); ?>;
        var gomma_f_r = <?php echo json_encode($gomma_f_r); ?>;
        var gomma_r_l = <?php echo json_encode($gomma_r_l); ?>;
        var gomma_r_r = <?php echo json_encode($gomma_r_r); ?>;
        var posizione = <?php echo $posizione; ?>;
        if(posizione != -1){
            disegna_auto(gomma_f_l,gomma_f_r,gomma_r_l,gomma_r_r,posizione); 
        }else{
            disegna_auto(gomma_f_l,gomma_f_r,gomma_r_l,gomma_r_r,2); 
        }
        //richiama funzione disegna
    }

    //Disegna il telaio e ruote con funzioni
    function disegna_auto(gomma_f_l,gomma_f_r,gomma_r_l,gomma_r_r,posizione) {
        color(255, 255, 255); //colore nero
        telaio(); //disegna telaio
        tutte_ruote(gomma_f_l,gomma_f_r,gomma_r_l,gomma_r_r,posizione); //disegna ruote
    }

    //disegno del telaio
    function telaio() {
        var sopra = 70;
        var sotto = 370;
        var centro = 190;
        line(centro, sopra, centro, sotto); //centrale
        line(100, sopra, 300, sopra);	//sopra
        line(100, sotto, 300, sotto);	//sotto
    }

    function tutte_ruote(gomma_f_l,gomma_f_r,gomma_r_l,gomma_r_r,posizione) {
        var dimensione = 80;
        r_a_sin(dimensione,gomma_f_l,posizione); //anteriore sinistra
        r_a_des(dimensione,gomma_f_r,posizione); //anterio destra
        r_p_sin(dimensione,gomma_r_l,posizione); //posteriore sinistra
        r_p_des(dimensione,gomma_r_r,posizione); //posteriore destra
    }

    function r_a_sin(dimensione,gomma_f_l,posizione) {	//anteriore sinistra
        var temperatura = gomma_f_l[posizione];//temperatura gomma
        scelta_temperatura(temperatura);//funzione scelta colore gomma
        rect(50, 30, dimensione, dimensione, 20);	//disegno gomma x,y,larghezza,profondita,curvatura angoli
        var x = 65, y = 80; //coordinate testo
        testo_temperatura(x, y, temperatura); //funciton scrittura testo
    }

    function r_a_des(dimensione,gomma_f_r,posizione) {//anterio destra
        var temperatura = gomma_f_r[posizione];
        scelta_temperatura(temperatura);
        rect(250, 30, dimensione, dimensione, 20);
        var x = 270, y = 80;
        testo_temperatura(x, y, temperatura);
    }

    function r_p_sin(dimensione,gomma_r_l,posizione) {//posteriore sinistra
        var temperatura = gomma_r_l[posizione];
        scelta_temperatura(temperatura);
        rect(50, 330, dimensione, dimensione, 20);
        var x = 65, y = 380;
        testo_temperatura(x, y, temperatura);
    }

    function r_p_des(dimensione,gomma_r_r,posizione) {//posteriore destra
        var temperatura = gomma_r_r[posizione];
        scelta_temperatura(temperatura);
        rect(250, 330, dimensione, dimensione, 20);
        var x = 270, y = 380;
        testo_temperatura(x, y, temperatura);
    }

    //Scrittura testo riceve da ogni gomma x, y e temperatura
    function testo_temperatura(x, y, temperatura) {
        fill(0); //COLORE NERO
        textSize(30); //grandezza testo 30
        text(temperatura + "°", x, y); //scrittura testo
    }

    function scelta_temperatura(temperatura) {
        var temperatura_gomma_rosso = 120;
        var temperatura_gomma_giallo = 100;
        var temperatura_gomma_verde = 70;
        var temperatura_gomma_blu = 0;
        if (temperatura < temperatura_gomma_verde) {
            fill(0, 0, 255);	//blu se sotto 100
        } else if ((temperatura >= temperatura_gomma_verde) && (temperatura < temperatura_gomma_giallo)) {
            fill(0, 255, 0); //verde se tra 100 e 130
        } else if ((temperatura >= temperatura_gomma_giallo) && (temperatura < temperatura_gomma_rosso)) {
            fill(255, 145, 0); //arancio tra 130 e 150
        } else if (temperatura > temperatura_gomma_rosso) {
            fill(255, 0, 0); //rosso oltre 150
        }
    }

    function draw() {
    }

</script>