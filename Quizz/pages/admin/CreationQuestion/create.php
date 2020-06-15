
<div class="question">
        <div class="enteteCQuestion">
            <h3 >Creer vos questions ici</h3>
        </div>
    <form action="" method="post">
        <div class="formu-question">
            <div>
                <label for="" class="labelQuestion">Questions</label>
                <input type="text" name="typetext" size="30" class="champ">
            </div><br><br>
            <div>
                    <label for="" class="labelQuestion" >Nbre de Points</label>
                    <input type="number" name="nbrepoints" id="nbrpoints" min="1">
            </div><br>
            <div id="inputs">
                <div class="selct">
                    <label for="" class="labelQuestion"><strong>Type de Réponse</strong></label>
                    <select name="select" id="selct" value="">
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
            <div id="error-1" style="font-size: 15px"></div>
            <div>
                <input type="submit" name="valider" value="Enregistrer" class="boutonEnregistrer" id="btn_enregistrer">
            </div>
        </div>    
    </form>
</div>
<script>
$(function(){
    $('#btn_enregistrer').on("click", function(){
            // alert("ok");
            console.log($('form').serialize());
            alert($('form').serialize());
            $.post( "Quizz/pages/admin/questionForm/questionform.php",$('form').serialize(),function(){
                $('.enregistrer').html("Votre question est enregistrer avec succes");
            });
            return false;
        });
})
</script>
</div>

<script>
    
    var nbrRow = 0;

    function onAddInput() {
        
        nbrRow++;
        var nb = document.getElementById('nbrchamp');
        nb.value = nbrRow;
        var selct = document.getElementById('selct');
        var divInputs = document.getElementById('inputs');
        var newInput = document.createElement('div');
        newInput.setAttribute('class', 'row');
        newInput.setAttribute('id', 'row_' + nbrRow);

        if (selct.value == "text") {
            newInput.innerHTML = `<label for="" class="labelReponse"><strong>Réponse${nbrRow}</strong></label>
                    <input type="text" name="rep_texte" class="champ font" style="height: 30px;width: 300px;">
                    <button type="button" class="btn_supprimer" onclick="onDeleteInput(${nbrRow})"></button>`;
        }
        if (selct.value == "choix_simple") {
            newInput.innerHTML = `<label for="" class="labelReponse"><strong>Réponse${nbrRow}</strong></label>
                    <input type="text" name="rep_texte${nbrRow}" class="champ font" style="height: 30px;width: 300px;">
                    <input type="radio" name="radio" value="${nbrRow}" style="height: 20px;width: 20px;">
                    <button type="button" class="btn_supprimer" onclick="onDeleteInput(${nbrRow})"></button>`;
        }
        if (selct.value == "Choix_multiple") {
            newInput.innerHTML = `<label for="" class="labelReponse"><strong>Réponse${nbrRow}</strong></label>
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
            if (!target.style.opacity){
        
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

