<?php

include_once 'src/Models/customer.php';

class Repository
{
    private $db_server = 'Proj-mysql.uopnet.plymouth.ac.uk';
    private $dbUser = 'COMP2001_MMares';
    private $dbPassword = 'PysZ829+';
    private $dbDatabase = 'COMP2001_MMares';
    private $dataSourceName;
    private $connection;

    public function __construct(PDO $connection = null)
    {
        $this->connection = $connection;
        try {
            if ($this->connection === null) {
                $this->dataSourceName = 'mysql:dbname=' . $this->dbDatabase . ';host=' . $this->db_server;
                $this->connection = new PDO($this->dataSourceName, $this->dbUser, $this->dbPassword);
                $this->connection->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );
            }
        }catch (PDOException $err)
        {
            echo 'Connection failed: ', $err->getMessage();
        }
    }
    public function getAll($tableName)
    {
        $sql = "SELECT * FROM ";
        switch ($tableName)
        {
            case "Products" : $sql = $sql." Products";
                break;
            case "Customers" : $sql = $sql." Customers";
                break;
            case "Orders" : $sql = $sql." Orders";
                break;
            case "OrderDetails" : $sql = $sql." OrderDetails";
                break;
        }

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $resultSet;
    }


}