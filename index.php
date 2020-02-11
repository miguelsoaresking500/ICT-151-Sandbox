<?php

function getAllFilmMakers()
{
    require ".const.php";
    try {
        $dbh = new PDO('mysql:host=' . $dbhost . ';dbname=' . $dbname, $user, $pass);
        $query = 'SELECT * FROM filmmakers';
        $statement = $dbh->prepare($query);//prepare query
        $statement->execute();//execute query
        $queryResult = $statement->fetchAll();//prepare result for client
        $dbh = null;
        return $queryResult;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        return null;
    }
}

function getFilmMaker($id)
{
    require ".const.php";
    try {
        $dbh = new PDO('mysql:host=' . $dbhost . ';dbname=' . $dbname, $user, $pass);
        $query = "SELECT * FROM filmmakers WHERE id=$id";
        $statment = $dbh->prepare($query);//prepare query
        $statment->execute();//execute query
        $queryResult = $statment->fetch();//prepare result for client
        $dbh = null;
        return $queryResult;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        return null;
    }
}

function getFilmMakerByName ($name)
{
    require ".const.php";
    try {
        $dbh = new PDO('mysql:host=' . $dbhost . ';dbname=' . $dbname, $user, $pass);
        $query = "SELECT * FROM filmmakers WHERE name='$name'";
        $statement = $dbh->prepare($query);//prepare query
        $statement->execute();//execute query
        $queryResult = $statement->fetch();//prepare result for client
        $dbh = null;
        return $queryResult;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        return null;
    }
}

function updateFilmMaker($filmMaker)
{
}


// ############################## Tests unitaires ####################
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

echo "Test unitaire de la fonction renameFilmMaker : ";
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

?>