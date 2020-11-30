<?php

include_once('index.php');

const servername = 'proj-mysql.uopnet.plymouth.ac.uk';
const username = 'COMP2001_MMares';
const password = 'PysZ829+';
const Database = 'comp2001_MMares';

function getConnection()
{
$dataSourceName="mysql:host=".servername.";dbname=".Database;
$dbConnection = null;
    try {
        $dbConnection = new PDO($dataSourceName,username,password);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    return $dbConnection;

}

function getAll($tablename)
{
$statement = getConnection() -> prepare("SELECT * FROM ".$tablename);
$statement -> execute();
$resultSet = $statement -> fetchALL(PDO::FETCH_ASSOC);
return $resultSet;
}