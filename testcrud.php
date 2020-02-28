<?php
/**
 * Created by PhpStorm.
 * User: miguel.soares
 * Date: 27.02.2020
 * Time: 13:46
 */

// Recharger la base de données pour être sûr à 100% des données de test
function getDbh()
{
    require ".constant.php";
    require "crud.php";

    $cmd = "mysql -u $user -p$pass < Restore-MCU-PO-Final.sql";
    exec($cmd);

}
//foncions ui font les tests des fonctions
function testGetAllItems()
{
    echo "Test unitaire de la fonction getAllItems : ";
    $items = getAllFilmMakers();
    if (count($items) == 4) {
        echo 'OK !!!';
    } else {
        echo 'BUG !!!';
    }
    echo "\n";
}
function testGetFilmMakers()
{
    echo "Test unitaire de la fonction getItem : ";
    $item = getFilmMaker(3);
    if ($item['firstname'] == 'Luc-Olivier') {
        echo 'OK !!!';
    } else {
        echo 'BUG !!!';
    }
    echo "\n";
}
function testgetFilmMakerName()
{
    echo "Test unitaire de la fonction getFilmMakerName : ";
    $item = getFilmMakerByName('Chamblon');
    if ($item['id'] == 3) {
        echo 'OK !!!';
    } else {
        echo '### BUG ###';
    }
    echo "\n";
}
function testupdateFilmMaker()
{
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
}
function testcreateFilmMaker()
{
    echo "Test unitaire de la fonction createFilmMaker : ";

    $tableau = ['firstname' => 'Joe', 'lastname' => 'Dalton', 'birthname' => '2000-06-12', 'filmmakersnumber' => '4567893', 'nationality' => 'USA'];
//$nfm = lastIsertId();
    createFilmMaker($tableau);
    $readback = getFilmMakerByName('Dalton');
//if (countfilmmakers()==$nfm+1) {
    if ($readback['firstname'] == 'Joe') {
        echo 'OK !!!';
    } else {
        echo 'BUG !!!';
    }
///}
//else echo 'Bug(count)!!!';
    echo "\n";
}
function testdeleteFilmMaker()
{
    echo "Test unitaire de la fonction deleteFilmMaker : ";
    $lastname = "Dalton";
    $readback = deleteFilmMaker($lastname);
    if ($readback['firstname'] == 'Joe') {

        echo 'BUG !!!';

    } else {


        echo 'OK !!!';

    }
}



// ############################## Tests unitaires ####################

// Appel des fonctions
getDbh();
testGetAllItems();
testGetFilmMakers();
testgetFilmMakerName();
testupdateFilmMaker();
testcreateFilmMaker();
testdeleteFilmMaker();
?>