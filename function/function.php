<?php

$dateGmt = gmdate('Y-m-d H:i');
//Pourcentage
if(!function_exists('pourcentage')){
    function pourcentageBruit($total, $nb){

        $res = ($nb * 100)/$total;
        return $res;
    }
}
if(!function_exists('pourcentage')){
    function pourcentage($total, $nb){

        $res = ($nb * 100)/$total;
        $resPourcen = number_format($res,2,'.', ' ');
        return $resPourcen;
    }
}


if(!function_exists('village_name')){
    function village_name($villag){
        $village_nom = array(
            "0"=> "",
            "1"=> "Blagounon",
            "2"=> "Baya",
            "3"=> "Gbalo",
            "4"=> "Kasséré",
            "5"=> "Kofré",
            "6"=> "Koundin",
            "7"=> "Lafi",
            "8"=> "Landiougou",
            "9"=> "Nonganan",
            "10"=> "Pinvoro",
            "11"=> "Tiasso",
            "12"=> "Toungbeli",
            "13"=> "Tomba",
            "14"=> "Pongafré",
            "15"=> "Sienrè",
            "16"=> "Siomfan",
            "17"=> "Yélé"
        );

        if(!$village_nom[$villag] ) return $villag;
        else return $village_nom[$villag];

    }
}
if(!function_exists('month_fr')){
    function month_fr($mois){
        $mounth_french = array(
            "01"=> "Janvier",
            "02"=> "Février",
            "03"=> "Mars",
            "04"=> "Avril",
            "05"=> "Mai",
            "06"=> "Juin",
            "07"=> "Juillet",
            "08"=> "Août",
            "09"=> "Septembre",
            "10"=> "Octobre",
            "11"=> "Novembre",
            "12"=> "Décembre"
        );

        if(!$mounth_french[$mois] ) return $mois;
        else return $mounth_french[$mois];

    }
}
if(!function_exists('days_fr')){
    function days_fr($mois){
        $mounth_french = array(
            "1"=> "Lundi",
            "2"=> "Mardi",
            "3"=> "Mercredi",
            "4"=> "Jeudi",
            "5"=> "Vendredi",
            "6"=> "Samedi",
            "7"=> "Dimanche"

        );

        if(!$mounth_french[$mois] ) return $mois;
        else return $mounth_french[$mois];

    }
}

if(!function_exists('date_lettre')){
    function date_lettre($date){
        $dts = days_fr(date('N', strtotime($date))).' '. date('d', strtotime($date)).' '. month_fr(date('m', strtotime($date))).' '. date('Y', strtotime($date));
        return $dts;
    }
}
// page active
$dateGmt = gmdate('Y-m-d H:i');
if(!function_exists('page_active')){
    function page_active($file){
        $page = array_pop(explode('/',$_SERVER['SCRIPT_NAME']));

        if($page == $file.'.php'){
            return "current";
        }else{
            return "";
        }
    }
}

// remplace virgule par .

if(!function_exists('p_v')){
    function p_v($nb){
        $n = str_replace('.',',',$nb);
        return $n;
    }
}


// remplace date en fr

if(!function_exists('date_fr')){
    function date_fr($date){
        $dc = new DateTime($date);
        $dc = $dc->format('d/m/Y');
        return $dc;
    }
}

// remplace date en eng

if(!function_exists('date_eng')){
    function date_eng($date){
        $dc = explode('/',$date);
        $ac = $dc[2]; $mc = $dc[1]; $jc = $dc[0];
        $dc = $ac.'-'.$mc.'-'.$jc;
        return $dc;
    }
}

// remplace dateTime en fr

if(!function_exists('date_time_fr')){
    function date_time_fr($date){
        $dc = new DateTime($date);
        $dc = $dc->format('d/m/Y H:i');
        return $dc;
    }
}

if(!function_exists('date_time_fr_court')){
    function date_time_fr_court($date){
        $dc = new DateTime($date);
        $dc = $dc->format('d/m');
        return $dc;
    }
}

// remplace datetima en eng

if(!function_exists('date_time_eng')){
    function date_time_eng($date){
        $dc = explode('/',$date);
        $ac = $dc[2]; $mc = $dc[1]; $jc = $dc[0];
        $dh = explode(' ',$ac);
        $ac = $dh[0];$dm = $dh[1];
        $dc = $ac.'-'.$mc.'-'.$jc.' '.$dm;
        return $dc;
    }
}

// remplace dateTime en fr

if(!function_exists('date_hour')){
    function date_hour($date){
        $dc = new DateTime($date);
        $dc = $dc->format('H:i');
        return $dc;
    }
}

if(!function_exists('reduit_text')){
    function reduit_text($text, $cut, $end = '...'){
        $output = substr($text, 0, $cut);
        if(strlen($text) > $cut){
            $output = $output . $end;
        }

        return $output ;
    }
}

