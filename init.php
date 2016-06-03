<?php

include 'config.php';

session_start();

date_default_timezone_set('Europe/Paris');

$installation_fini = false;
$installation = false;

if(defined('HOTE') && defined('HOTE') && defined('HOTE') && defined('BASE')) {

    try {

        $pdo = new PDO("mysql:host=".HOTE.";dbname=".BASE, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {

        $installation = true;
    }

} else {

    $installation = true;
}


if($installation) {

    if(isset($_POST['hote']) && isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['base'])) {

        if(!empty($_POST['hote']) && !empty($_POST['user']) && !empty($_POST['base'])) {

            try {

                $pdo = new PDO("mysql:host=".$_POST['hote'].";dbname=".$_POST['base'], $_POST['user'], $_POST['pass']);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $configuration  = '<?php' . "\n";
                $configuration .= 'define("HOTE", "'.$_POST['hote'].'");' . "\n";
                $configuration .= 'define("USER", "'.$_POST['user'].'");' . "\n";
                $configuration .= 'define("PASS", "'.$_POST['pass'].'");' . "\n";
                $configuration .= 'define("BASE", "'.$_POST['base'].'");';

                if(is_writable('config.php') && file_put_contents('config.php', $configuration)) {

                    $installation_fini = true;
                    
                } else {

                    $messages['type'] = 'erreur';
                    $messages['message'] = 'Impossible de modifier le fichier "config.php".<br>Veuillez vérifier vos droits sur ce fichier';
                }

            } catch (PDOException $e) {

                $messages['type'] = 'erreur';
                $messages['message'] = 'Impossible de se connecter à la base de données.<br>Veuillez vérifier vos identifiants';
            }

        } else {

            $messages['type'] = 'erreur';
            $messages['message'] = 'Tous les champs sont obligatoires, sauf le mot de passe.';
        }
    }

    include 'installation.php';
    exit();
}

define('DOSSIER_AVATAR', 'static/user/avatars/');
define('DOSSIER_GROUPE', 'static/user/groupes/');
define('DOSSIER_CLUBS',  'static/user/clubs/');

class DateTimeFrench extends DateTime {
    public function format($format) {
        $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
        $french_days = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
        $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $french_months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
        return str_replace($english_months, $french_months, str_replace($english_days, $french_days, parent::format($format)));
    }
}

include 'modeles/membres.php';