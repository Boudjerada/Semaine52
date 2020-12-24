<div class="row"> <!--création d'une ligne de 2 colonne de 6-->
            <div class="col-6"> 
                <!--d-none d-md-block supprime l'element sur petit écran -->
                <img src="public/images/jarditou_logo.jpg"  class="d-none d-md-block w-50 mt-2" alt="Image responsive" title="Image logo">
            </div>
            <div class="col-6">
                <!--display-6 est une taille de police-->
                <h2 class="d-none d-md-block display-6 float-right mr-5 mt-3">Tout le jardin</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
<!--navbar-expand-sm qui indique à partir de quelle dimension (ici sm, donc à plus de 576px) la barre de navigation sera visible entièrement au lieu d'afficher le bouton hamburger.-->
            <nav class="navbar navbar-expand-sm bg-light navbar-light"> <!--couleur de la barre de navigation-->
                <span class=navbar-brand>Jarditou.com</span> <!--lien jarditou.com-->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar1">
                    <span class="navbar-toggler-icon"></span>
                </button> 
                <div class="collapse navbar-collapse" id="collapsibleNavbar1">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="accueil.php">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="tableau.php">Tableau</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contact</a>
                        </li>
                        <?php if ($status == 0) {?>
                        <li class="nav-item">
                            <a class="nav-link" href="panier.php">Panier</a>
                        </li>
            <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Deconnexion</a>
                        </li>
                    </ul>
                </div>
                <form action = '#' class="form-inline d-sm-none d-md-block" id="search" role="search" method="post"> <!--form inline pour la même ligne, d-none et block supprime en dessous de md-->
                        <label for="search-imput" ></label>
                        <input type="search"  id="search-imput" name="Entrerpromotion" spellcheck="false" placeholder="Votre promotion"> <!--spellckeck analyse orthographe, placeholder message pour champs obligatoire-->
                        <input value="Recherche" type="submit" class="btn btn-outline-info py-1"> <!--padding de 1 en haut et en bas-->
                </form>
            </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <img src="public/images/promotion.jpg"  class="w-100" alt="Image responsive" title="Image promotion"> <!--image esponsive s'adapte progressivement à la taille de l'ecran sans disparaitre-->
            </div>
        </div>
       