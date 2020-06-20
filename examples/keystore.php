<?php

require '../vendor/autoload.php';

$client = new \AVA\AVAClient();

/**
 * Create User
 */
$newUser = uniqid("mococo-");
$newPassword = uniqid("password");
$status = $client->keyStore->createUser($newUser, $newPassword);
if ($status == true) {
    echo "User Created: {$newUser}";
}

/**
 * List Users
 */
$users = $client->keyStore->listUsers();
echo 'User List: <pre>';
print_r($users);
echo '</pre>';

/**
 * Export User
 */
$exportKey = $client->keyStore->exportUser($newUser, $newPassword);


/**
 * Delete User
 */
$status = $client->keyStore->deleteUser($newUser, $newPassword);
if ($status == true) {
    echo "User Deleted: {$newUser}";
}

/**
 * Re-Import User
 */
$importStatus = $client->keyStore->importUser($newUser, $newPassword, $exportKey);

if ($importStatus == true) {
    echo "User Imported: {$newUser}";
}
