<?php
$apiKey = 'sk_test_5J16u06fUG3BNa0j9lizte35';
$paymentId = 'payment_11xrgXw6wVdac5oVur5rt2b9IIunp1Taa5';

$url = "https://api.sandbox.getalma.eu/v1/payments/{$paymentId}/refunds";


$refundAmount = 3334;

$data = [
    'amount' => $refundAmount,
];

$options = [
    'http' => [
        'header'  => "Content-Type: application/json\r\nAuthorization: Alma-Auth {$apiKey}\r\n",
        'method'  => 'POST',
        'content' => json_encode($data),
    ],
];

$context = stream_context_create($options);

try {
    $response = file_get_contents($url, false, $context);

    if ($response === FALSE) {
        throw new Exception("Erreur lors du remboursement.");
    }

    echo "Remboursement effectué avec succès.";
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
