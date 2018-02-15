<?php
    require_once('inc/connexion-bdd.php');

    /**
    RECUPERER LES LIENS DE PAGES
    **/
    $afficherformation = $reqbdd->query('SELECT * FROM mmi_pages WHERE id_cat = 1');
    $afficheretuent = $reqbdd->query('SELECT * FROM mmi_pages WHERE id_cat = 2');
	$i = 1;
	$inscription = $reqbdd->query('SELECT * FROM date WHERE id = '.$i);

    /**
    AFFICHER LES DERNIERS ARTICLES
    **/
    $query_news = $reqbdd->query('SELECT * FROM mmi_news ORDER BY date_crea DESC LIMIT 0,5');

	
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" type="image/gif" href="favicon.ico" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="Description" content="" />
        <meta name="Keywords" content="" />
        <meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <title>DUT MMI Blois</title>
        
        <link rel="stylesheet" type="text/css" href="style.css"/>
        <link rel="stylesheet" type="text/css" href="responsive.css"/>
        <link rel="stylesheet" type="text/css" href="nanoscroller.css"/>
		<link rel="stylesheet" type="text/css" href="style.css">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>

        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jqueryui.js"></script>
        <script src="js/script.js"></script>
        <script type="text/javascript" src="js/jquery.nanoscroller.min.js"></script>
        <script type="text/javascript">
           $(".nano").nanoScroller();
        </script>
       
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>

    <body>
        <header class="verticalnav">
            <nav>

                 <div class="left">
                    <a href="#home" id="homelink"><div id="logo"></div></a>
                </div>
                <div class="right">
                        <li><a href="#formation">Formation</a></li>
                        <li><a href="#actualites" id="actu">Actualités</a></li>
                        <li><a href="#etudiantsetentreprises">Etudiants & Entreprises</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
            </nav>
        </header>

        <section id="home">
            <div class="playground">
                <img src="img/home.png" alt="Bienvenue sur le site du DUT MMI de Blois" />
                <video id="video_background" preload="auto" autoplay="true" loop="loop" height="100%" width="100%" muted="muted" volume="0"> 
                    <source src="img/video/videofinale.webm" type="video/webm"> 
                    <source src="img/video/videofinale.ogv" type="video/ogg" codecs="theora, vorbis">
                    <source src="img/video/videofinale.mp4" type="video/mp4">
                        Video not supported 
                </video>
                <div id="video_pattern"></div>
            </div>
        </section>
		<section id="inscription">
			<div class="<?php echo 'test'; ?>"></div>
			<div class="incription--container">
			<?php 
			
			echo $i.'<br>';

			while ($i<23) {
				$sql="SELECT * FROM date WHERE id = ".$i;
				//$inscription = $reqbdd->query("SELECT * FROM date WHERE id = ".$i);
				print_r($inscription);
				if (!empty($inscription)){
				$date = $resultat->fetch(PDO::FETCH_OBJ);
				if($date->nombre < 18){
					echo '<li ><a href="./date/?k='.$date->lien.'"><div class="date--puce"><span>'.$date->Nom.'</span></div></a></li>';
				}else{
					echo '<li><div class="date--puce complet"><span>'.$date->Nom.' (complet)</span></div></li>';
				}
				}
				$i++;
			}
			
			
			
			
			?>
		
			</div>
		</section>

        <section id="formation" class="hash">
            <div class="col-l horizontalnav">
                <nav>
                    <ul>
                        <?php
                            while($returnformation = $afficherformation->fetch()){
                                $affichercat = $reqbdd->query('SELECT * FROM mmi_cat WHERE id = '.$returnformation['id_cat'].'');
                                $returncat = $affichercat->fetch();
                                    echo '<li><a href="#'.$returnformation['link'].'-'.mb_strtolower($returncat['titre']).'">'.$returnformation['titre'].'</a></li>';
                            }
                        ?>
                    </ul>
                </nav>
            </div>
            <div class="col-r">
                <div class="ajaxpage">
                </div>
            </div>
        </section>


        <section id="actualites">
            <span id="close">Fermer <i class="fa fa-times"></i></span>
            <div class="playground">
                <h2>Actualités</h2>
                <ul>
                <?php
                    while($returnnews = $query_news->fetch()){
                        $newDate = date("d-m-Y", strtotime($returnnews['date_crea']));
                        echo '<hr />';
                        echo '<li>';    
                            echo '<a href="#'.$returnnews['id'].'-actualites"><span>'.$newDate.'</span> '.$returnnews['titre'].'</a>';
                        echo '</li>';
                            
                    }
                ?>
                </ul>
            </div>

            <div class="ajaxpage">
            </div>
        </section>


        <section id="etudiantsetentreprises" class="hash">
            <div class="col-l horizontalnav">
                <nav>
                    <ul>
                        <?php
                            while($returnetuent = $afficheretuent->fetch()){
                                $affichercat = $reqbdd->query('SELECT * FROM mmi_cat WHERE id = '.$returnetuent['id_cat'].'');
                                $returncat = $affichercat->fetch();
                                    echo '<li><a href="#'.$returnetuent['link'].'-'.mb_strtolower($returncat['titre']).'">'.$returnetuent['titre'].'</a></li>';
                            }
                        ?>
                        <li><a href="mmi-stages" target="_blank">Stages, emplois, alternance</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-r">
                <div class="ajaxpage">
                </div>
            </div>
        </section>

        <section id="contact" class="hash">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3348.2995302081454!2d1.3368584999997721!3d47.590098111999595!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e4a81b51bfac85%3A0x59ec794bc418ff3b!2sIUT+de+Blois!5e1!3m2!1sfr!2sfr!4v1407345464565" width="100%" height="100%" frameborder="0" style="border:0"></iframe>
            <div class="playground">
                <form action="" id="ajax-contact-form">
                    <h2>Contactez nous !</h2>
                    <div id="erreur"></div>
                    <div id="fields">
                        <input type="text" name="email" required placeholder="Votre e-mail" /><br />
                        <input type="text" name="sujet" required placeholder="Le sujet de votre message" /><br /><br />
                        <textarea rows="7" name="message" required placeholder="Ecrivez ici votre message !"></textarea><br />
                        <input type="submit" value="Envoyer !" name="submit" /><br /><br />
                    </div>
                    <p>
                        IUT DE BLOIS<br />
                        DEPARTEMENT MMI<br />
                        3 place Jean Jaurès<br />
                        41000 Blois<br />
                        02 54 55 21 43<br />
                    </p><br />
                    <p>
                        IUT DE BLOIS - CHOCOLATERIE<br />
                        SERVICES CENTRAUX<br />
                        15 rue de la Chocolaterie<br />
                        41000 Blois<br />
                        02 54 55 21 43<br /><br />

                        <a href="http://iut-blois.univ-tours.fr" class="button" target="_blank">www.iut-blois.univ-tours.fr</a>
                    </p>
                </form>
            </div>
        </section>
        
    </body>
</html>