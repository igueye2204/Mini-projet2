<?php
$json1 = array();
$j1 = array();
$error1 = $error2 = $error3 = $error4 = $error5 = $error6 = "";
$issucces = false;
if (isset($_POST['valider'])) {

    // ============== J'initialise mon tableau =================
    $json1 = array(
        "question" => htmlspecialchars(trim($_POST['typetext'])),
        "nbrepoints" => htmlspecialchars(trim($_POST['nbrepoints'])),
        "typequestion" => htmlspecialchars(trim($_POST['select']))
    );
    $issucces=true;
    if(empty($json1["question"]) || empty($json1["nbrepoints"]) || empty($json1["typequestion"]))
    {
        $error1="ERREUR! Ces champs sont obligatoires!";
        $issucces=false;
    }
    // ==========================================================

    // ==================== Je verifie le choix =================
    // 1. C'est Soit Choix Multiple 
    //        Pour Choix multiple je recupere les inputs des champs générés et 
    //        Et je verifie les checkbox cochés
    // 2. CHOIX Simple
    //         C'est la meme chose que le choix multiple mais ici on verifie 
    //         Une seule case coché qui est bouton radio
    // 3. Choix Texte
    //        Il suffit seulement de recuperer Le champ input generé
   
        if ($_POST['select'] == "Choix_multiple") {

            for ($i = 0; $i <= (int) $_POST['nbrchamp']; $i++) {
                if (isset($_POST["rep_texte$i"])) {
                    $tabrep[$i]['valeur'] = $_POST["rep_texte$i"];
                    if (in_array($i, $_POST['cocher'])) {
                        $tabrep[$i]['statut'] = true;
                    } else {
                        $tabrep[$i]['statut'] = false;
                    }
                }
            }
        } elseif ($_POST['select'] == "choix_simple") {
            for ($i = 0; $i <= (int) $_POST['nbrchamp']; $i++) {
                if (isset($_POST["rep_texte$i"])) {
                    $tabrep[$i]['valeur'] = $_POST["rep_texte$i"];
                    if ($i == (int) $_POST['radio']) {
                        $tabrep[$i]['statut'] = true;
                    } else {
                        $tabrep[$i]['statut'] = false;
                    }
                }
            }
        } elseif ($_POST['select'] == "text") {
            $tabrep = $_POST["rep_texte"];
        }
        $json1['reponses'] = $tabrep;
    if($issucces=true)
    {    
    // =======================================================================
    // ====================== Enregistrement dans ============================
    //                    Fichier Json  Qestions.json
    
        $dataquestion = getData('Questions');
        $dataquestion[] = $json1;
        $dataquestion = json_encode($dataquestion);
        $dataquestion = file_put_contents('./Quizz/data/Questions.json', $dataquestion);
    
    
    // ======================== FIN ===========================================
    }
}
?>
<div class="question">
    <div>
        <h3 style="font-size: x-large;color: #51bfd0;margin-left:100px;">PARAMETRER VOTRE QUESTION</h3>
    </div>
    <form action="" method="post">
        <div class="formu-question">
            <div>
                <label for="">Questions</label>
                <input type="text" name="typetext" size="50" class="champ">
            </div><br><br>
            <div id="inputs">
                <div>
                    <label for="">Nbre de Points</label>
                    <input type="number" name="nbrepoints" id="nbrpoints" min="1" style="width: 70px;border:0px;">
                </div><br>
                <div class="selct">
                    <label for=""><strong>Type de Réponse</strong></label>
                    <select name="select" id="selct" value="" style="width: 300px;height: 40px;">
                        <option value="">Donnez type de réponse</option>
                        <option value="text">Text</option>
                        <option value="choix_simple">Choix simple</option>
                        <option value="Choix_multiple">Choix multiple</option>
                    </select>
                    <button type="button" class="btn_ajout" onclick="onAddInput()"></button>
                    <input type="hidden" name="nbrchamp" id="nbrchamp">
                </div>
            </div>

            <div class="row">

            </div>
            <br>
            <div id="error-1" style="font-size: 15px"><?= $error1 ?></div>
            <div>
                <input type="submit" name="valider" value="Enregistrer" class="bouton" style="position: absolute;top: 490px;left: 430px;">
            </div>
            <div>
            </div>
    </form>

</div>
</div>
<script>
    var nbrRow = 0;

    function onAddInput() {
        nbrRow++;
        var nb = document.getElementById('nbrchamp');
        nb.value = nbrRow;
        // alert(nb.value);
        var selct = document.getElementById('selct');
        var divInputs = document.getElementById('inputs');
        var newInput = document.createElement('div');
        newInput.setAttribute('class', 'row');
        newInput.setAttribute('id', 'row_' + nbrRow);
        if (selct.value == "text") {
            newInput.innerHTML = `<label for=""><strong>Réponse${nbrRow}</strong></label>
                    <input type="text" name="rep_texte" class="champ font" style="height: 30px;width: 300px;">
                    <button type="button" class="btn_supprimer" onclick="onDeleteInput(${nbrRow})"></button>`;
        }
        if (selct.value == "choix_simple") {
            newInput.innerHTML = `<label for=""><strong>Réponse${nbrRow}</strong></label>
                    <input type="text" name="rep_texte${nbrRow}" class="champ font" style="height: 30px;width: 300px;">
                    <input type="radio" name="radio" value="${nbrRow}" style="height: 20px;width: 20px;">
                    <button type="button" class="btn_supprimer" onclick="onDeleteInput(${nbrRow})"></button>`;
        }
        if (selct.value == "Choix_multiple") {
            newInput.innerHTML = `<label for=""><strong>Réponse${nbrRow}</strong></label>
                    <input type="text" name="rep_texte${nbrRow}" class="champ font" style="height: 30px;width: 300px;">
                    <input type="checkbox" name="cocher[]" value="${nbrRow}" style="height: 20px;width: 20px;">
                    <button type="button" class="btn_supprimer" onclick="onDeleteInput(${nbrRow})"></button>`;
        }

        divInputs.appendChild(newInput);
    }


    function onDeleteInput(n) {
        var target = document.getElementById('row_' + n);
        setTimeout(function() {
            target.remove();
        }, 700);
        fadeOut('row_' + n);
    }

    function fadeOut(idTarget) {
        var target = document.getElementById(idTarget);
        var effect = setInterval(function() {
            if (!target.style.opacity) {
                target.style.opacity = 1;
            }
            if (target.style.opacity > 0) {
                target.style.opacity -= 0.1;
            } else {
                clearInterval(effect);
            }
        }, 200)
    }
</script>