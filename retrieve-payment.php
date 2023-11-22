<?php
$apiKey = 'sk_test_5J16u06fUG3BNa0j9lizte35';

$paymentId = 'payment_11xrOhp4DjpbSZid8BlOTPffocihu7RbYf';

$url = "https://api.sandbox.getalma.eu/v1/payments/{$paymentId}";

$options = [
    'http' => [
        'header' => "Authorization: Alma-Auth {$apiKey}\r\n",
        'method' => 'GET'
    ]
];

$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);

if ($response === FALSE) {
    die("Erreur lors de la récupération du paiement");
}

//echo $response;
?>
