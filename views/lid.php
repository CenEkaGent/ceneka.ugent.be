<?php include_once 'layouts/main/header.php'?>
<script>
$(document).ready(function(){
    $('.button').click(function(){
        var clickBtnValue = $(this).val();
        var famNaam = $('#familienaam').val();
        var voorNaam = $('#voornaam').val();
        var faculteit = $('#faculteit').val();
        var richting = $('#richting').val();
        var studentenNummer = $('#studentID').val();
        var email = $('#email').val();
        var opmerkingen = $('#opmerkingen').val();
        
    })
})
</script>
<div id="lid" class="columns is-centered">
<div class="column is-8 is-offset-1">
    <h1 class="title is-1" style="margin-top: 1.5rem;">Nieuw lid toevoegen</h1>
    <div class="tile is-ancestor is-vertical">
        <div class="tile is-parent is-12">
            <div class="tile is-child">
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" >Naam</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" type="text" placeholder="Familienaam" id="familienaam">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" >Voornaam</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" type="text" placeholder="Voornaam" id="voornaam">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" >Faculteit</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" type="text" placeholder="Faculteit" id="faculteit">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" >Richting</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" type="text" placeholder="Richting" id="richting">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" >StudentID</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" type="text" placeholder="Studentennummer" id="studentID">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" >E-mail</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" type="text" placeholder="E-mail" id="email">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" >Opmerkingen</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <textarea name="Opmerkingen" id="opmerkingen" class="textarea" placeholder="Opmerkingen" id="opmerkingen"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <p class="control">
                        <button class="button is-success is-inverted" value="Voeg Toe">
                        Voeg Toe
                        </button>
                        <button class="button is-inverted is-info">
                        Pas Aan
                        </button>
                        <button class="button is-inverted is-danger">
                        Verwijder
                        </button>
                    </p>
                </div>
            </div>
            
        </div>
    </div>
</div>
<?php
function write(){
    echo 'TEST';
}
?>

<?php include_once 'layouts/main/footer.php' ?>
