<?php

include 'config.php';

session_start();

date_default_timezone_set('Europe/Paris');

$niveaux = array(1 => 'Tous les niveaux', 'Niveau débutant', 'Niveau moyen', 'Niveau confirmé');

$installation = true;

if(defined('HOTE') && defined('USER') && defined('PASS') && defined('BASE') && !empty(HOTE) && !empty(USER) && !empty(BASE)) {

    try {

        $pdo = new PDO("mysql:host=".HOTE.";dbname=".BASE, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $installation = false;

    } catch (PDOException $e) {}
}

if($installation) {

    $installation_fini = false;

    if(isset($_POST['hote']) && isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['base']) && isset($_POST['droits'])) {

        if($_POST['droits'] == 1) {

            if(!empty($_POST['hote']) && !empty($_POST['user']) && !empty($_POST['base'])) {

                try {

                    $pdo = new PDO("mysql:host=".$_POST['hote'].";", $_POST['user'], $_POST['pass']);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $configuration  = '<?php' . "\n";
                    $configuration .= 'define("HOTE", "'.$_POST['hote'].'");' . "\n";
                    $configuration .= 'define("USER", "'.$_POST['user'].'");' . "\n";
                    $configuration .= 'define("PASS", "'.$_POST['pass'].'");' . "\n";
                    $configuration .= 'define("BASE", "'.$_POST['base'].'");';

                    $pdo->query("CREATE DATABASE IF NOT EXISTS ".$_POST['base']);
                    $pdo->query("USE ".$_POST['base']);

                    if(is_writable('config.php') && file_put_contents('config.php', $configuration)) {

                        $dump = file('structure.sql');
                        $requete = '';
                        foreach ($dump as $ligne) {
                            if(substr($ligne, 0, 2) == '--' || $ligne == '')
                                continue;
                            $requete .= $ligne;
                            if(substr(trim($ligne), -1, 1) == ';') {
                                $pdo->query($requete);
                                $requete = '';
                            }
                        }
                        $installation_fini = true;
                        
                    } else {

                        $messages['type'] = 'erreur';
                        $messages['message'] = 'Impossible de modifier le fichier "config.php".<br>Veuillez vérifier vos droits sur ce fichier';
                    }

                } catch (PDOException $e) {

                    $messages['type'] = 'erreur';
                    $messages['message'] = 'Impossible de se connecter à la base de données.<br>Veuillez vérifier vos identifiants<br>('.$e->getMessage().')';
                }

            } else {

                $messages['type'] = 'erreur';
                $messages['message'] = 'Tous les champs sont obligatoires, sauf le mot de passe.';
            }

        } else {

            $messages['type'] = 'erreur';
            $messages['message'] = 'Veuillez vérifier la configuration de vos dossiers.';
        }
    }

    include 'installation.php';
    exit();
}

define('DOSSIER_AVATAR', 'static/user/avatars/');
define('DOSSIER_GROUPE', 'static/user/groupes/');
define('DOSSIER_CLUBS',  'static/user/clubs/');

include 'modeles/membres.php';

if(connecte() && !isset($_SESSION['csrf'])) {

    $_SESSION['csrf'] = sha1(uniqid() . rand() . uniqid());
}

function csrf($superglobale, $referer = false)
{
    if(isset($_SESSION['csrf']) && isset($superglobale['_c']))
        if($_SESSION['csrf'] == $superglobale['_c'])
            if((isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] == $referer) || !$referer)
                return true;
    return false;
}

function _csrf($input = true)
{
    return ($input ? '<input type="hidden" name="_csrf" value="'.$_SESSION['csrf'].'">' : $_SESSION['csrf']);
}

if(!connecte() && isset($_COOKIE['membre']) && !empty($_COOKIE['membre']) && isset($_COOKIE['hash']) && !empty($_COOKIE['hash'])) {

    if($infos_membre = verifier_membre($_COOKIE['membre'], $_COOKIE['hash'])) {

        $_SESSION['id'] = $infos_membre['id'];
        $_SESSION['nom'] = $infos_membre['prenom'] . ' ' . $infos_membre['nom'];
        $_SESSION['pseudo'] = $infos_membre['pseudo'];
    }
}

class DateTimeFrench extends DateTime {
    public function format($format) {
        $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
        $french_days = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
        $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $french_months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
        return str_replace($english_months, $french_months, str_replace($english_days, $french_days, parent::format($format)));
    }
}
