<?php session_start();?>
<?php
if  (isset ($_SESSION["Log"])){

require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions
$db = connexionBase(); // Appel de la fonction de connexion

$log = $_SESSION["Log"];
$requete = "SELECT * FROM users where us_log=\"$log\""; //concatenantion d'une chaine de caractère
$result = $db->prepare($requete);
$result->execute();
$result = $db->query($requete);
// Renvoi de l'enregistrement sous forme d'un objet
$utilisateur = $result->fetch(PDO::FETCH_OBJ);
$status = $utilisateur->us_status;
?>



<?php

$nameErr = $prenomErr = $sexeErr = $dateErr = $cpErr = $adrErr = $villeErr = $mailErr = $questErr = $selectErr = "";
$nomOk = $prenomOk = $sexe1Ok = $sexe2Ok = $dateOk = $cpOk = $adrOk = $villeOk = $mailOk = $questOk = $selectOk0 = $selectOk1 = $selectOk2 = $selectOk3 = $selectOk4 = false;

if ((isset($_POST["submit"])) and ( !(preg_match('#[A-Z]{1}[a-z]*#', $_POST["Nom"]) and  preg_match('#[A-Z]{1}[a-z]*#', $_POST["Prenom"]) and (isset($_POST['sexe'])) and preg_match('#[0-9]{2}\/[0-9]{2}\/[0-9]{4}#', $_POST["date"]) and preg_match('#[0-9]{5}#', $_POST["CodePostal"])
         and preg_match('#[1-9]+ .* [0-9]{5} [A-Z]{1}[a-z]#', $_POST["Adresse"]) and preg_match('#[_a-z0-9-]+(.\[_a-z0-9-]+)*@[a-z]+\.[a-z]{2,3}#', $_POST["courriel"]) and (!($_POST['Sujet']) == 0) and preg_match('#.+#', $_POST["question"])  ) || true == true ) ){

    
    if (empty($_POST['Nom']) || !preg_match('#[A-Z]{1}[a-z]*#', $_POST["Nom"])) {
         $nameErr = "Entrez un nom valide format Nom";
     }
    else{
        $nomOk = true;
       
    }

    if (empty($_POST['Prenom']) || !preg_match('#[A-Z]{1}[a-z]*#', $_POST["Prenom"])) {
        $prenomErr = "Entrez un prénom valide format Prenom";
    }
    else{
       $prenomOk = true;
    }

    if (!(isset($_POST['sexe']))){
       $sexeErr = "Veuillez renseigner un sexe";
    } 
    else if (($_POST['sexe'] =='F')){$sexe1Ok = true;}
    else {$sexe2Ok = true;}
    
    if (empty($_POST['date']) || !preg_match('#[0-9]{2}\/[0-9]{2}\/[0-9]{4}#', $_POST["date"])) {
        $dateErr = "Entrez une date valide format jj/mm/aaaa";
    }
    else{
       $dateOk = true;
    }

    if (empty($_POST['CodePostal']) || !preg_match('#[0-9]{5}#', $_POST["CodePostal"])) {
        $cpErr = "Entrez un code postal valide à 5 chiffres";
    }
    else{
        $cpOk = true;
    }

    if (empty($_POST['Adresse']) || !preg_match('#[1-9]+ .*#', $_POST["Adresse"])) {
        $adrErr = "Entrez une adresse valide";
    }
    else{
       $adrOk = true;
    }

    if (empty($_POST['Ville']) || !preg_match('#[A-Z]{1}[a-z]*#', $_POST["Ville"])) {
        $villeErr = "Entrez une ville Valide";
    }
   else{
       $villeOk = true;
      
   }

    if (empty($_POST['courriel']) || !preg_match('#[_a-z0-9-]+(.\[_a-z0-9-]+)*@[a-z]+\.[a-z]{2,3}#', $_POST["courriel"])) {
        $mailErr = "Entrez un mail valide";
    }
    else{
       $mailOk = true;
    }

    
    
    if (($_POST['Sujet']) == 0){$selectk0=true; $selectErr = "Choisir une question";}
    else if (($_POST['Sujet']== 1)){$selectOk1 = true;}
    else if (($_POST['Sujet']== 2)){$selectOk2 = true;}
    else if (($_POST['Sujet']== 3)){$selectOk3 = true;}
    else if (($_POST['Sujet']== 4)){$selectOk4 = true;}



    if (empty($_POST['question']) || !preg_match('#.+#', $_POST["question"])) {
        $questErr = "Entrez une question";
    }
    else{
       $questOk = true;
    }

    if (preg_match('#[A-Z]{1}[a-z]*#', $_POST["Nom"]) and  preg_match('#[A-Z]{1}[a-z]*#', $_POST["Prenom"]) and (isset($_POST['sexe'])) and preg_match('#[0-9]{2}\/[0-9]{2}\/[0-9]{4}#', $_POST["date"]) and preg_match('#[0-9]{5}#', $_POST["CodePostal"])
         and preg_match('#[1-9]+ .*#', $_POST["Adresse"]) and preg_match('#[_a-z0-9-]+(.\[_a-z0-9-]+)*@[a-z]+\.[a-z]{2,3}#', $_POST["courriel"]) and (!($_POST['Sujet']) == 0) and preg_match('#.+#', $_POST["question"])) 
         {echo '<script> window.alert("Le formulaire est corectement remplie, confirmer l\'envoie pour enregistrement"); </script>';}


?>
<!DOCTYPE html>
<html lang="fr"> <!--indique la langue dans laquelle la page web est rédigéé aux robots de référencement ou aux logiciels de synthése vocale-->
<!--les balises de la partie head ne sont pas affichées à l'exeption de title-->
<head>
    <!--meta permet de fourni des indications différentes du contenu de la page web -->
    <meta charset="UTF-8"><!--permet de spécifier aux navigateurs l'encodage de la page web, il s'agit là de la valeur standard qui évite les pbs d'affichages des caractères spéciaux-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0",shrink-to-fit=no>
    <title>Document Contact</title>
    <!--on importe Bootstrap via une URL pointant sur un CDN (un serveur externe hébergeant des fichiers) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
   
    <div class="container"> <!--container global de la page-->
    
        <?php include 'header/headerContact.php'; ?>

        <p id="contact"></p>
        <h1><b>Vos Coordonées</b></h1>  
        <p>*Ces zones sont obligatoires</p>
        <form name="formulaire" id="formulaire" method="post" action="<?php if (preg_match('#[A-Z]{1}[a-z]*#', $_POST["Nom"]) and  preg_match('#[A-Z]{1}[a-z]*#', $_POST["Prenom"]) and (isset($_POST['sexe'])) and preg_match('#[0-9]{2}\/[0-9]{2}\/[0-9]{4}#', $_POST["date"]) and preg_match('#[0-9]{5}#', $_POST["CodePostal"])
         and preg_match('#[1-9]+ .*#', $_POST["Adresse"]) and preg_match('#[_a-z0-9-]+(.\[_a-z0-9-]+)*@[a-z]+\.[a-z]{2,3}#', $_POST["courriel"]) and (!($_POST['Sujet']) == 0) and preg_match('#.+#', $_POST["question"])) {echo "affichage.php";}?>">

 <!--action="affichage.php"-->   
            <div class="form-group">
                <label for="Nom"><b>Nom*</b></label><input type="text" class="form-control" name="Nom" id="Nom"  value='<?php if ($nomOk) echo strip_tags($_POST['Nom']); ?>' placeholder="Veuillez saisir votre nom" > <!--formcontrol pour mettre la zone de saisie en dessous du titre du champs-->
                <span id="alerte-nom"> <?php echo $nameErr;?></span>
                <br>
                <label for="Prenom"><b>Prénom*</b></label><input type="text" class="form-control" name="Prenom" id="Prenom" value='<?php if ($prenomOk) echo strip_tags($_POST['Prenom']); ?>' placeholder="Veuillez saisir votre prénom">
                <span id="alerte-prenom"><?php echo $prenomErr;?></span> 
            </div>
            
            <b>sexe*&nbsp</b>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="sexe"><input class="form-check-input" type="radio" name="sexe" id="sexe1" value='F' <?php if ($sexe1Ok) echo "checked"; ?>>Féminin</label>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="sexe"><input class="form-check-input" type="radio" name="sexe" id="sexe2" value='M' <?php if ($sexe2Ok) echo "checked"; ?>>Masculin</label>
            </div>
            <br>
            <span id="alerte-sexe"><?php echo $sexeErr;?></span>
            <br>
            
            <div class="form-group">
                <label for="date"><b>Date de naissance*</b></label><input type="text" class="form-control" name="date" id="date" value='<?php if ($dateOk) echo strip_tags($_POST['date']); ?>'>
                <span id="alerte-date"><?php echo $dateErr;?></span> 
                <br>
                <label for="CodePostal"><b>Code postal*</b></label><input type="number" class="form-control" name="CodePostal" id="CodePostal" value='<?php if ($cpOk) echo strip_tags($_POST['CodePostal']); ?>'>
                <span id="alerte-codep"><?php echo $cpErr;?></span> 
                <br>
                <label for="Adresse"><b>Adresse*</b></label><input type="text" class="form-control" name="Adresse" id="Adresse" value='<?php if ($adrOk) echo strip_tags($_POST['Adresse']); ?>'>
                <span id="alerte-adresse"><?php echo $adrErr;?></span> 
                <br>
                <label for="Ville"><b>Ville*</b></label><input type="text" class="form-control" name="Ville" id="Ville" value='<?php if ($villeOk) echo strip_tags($_POST['Ville']); ?>'>
                <span id="alerte-ville"><?php echo $villeErr;?></span> 
                <br>
                <label for="courriel"><b>Email*</b></label><input type="email" class="form-control" name="courriel" id="courriel" value='<?php if ($mailOk) echo strip_tags($_POST['courriel']); ?>' placeholder="date.loper@afpa.fr">
                <span id="alerte-courriel"><?php echo $mailErr;?></span> 
                <br>
            </div>
            <h1><b>Votre demande</b></h1>
                <label for="Sujet">Sujet</label>
                <select class="form-control" name="Sujet" id="Sujet">
                    <option value = 0 <?php if ($selectOk0) echo "selected" ?>>Veuillez séléctionner un sujet</option>
                    <option value = 1 <?php if ($selectOk1) echo "selected" ?>>Mes commandes</option>
                    <option value = 2 <?php if ($selectOk2) echo "selected" ?>>Question sur un produit</option>
                    <option value = 3 <?php if ($selectOk3) echo "selected" ?>>Réclamations</option>
                    <option value = 4 <?php if ($selectOk4) echo "selected" ?>>Autres</option>
                </select>
                <span> <?php echo $selectErr;?></span>  
                <br>
                <p>Votre question*:</p>
                <textarea name="question" class="ml-1 row col-12 col-sm-12" id="question" rows="3"><?php if ($questOk) echo strip_tags($_POST['question']); ?></textarea>
                <span id="alerte-question"><?php echo $questErr;?></span> 
                <br>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input is-invalid" type="checkbox"  id="acceptation" required>
                    <label class="form-check-label" for="acceptation">J'accepte le traitement informatique de ce formulaire</label>
                </div>
            </div>
            <button class="btn btn-dark" type="submit" name="submit" value="1" required>Envoyer</button>
            <button class="btn btn-dark" type="button" id="efface">Annuler</button>
        </form>
        <br>
        
        <?php include 'footer/footer.php'; ?>      
    </div>
    



<!--<script src="public/js/evalContact.js"></script>-->
<!--fichiers Javascript nécessaires à Bootstrap-->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>



<?php

echo'
<script>
     document.querySelector("#efface").onclick= function(){
           if(confirm("êtes-vous sur(e) de vouloir effacer?")){
                     document.getElementById("formulaire").reset();
              }
     }
</script>';
}



