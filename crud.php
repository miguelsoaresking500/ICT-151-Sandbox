<?php
/**
 * Created by PhpStorm.
 * User: miguel.soares
 * Date: 27.02.2020
 * Time: 13:45
 */

function getPDO()
{

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

function getFilmMakerByName($name)
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

function updateFilmMaker($filmMakers)
{
    require ".constant.php";
    try {
        getPDO();
        $query = "UPDATE filmmakers SET filmmakersnumber =:filmmakersnumber, firstname =:firstname, lastname =:lastname, birthname =:birthname, nationality =:nationality  WHERE id=:id";
        $statement = getPDO()->prepare($query);//prepare query
        $statement->execute($filmMakers);//execute query
        $dbh = null;
        return true;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        return null;
    }
}

function createFilmMaker($filmMakers)
{
    require ".constant.php";
    try {
        getPDO();
        $query = "INSERT INTO filmmakers (filmmakersnumber,firstname,lastname,birthname,nationality)VALUES(:filmmakersnumber,:firstname,:lastname,:birthname,:nationality) ";
        $statement = getPDO()->prepare($query);//prepare query
        $statement->execute($filmMakers);//execute query
        $dbh = null;
        return true;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        return null;
    }
}

function deleteFilmMaker($filmMakers)
{
    require ".constant.php";
    try {
        getPDO();
        $query = "DELETE FROM filmmakers  WHERE  filmmakersnumber =:filmmakersnumber, firstname =:firstname, lastname =:lastname, birthname =:birthname, nationality =:nationality, id=:id";
        $statement = getPDO()->prepare($query);//prepare query
        $statement->execute($filmMakers);//execute query
        $dbh = null;
        return true;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        return null;
    }
}

?>