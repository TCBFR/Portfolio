<?php
$title = 'contact';
include 'elements/header.php';
?>
<h1>Contactez-nous</h1>
<div style="display:flex;">
    <div>
        <iframe class="image" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2814.0270231927184!2d1.5281178761239353!3d45.1460489710705!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f897fd9659f35b%3A0xa054a718bd8b0345!2sLyc%C3%A9e%20Bahuet!5e0!3m2!1sfr!2sfr!4v1730880404478!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="Destinataire">
        <h3>Adresse mail</h3>
        <p> Tech.Solu@gmail.com<p>
        <h3>Telephone</h3>
        <p>06 64 52 81 13<p>
    </div>
</div>
<form>
<fieldset >
    <legend>Service Client</legend>
    <div class="Formulaire">
        <div>
            <label for="option1">Mr.</label>
            <input type="radio" name="choix" value="option1" id="option1">
            <label for="option2">Mme.</label>
            <input type="radio" name="choix" value="option2" id="option2">
        </div>
        <p>Entrez votre Prenom*</p>
        <input type="text" id="firsname" name="user_firsname" placeholder="Prenom" required><br><br>
        
        <p>Entrez votre Nom*</p>
        <input type="text" id="name" name="user_name" placeholder="Nom" required><br><br>
        
        <p>Entrez votre adresse Mail*</p>
        <input type="email" id="email" name="email" placeholder="abc@gmail.com" required><br><br>
        
        <p>Choisissez votre demande*</p>
        <select id="multi" name="multi" required><br><br>
            <option disabled and selected>Choisissez une demande...</option>
            <option>Devis</option>
            <option>Question</option>
        </select>
        <p>Votre message :</p>
        <textarea type="texterea" id="message" name="message" rows="2" cols="25"></textarea>
        <div>
            <button type="submit">Envoyer votre demande
        </div>  
    </div> 
</fieldset>
</form>  
</div>
<style>
    .Align{
        display: flex;
        align-items: flex-start;
    }
    .Destinataire{
        margin-left: 100px;
    } 
    </style>
<?php
include 'elements/footer.php';