else {  
     
 ?>

<!DOCTYPE html>
<html lang="fr"> <!--indique la langue dans laquelle la page web est rédigéé aux robots de référencement ou aux logiciels de synthése vocale-->
<!--les balises de la partie head ne sont pas affichées à l'exeption de title-->
<head>
    <!--meta permet de fourni des indications différentes du contenu de la page web -->
    <meta charset="UTF-8"><!--permet de spécifier aux navigateurs l'encodage de la page web, il s'agit là de la valeur standard qui évite les pbs d'affichages des caractères spéciaux-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0",shrink-to-fit=no>
    <title>Document Contact</title>
    <!--on importe Bootstrap via une URL pointant sur un CDN (un serveur externe hébergeant des fichiers) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
   
    <div class="container"> <!--container global de la page-->
    
    <?php include 'header/headerContact.php'; ?>

        <p id="contact"></p>
        <h1><b>Vos Coordonées</b></h1>  
        <p>*Ces zones sont obligatoires</p>
        <form name="formulaire" id="formulaire" method="post"> 
            <div class="form-group">
                <label for="Nom"><b>Nom*</b></label><input type="text" class="form-control" name="Nom" id="Nom"  placeholder="Veuillez saisir votre nom"> <!--formcontrol pour mettre la zone de saisie en dessous du titre du champs-->
                <span id="alerte-nom"></span>
                <br>
                <label for="Prenom"><b>Prénom*</b></label><input type="text" class="form-control" name="Prenom" id="Prenom" placeholder="Veuillez saisir votre prénom">
                <span id="alerte-prenom"></span> 
            </div>
            
            <b>sexe*&nbsp</b>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="sexe1"><input class="form-check-input" type="radio" name="sexe1" id="sexe1" value="sexe1">Féminin</label>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="sexe2"><input class="form-check-input" type="radio" name="sexe2" id="sexe2" value="sexe2">Masculin</label>
            </div>
            <br>
            <span id="alerte-sexe"></span>
            <br>
            
            <div class="form-group">
                <label for="date"><b>Date de naissance*</b></label><input type="text" class="form-control" name="date" id="date">
                <span id="alerte-date"></span> 
                <br>
                <label for="CodePostal"><b>Code postal*</b></label><input type="number" class="form-control" name="CodePostal" id="CodePostal">
                <span id="alerte-codep"></span> 
                <br>
                <label for="Adresse"><b>Adresse*</b></label><input type="text" class="form-control" name="Adresse" id="Adresse">
                <span id="alerte-adresse"></span> 
                <br>
                <label for="Ville"><b>Ville*</b></label><input type="text" class="form-control" name="Ville" id="Ville" >
                <span id="alerte-ville"><?php echo $villeErr;?></span> 
                <br>
                <label for="courriel"><b>Email*</b></label><input type="email" class="form-control" name="courriel" id="courriel" placeholder="date.loper@afpa.fr">
                <span id="alerte-courriel"></span> 
                <br>
            </div>
            <h1><b>Votre demande</b></h1>
                <label for="Sujet">Sujet</label>
                <select class="form-control" name="Sujet" id="Sujet">
                    <option value="">Veuillez séléctionner un sujet</option>
                    <option>Mes commandes</option>
                    <option>Question sur un produit</option>
                    <option>Réclamations</option>
                    <option>Autres</option>
                </select>  
                <br>
                <p>Votre question*:</p>
                <textarea name="question" class="ml-1 row col-12 col-sm-12" id="question" rows="3"></textarea>
                <span id="alerte-question"></span> 
                <br>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input is-invalid" type="checkbox"  id="acceptation">
                    <label class="form-check-label" for="acceptation">J'accepte le traitement informatique de ce formulaire</label>
                </div>
            </div>
            <button class="btn btn-dark" type="submit" name="submit" value="1" >Envoyer</button>
            <button class="btn btn-dark" type="button" id="efface">Annuler</button>
        </form>
        <br>
       
        <?php include 'footer/footer.php'; ?>
    </div>



<!--<script src="public/js/evalContact.js"></script>-->
<!--fichiers Javascript nécessaires à Bootstrap-->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>

<?php


     
if (isset($_POST['Nom']))  /*evite l'affichage "enregistré" du formulaire vide */
       {echo ' <script> window.alert("Demande enregistré"); </script>';}


 echo'
       <script>
            document.querySelector("#efface").onclick= function(){
                  if(confirm("êtes-vous sur(e) de vouloir effacer?")){
                            document.getElementById("formulaire").reset();
                     }
            }
       </script>';

} /*fin else*/

