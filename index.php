<!DOCTYPE html>
<html>
<head>
    <title>Bienvenue</title>
</head>
<body>
<h1>Bienvenue sur le site</h1>

<?php
include 'create-payment.php';

if (isset($response)) {
    $responseData = json_decode($response, true);

    if ($responseData && isset($responseData['id'])) {
        // Afficher les informations de base
        echo "ID de Paiement: " . htmlspecialchars($responseData['id']) . "<br>";
        echo "Montant: " . htmlspecialchars(number_format($responseData['purchase_amount'] / 100, 2)) . " €<br>";
        echo "État: " . htmlspecialchars($responseData['state']) . "<br>";

        // Informations sur le client
        if (isset($responseData['customer'])) {
            echo "Client: " . htmlspecialchars($responseData['customer']['first_name']) . " " . htmlspecialchars($responseData['customer']['last_name']) . "<br>";
        }

        // Détails du plan de paiement
        if (isset($responseData['payment_plan']) && is_array($responseData['payment_plan'])) {
            foreach ($responseData['payment_plan'] as $installment) {
                echo "Échéance: " . htmlspecialchars(date("Y-m-d", $installment['due_date'])) . " - Montant: " . htmlspecialchars(number_format($installment['purchase_amount'] / 100, 2)) . " €<br>";
            }
        }

        // Adresse de livraison
        if (isset($responseData['shipping_address'])) {
            echo "Adresse de Livraison: " . htmlspecialchars($responseData['shipping_address']['line1']) . ", " . htmlspecialchars($responseData['shipping_address']['postal_code']) . " " . htmlspecialchars($responseData['shipping_address']['city']) . "<br>";
        }

        // Envoyer le lien de paiement par e-mail
        include 'send-payment-link-email.php';
    } else {
        echo "<p>Erreur lors du traitement des données de paiement.</p>";
    }
} else {
    echo "<p>Les données de paiement ne sont pas disponibles.</p>";
}
?>

</body>
</html>