if(!function_exists('reduit_username')){
    function reduit_username($text, $cut){
        $output = substr($text, 0, $cut);
        return $output ;
    }
}

/* Remplace caractères accentués d'une chaine */
function remove_accent($str)
{
    $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð',
        'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã',
        'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ',
        'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ',
        'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę',
        'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī',
        'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ',
        'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ',
        'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť',
        'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ',
        'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ',
        'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');

    $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O',
        'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c',
        'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u',
        'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D',
        'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g',
        'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K',
        'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o',
        'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S',
        's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W',
        'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i',
        'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
    return str_replace($a, $b, $str);
}


/* Générateur de Slug (Friendly Url) : convertit un titre en une URL conviviale.*/
function create_slug($str){
    return mb_strtolower(preg_replace(array('/[^a-zA-Z0-9 \'-]/', '/[ -\']+/', '/^-|-$/'),
        array('', '-', ''),
        remove_accent($str)
    ));
}

if(!function_exists('instant_time')){
    function instant_time($myDate){
        $today = strtotime(date('Y-m-d H:i:s'));
        $date = strtotime($myDate);

        $inactif_time = $today - $date;
        if($inactif_time < 60){
            $inactif_time = 'À l\'instant';
        }elseif($inactif_time > 59 AND $inactif_time < 3600){
            $time = number_format($inactif_time/60,0,'.',' ') ;
            if($time > 2){
                $inactif_time = 'Il y a '.$time.' mins' ;
            }else{
                $inactif_time = 'En ligne';
            }
        }elseif($inactif_time > 3599 AND $inactif_time < 86400){
            $time = number_format($inactif_time/3600,0,'.',' ') ;
            if($time > 1){
                $inactif_time = 'Il y a '.$time.' hrs' ;
            }else{
                $inactif_time = 'Il y a '.$time.' hr' ;
            }
        }elseif($inactif_time > 86399 AND $inactif_time < 1728000){
            $time = number_format($inactif_time/86400,0,'.',' ') ;
            if($time > 1){
                $inactif_time = 'Il y a '.$time.' jrs' ;
            }else{
                $inactif_time = 'Il y a '.$time.' jr' ;
            }
        }else{
            $inactif_time = date_fr($myDate) ;
        }

        return $inactif_time ;

    }
}

if(!function_exists('rmdir_recursive')){
    function rmdir_recursive($dir){
        //Liste le contenu du répertoire dans un tableau
        $dir_content = scandir($dir);
        //Est-ce bien un répertoire?
        if($dir_content !== FALSE){
            //Pour chaque entrée du répertoire
            foreach ($dir_content as $entry){
                //Raccourcis symboliques sous Unix, on passe
                if(!in_array($entry, array('.','..'))){
                    //On retrouve le chemin par rapport au début
                    $entry = $dir . '/' . $entry;
                    //Cette entrée n'est pas un dossier: on l'efface
                    if(!is_dir($entry)){
                        unlink($entry);
                    }
                    //Cette entrée est un dossier, on recommence sur ce dossier
                    else{
                        rmdir_recursive($entry);
                    }
                }
            }
        }
        //On a bien effacé toutes les entrées du dossier, on peut à présent l'effacer
        rmdir($dir);
    }
}

if(!function_exists('verif_username')){
    function verif_username($texte){
        $evite = array('à','â','ç','è','é','ê','î','ô','ù','û','ü','<','>','/',' ');
        $resultat = $texte;
        for ($i = 0; $i < count($evite); $i++){
            if(stristr($texte, $evite[$i])) {
                $resultat = 'non';
                break;
            }
        }
        return $resultat ;
    }
}

if(!function_exists('verif_text')){
    function verif_text($texte){
        $evite = array('<','>','/');
        $resultat = $texte;
        for ($i = 0; $i < count($evite); $i++){
            if(stristr($texte, $evite[$i])) {
                $resultat = 'non';
                break;
            }
        }
        return $resultat ;
    }
}


if(!function_exists('my_encrypt')){
    function my_encrypt($data) {
        $key = 'sk_aZgSnUYGGi0ReT!euGRnd!BAuhA=';
        $encryption_key = base64_decode($key);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
        return base64_encode($encrypted . '::' . $iv);
    }
}
if(!function_exists('my_decrypt')){
    function my_decrypt($data) {
        $key = 'sk_aZgSnUYGGi0ReT!euGRnd!BAuhA=';
        $encryption_key = base64_decode($key);
        list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
    }
}

if(!function_exists('kilo')){
    function kilo($data) {
        $nbre = $data;
        if($nbre > 1000){
            $nbre = number_format($nbre / 1000,1,',',' ');
            $nbre = $nbre.' k';
        }
        return $nbre;
    }
}

if(!function_exists('getDataByUrl')){
    function getDataByUrl($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        return curl_exec($ch);
        curl_close($ch);
    }
}