?>

<?php }

else  {?>
    
    <!DOCTYPE html>
    <html lang="fr"> <!--indique la langue dans laquelle la page web est rédigéé aux robots de référencement ou aux logiciels de synthése vocale-->
    <!--les balises de la partie head ne sont pas affichées à l'exeption de title-->
    <head>
        <!--meta permet de fourni des indications différentes du contenu de la page web -->
        <meta charset="UTF-8"><!--permet de spécifier aux navigateurs l'encodage de la page web, il s'agit là de la valeur standard qui évite les pbs d'affichages des caractères spéciaux-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0",shrink-to-fit=no>
        <title>Document Contact</title>
        <!--on importe Bootstrap via une URL pointant sur un CDN (un serveur externe hébergeant des fichiers) -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <div class="container"> <!--container global de la page-->
            <div class="row">
                <div class="col-12">
                    <img src="public/images/promotion.jpg"  class="w-100" alt="Image responsive" title="Image promotion"> <!--image esponsive s'adapte progressivement à la taille de l'ecran sans disparaitre-->
                </div>
            </div>
        <?php
            echo "<h1 class='d-flex justify-content-center'>"."Vous n'êtes pas autorisé à acceder sur cette pas"."</h1>";
            echo "<h3 class='d-flex justify-content-center'>"."Veuillez vous inscrire ou vous autentifier"."</h3>";
            echo "<br>";
            echo "<br>";
        ?>
            <a  class="btn btn-success d-flex justify-content-center" href="index.php">Inscription/Connexion</a>
        </div>      
        
        <!--fichiers Javascript nécessaires à Bootstrap-->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        </body>
        </html>
        
       <?php } ?>

