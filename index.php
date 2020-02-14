<?php
function getPDO(){
    require ".constant.php";
    $dbh = new PDO('mysql:host=' . $dbhost . ';dbname=' . $dbname, $user, $pass);
    return $dbh;
}

function getAllFilmMakers()
{
    require ".constant.php";
    try {
        getPDO();
        $query = 'SELECT * FROM filmmakers';
        $statement = getPDO()->prepare($query);//prepare query
        $statement->execute();//execute query
        $queryResult = $statement->fetchAll(pdo::FETCH_ASSOC);//prepare result for client
        $dbh = null;
        return $queryResult;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        return null;
    }
}

function getFilmMaker($id)
{
    require ".constant.php";
    try {
        getPDO();
        $query = "SELECT * FROM filmmakers WHERE id=$id";
        $statment = getPDO()->prepare($query);//prepare query
        $statment->execute();//execute query
        $queryResult = $statment->fetch(pdo::FETCH_ASSOC);//prepare result for client
        $dbh = null;
        return $queryResult;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        return null;
    }
}

function getFilmMakerByName ($name)
{
    require ".constant.php";
    try {
        getPDO();
        $query = "SELECT * FROM filmmakers WHERE lastname='$name'";
        $statement = getPDO()->prepare($query);//prepare query
        $statement->execute();//execute query
        $queryResult = $statement->fetch(pdo::FETCH_ASSOC);//prepare result for client
        $dbh = null;
        return $queryResult;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        return null;
    }
}

function updateFilmMaker($filmMaker)
{
    require ".constant.php";
    try {
        getPDO();
        $query = "UPDATE filmmakers SET filmmakersnumber =:filmmakersnumber, firstname =:firstname, lastname =:lastname, birthname =:birthname, nationality =:nationality  WHERE id=:id";
        $statement = getPDO()->prepare($query);//prepare query
        $statement->execute($filmMaker);//execute query
        $dbh = null;
        return true;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        return null;
    }
}

function createFilmMaker($filmMaker)
{
    require ".constant.php";
    try {
        getPDO();
        $query = "INSERT INTO filmmakers (filmmakersnumber,firstname,lastname,birthname,nationality)VALUES(131343,'Joe','Dalton',1870,'USA') ";
        $statement = getPDO()->prepare($query);//prepare query
        $statement->execute($filmMaker);//execute query
        $dbh = null;
        return true;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        return null;
    }
}

function deleteFilmMaker($filmMaker)
{
    require ".constant.php";
    try {
        getPDO();
        $query = "DELETE FROM filmmakers  WHERE  filmmakersnumber =:filmmakersnumber, firstname =:firstname, lastname =:lastname, birthname =:birthname, nationality =:nationality, id=:id";
        $statement = getPDO()->prepare($query);//prepare query
        $statement->execute($filmMaker);//execute query
        $dbh = null;
        return true;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        return null;
    }
}


// ############################## Tests unitaires ####################

// Recharger la base de données pour être sûr à 100% des données de test
require ".constant.php";
$cmd = "mysql -u $user -p$pass < Restore-MCU-PO-Final.sql";
exec($cmd);


echo "Test unitaire de la fonction getAllItems : ";
$items = getAllFilmMakers();
if (count($items) == 4)
{
    echo 'OK !!!';
}
else
{
    echo 'BUG !!!';
}
echo "\n";

echo "Test unitaire de la fonction getItem : ";
$item = getFilmMaker(3);
if ($item['firstname'] == 'Luc-Olivier')
{
    echo 'OK !!!';
}
else
{
    echo 'BUG !!!';
}
echo "\n";



echo "Test unitaire de la fonction getFilmMakerName : ";
$item = getFilmMakerByName('Chamblon');
if ($item['id'] == 3)
{
    echo 'OK !!!';
}
else
{
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
if (($readback['firstname'] == 'Gérard') && ($readback['lastname'] == 'Menfain'))
{
    echo 'OK !!!';
}
else
{
    echo '### BUG ###';
}
echo "\n";
echo "Test unitaire de la fonction createFilmMaker : ";
$item = createFilmMaker();
if ($item['firstname'] == 'Joe')
{
    echo 'OK !!!';
}
else
{
    echo 'BUG !!!';
}
echo "\n";


?>