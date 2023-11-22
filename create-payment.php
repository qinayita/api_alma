<?php
// Clé API test
$apiKey = 'sk_test_5J16u06fUG3BNa0j9lizte35';

$url = 'https://api.sandbox.getalma.eu/v1/payments';

$data = [
    'payment' => [
        'purchase_amount' => 10000,
        'return_url' => 'http://votre-site.com/payment-success',
        'shipping_address' => [
            'first_name' => 'Martin',
            'last_name' => 'Dupond',
            'line1' => '1 rue de Rivoli',
            'postal_code' => '75004',
            'city' => 'Paris'
        ],
        'locale' => 'fr',
        'origin' => 'online'
    ],
    'customer' => [
        'first_name' => 'Martin',
        'last_name' => 'Dupond'
    ]
];

$options = [
    'http' => [
        'header'  => "Content-Type: application/json\r\nAuthorization: Alma-Auth {$apiKey}\r\n",
        'method'  => 'POST',
        'content' => json_encode($data),
    ],
];

$context  = stream_context_create($options);
$response = file_get_contents($url, false, $context);


if ($response === FALSE) {
    die("Erreur lors de la requête");
}

//echo $response;
?>
