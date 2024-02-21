<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/PHPMailer/Exception.php';
require 'src/PHPMailer/PHPMailer.php';
require 'src/PHPMailer/SMTP.php';

    $images = ["img/Handtasche.jpg" , "img/Handtaschezwei.jpg", "img/strumpfhosezwei.jpg", "img/strumpfhose.jpg", "img/kleid.jpg", "img/kleidzwei.jpg", "img/Pullover.jpg", "img/PulloverRollkragen.jpg", "img/ketteeins.jpg", "img/kettezwei.jpg", ];      
    $artikel = ["Handtasche Rosa", "Handtasche Grün", "Strumpfhose Lila", "Strumpfhose Rosa", "Kleid Fee", "Kleid Weiß Blau","Pullover", "Rollkragen Pullover", "Halskette Perlen", "Halskette Schmetterling"];
    $preis = [140.00, 120.00, 50.00, 50.00, 50.00, 230.00, 180.00, 150.00, 120.00, 90.00];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {


    foreach ($_POST['artikelanzahl'] as $index => $anzahl) {
        if ($anzahl > 0) {
            $artikelName = $artikel[$index];
            $artikelimages = $images[$index];
            $artikelpreis = $preis[$index];
           $ausgewaehlteArtikelHtml .= $artikelimages . $artikelName . " - Menge: " . $anzahl . " - Preis Einzeln: " . $artikelpreis . " " . "€" . "<br>" . "<br>";
            $vorname = htmlspecialchars($_POST['vorname']);
            $nachname = htmlspecialchars($_POST['nachname']);
            $email = htmlspecialchars($_POST['email']);
            $strasse = htmlspecialchars($_POST['strasse']);
            $hausnummer = htmlspecialchars($_POST['hausnummer']);
            $ort = htmlspecialchars($_POST['ort']);
            $plz = htmlspecialchars($_POST['plz']);
            $nachricht = htmlspecialchars($_POST['nachricht']);
            $gesamtsumme = htmlspecialchars($_POST['gesamtsumme']);
            $versandoption = htmlspecialchars($_POST['versandoption']);
            $versandtext = $versandoption === 'liefern' ? 'Lieferung' : 'Im Geschäft abholen';
   
        }
    }


    try {
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        $mail->setLanguage('de');
        $mail->isSMTP();
        $mail->Host = "securemail-wda-innsbruck-at.prossl.de";
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->addEmbeddedImage('img/logoBlack.png', 'logo_id', 'logoBlack.png');
        $mail->Username = "wiastud-newsletter";
        $mail->Password = "45YerkaidaAsaef5Kiap";
        $mail->setFrom("stud-newsletter@wda-innsbruck.at", "Eco Style");
        $mail->addAddress('lizm4572@gmail.com', "Mary Förster");
        $mail->addCC('lisamari9500@gmail.com', "Mary Förster");
        $mail->isHTML(true);
        $mail->Subject = "Bestellbestätigung";
        $mail->Body    = "<h2>Bestellung von:</h2>" . $vorname . " " . $nachname . "<br>"
                        . "Der DSGVO wurde zugestimmt!" . "<br>"
                        . "<h4>Adresse:</h4>"
                        . "Straße: " . $strasse
                        . "<br>" 
                        . "Nr: " . $hausnummer
                        . "<br>" 
                        . "PLZ: " . $plz . " "
                        . "Ort: " . $ort
                        . "<br>"
                        . "E-Mail: " . $email . "<br><br>"
                        . "Nachricht: " . $nachricht . "<br><br>"
                        . "<h4>Ausgewählte Artikel:</h4>" . $ausgewaehlteArtikelHtml 
                        . "<h3>Versandoption:</h3> " . $versandtext . "<br><br>"
                        . "<h3>Gesamtsumme:</h3> " . $gesamtsumme . " " . "€" . "<br>" . "<br>" . "<img src='cid:logo_id' alt='Logo'>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danke!</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .container_danke {
            width:80%;
            height:30rem;
            display: flex;
            padding:2rem;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-top:1rem;
        }
        .container_danke img {
            height: 3rem;
            width: 3rem;
            margin-top: 2rem;
        }
    </style>
</head>
<body>

    <div class="container_danke">
        <?php
        $mail->send();
            echo "<h1>Danke, $vorname!</h1><h3>Wir haben Ihre Bestellung erhalten und werden uns bald bei Ihnen melden.</h3>";
        } catch (Exception $e) {
            echo "<h3>Ihre Nachricht konnte leider nicht versendet werden. Fehler:</h3> {$mail->ErrorInfo}";
        }
        } else {
            header('Location: index.php');
            exit;
        }?>
        <a href="index.php"><button>Home</button></a>
    <img src="img/logoBlack.png" alt="">
    </div>
    
</body>
</html>