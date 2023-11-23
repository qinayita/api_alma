<?php
$apiKey = 'sk_test_5J16u06fUG3BNa0j9lizte35';
$paymentId = 'payment_11xrgRi1FN6p1yiyWbab5lOMbGH9m2HyIk';

$url = "https://api.sandbox.getalma.eu/v1/payments/{$paymentId}/send-email";

$options = [
    'http' => [
        'header' => "Content-Type: application/json\r\nAuthorization: Alma-Auth {$apiKey}\r\n",
        'method' => 'POST',
    ],
];

$context = stream_context_create($options);

try {
    $responseEmail = @file_get_contents($url, false, $context);

    if ($responseEmail === FALSE) {
        // logger l'erreur interne pour ne pas l'afficher sur index
        throw new Exception("Erreur lors de l'envoi de l'e-mail.");
    }

    echo "E-mail envoyé avec succès.";
} catch (Exception $e) {
    echo $e->getMessage();
}

?>
