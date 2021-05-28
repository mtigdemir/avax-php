<?php

require '../vendor/autoload.php';

$client = new \AVA\AVAClient();

$yourUsername = "yourUserName";
$yourPassword = "yourPassword";

$status = $client->keyStore->createUser($yourUsername, $yourPassword);
if ($status == true) {
    echo "User Created: {$yourUsername}";
}

$address = $client->xchain->createAddress($yourUsername, $yourPassword);

$balance = $client->xchain->getBalance($address);

print_r($balance);

