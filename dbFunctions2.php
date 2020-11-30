<?php
class DbContext
{
 private $db_server='proj-mysql.uopnet.plymouth.ac.uk';
 private $dbUser='MMares';
 private $dbPassword='PysZ829+';
 private $dbDatabase='COMP2001_MMares';

 private $dataSourceName;
 Private $connection;


public function __construct(PDO $connection = null)
{
    $this->connection = $connection;
    try{
        if($this->connection === null){
            $this->dataSourceName = 'mysql:dbname=' . $this->dbDatabase . ';host=' . $this->db_server;
            $this->connection = new  POD($this->dataSourceName,$this->dbUser,$this->dbPassword);
            $this->connection->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        }
    }
    catch (PDOException $err)
    {
        echo 'Connection failed: ', $err-->getMessage();

    }
}
}