<?php

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
    // $message .= "Adresse e-mail : " . $email . "\n";
    // $message .= "Numéro de téléphone : " . $tel . "\n";

    // Envoyer l'e-mail à l'utilisateur
    $headers = "From: devwebmb@gmail.com"; // Remplacez par votre adresse e-mail
    mail($email, $subject, $message, $headers);

    // Redirection vers une page de confirmation ou autre
    header("Location: index.html");
    exit;
}
?>

