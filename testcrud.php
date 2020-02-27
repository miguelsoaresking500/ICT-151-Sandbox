<?php
/**
 * Created by PhpStorm.
 * User: miguel.soares
 * Date: 27.02.2020
 * Time: 13:46
 */

// ############################## Tests unitaires ####################

// Recharger la base de données pour être sûr à 100% des données de test
require ".constant.php";
require "crud.php";

$cmd = "mysql -u $user -p$pass < Restore-MCU-PO-Final.sql";
exec($cmd);


echo "Test unitaire de la fonction getAllItems : ";
$items = getAllFilmMakers();
if (count($items) == 4) {
    echo 'OK !!!';
} else {
    echo 'BUG !!!';
}
echo "\n";

echo "Test unitaire de la fonction getItem : ";
$item = getFilmMaker(3);
if ($item['firstname'] == 'Luc-Olivier') {
    echo 'OK !!!';
} else {
    echo 'BUG !!!';
}
echo "\n";


echo "Test unitaire de la fonction getFilmMakerName : ";
$item = getFilmMakerByName('Chamblon');
if ($item['id'] == 3) {
    echo 'OK !!!';
} else {
    echo '### BUG ###';
}
echo "\n";

echo "Test unitaire de la fonction updateFilmMaker : ";
$item = getFilmMakerByName('Chamblon');
$id = $item['id']; // se souvenir de l'id pour comparer
$item['firstname'] = 'Gérard';
$item['lastname'] = 'Menfain';
updateFilmMaker($item);
$readback = getFilmMaker($id);
if (($readback['firstname'] == 'Gérard') && ($readback['lastname'] == 'Menfain')) {
    echo 'OK !!!';
} else {
    echo '### BUG ###';
}
echo "\n";
echo "Test unitaire de la fonction createFilmMaker : ";

$tableau=['firstname'=>'Joe','lastname'=>'Dalton','birthname'=>'2000-06-12','filmmakersnumber'=>'4567893','nationality'=>'USA'];
createFilmMaker($tableau);
$readback = getFilmMakerByName('Dalton');
if ($readback['firstname'] ==  'Joe') {
    echo 'OK !!!';
} else {
    echo 'BUG !!!';
}
echo "\n";

echo "Test unitaire de la fonction deleteFilmMaker : ";
$lastname = "Dalton";
$readback = deleteFilmMaker($lastname);
if ($readback['firstname'] == 'Joe') {

    echo 'BUG !!!';

} else {
    echo 'OK !!!';
}


?>