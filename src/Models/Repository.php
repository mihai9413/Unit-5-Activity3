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
public function getCustomer($customerID)
{

    $sqlselect = "SELECT * FROM ";
    $sqlwhere = " WHERE CustomerId = $customerID";


    $statement = $this->connection->prepare($sqlselect." Customers ".$sqlwhere);
    $statement->execute();
    $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $resultSet;
}
    public function setCustomer($customerID,$CustomerName){
        $customer = new customer($customerID,$CustomerName);
//        echo $customer->Customerid();
        $sqlinsert = "INSERT INTO ";
        $sqlvalues = " VALUES (".$customer->Customerid()."," .$customer->CustomerName().");";


        $statement = $this->connection->prepare($sqlinsert." Customers ".$sqlvalues);
        echo $sqlinsert." Customers (customerID, CustomerName) ".$sqlvalues;
        $statement->execute();
        //$resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $statement;

    }
//    public function removeCustomer($customerID){
//        $customer = new customer($customerID);
//        echo $customer->Customerid();
//        $sqlinsert = "DELETE FROM ";
//        $sqlvalues = " WHERE CustomerId=".$customer->Customerid();
//
//        $statement = $this->connection->prepare($sqlinsert." Customers ".$sqlvalues);
//        $statement->execute();
//        //$resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);
//        return $statement;
//    }
}