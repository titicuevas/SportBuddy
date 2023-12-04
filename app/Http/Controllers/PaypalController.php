<?php

use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;



// Obtén el valor de precio desde el formulario o cualquier otra fuente
$precio = 10.00; // ¡Asegúrate de obtener el valor correctamente!

$payer = new Payer();
$payer->setPaymentMethod('paypal');

// Cambiemos la moneda a euros
$currency = 'EUR';

$amount = new Amount();
$amount->setCurrency($currency)
    ->setTotal($precio);

$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setDescription('Alguna descripción sobre el pago realizado')
    ->setInvoiceNumber(uniqid());

$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl($paypalConfig['return_url'])
    ->setCancelUrl($paypalConfig['cancel_url']);

$payment = new Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions([$transaction])
    ->setRedirectUrls($redirectUrls);

try {
    $payment->create($apiContext);
} catch (Exception $e) {
    throw new Exception('No se puede crear el enlace para el pago');
}

// En un entorno de Laravel, redirige utilizando el helper redirect()
return redirect()->away($payment->getApprovalLink());
