<?php
// Inclure les fichiers PHPMailer
require './PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/src/SMTP.php';
require './PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère les données soumises par le formulaire
    $email = $_POST["email"];
    $tel = $_POST["tel"];
    $prenom = $_POST["prenom"];

    // Traitement des données ici (par exemple, envoi d'un e-mail à l'utilisateur)

    // Construire le corps du message de confirmation
    $subject = "Votre coupon X-BAR";
    $message = "Bonjour " . $prenom . ",\n\n";
    $message .= "Merci d'avoir participé au jeu X-BAR.\n\n";
    $message .= "Voici votre coupon de réduction à utiliser sur le site\n";

    // Créer une nouvelle instance de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Paramètres SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.ionos.fr'; // Adresse du serveur SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'jeuvapexpo@marketing-xbar.co'; // Adresse e-mail
        $mail->Password = 'VAPEX24!!'; // Mot de passe
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Utilisation de SSL/TLS
        $mail->Port = 465; // Port SMTP

        // Destinataire
        $mail->setFrom('jeuvapexpo@marketing-xbar.co', 'X-BAR');
        $mail->addAddress($email, $prenom);

        // Contenu du message
        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body = $message;

        // Envoi de l'e-mail
        $mail->send();

        // Écrire les données dans le fichier CSV
        $csvLine = "$email,$tel,$prenom\n";
        $file = fopen("donnees.csv", "a");
        if ($file) {
            fwrite($file, $csvLine);
            fclose($file);
        } else {
            echo "Erreur: Impossible d'ouvrir le fichier.";
        }

        // Redirection vers une page de confirmation ou autre
        header("Location: index.html");
        exit;
    } catch (Exception $e) {
        echo "Erreur lors de l'envoi du message : {$mail->ErrorInfo}";
    }
}
?>



