<?php

require '../vendor/autoload.php';

$client = new \AVA\AVAClient();

print $client->admin->nodeVersion();

