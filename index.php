
<?php

//include 'dbFunctions.php';
include_once 'src/Models/Repository.php';
if(isset($_POST['table']))
{
    $tablename = $_POST['table'];
    $idvalue = $_POST['idtable'];
    $newcustID = $_POST['newcustID'];
    $newcust = $_POST['newcust'];
    $removecust = $_POST['removecust'];
}

?>

<html>
<head>
    <title>PHP Demo : Read</title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <h1>Select Table</h1>

    <select name="table" id="ddTable">
        <option value="Products">Products</option>
        <option value="Customers">Customers</option>
        <option value="Orders">Orders</option>
        <option value="OrderDetails">OrdersDetails</option>


    </select>

    <input type="submit" value="Submit" id="sub">

    <label for="idtable">Select Id: </label>
    <select name="idtable" id="idtable">
        <option value="All">All</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
    </select>

    <label for="add">Add New User</label>
    <input type="text" id="add" name="newcustID">
    <input type="text" id="add" name="newcust">
    <input type="submit" value="Submit" id="sub">

<!--    <label for="remove">Remove User</label>-->
<!--    <input type="text" id="remove" name="removecust">-->
<!--    <input type="submit" value="Submit" id="sub">-->
<!--    <p>-->
<?php

//getConnection();
if(isset($tablename)) {
    $db = new Repository();
    if($tablename != "Customers"){
        echo $tablename;
        $results = $db->getAll($tablename);
    }
    else if ($tablename == "Customers" && $idvalue == "All"){
        $results = $db->getAll($tablename);
    }
    else if($tablename == "Customers" && $idvalue == "1" OR "2" OR "3") {
        $results = $db->getCustomer($idvalue);
    }
 }
            if ($newcust != "") {
                $db = new Repository();
//                echo 'trash language';
                $db->setCustomer($newcustID,$newcust);
            }
//             if ($removecust != "") {
//                $db = new Repository();
//                echo 'good language';
//                $db->removeCustomer($removecust);
//            }

//$results = getAll($tablename);
if ($results)
{
//    if(isset($tablename)){
//        $db=new Repository();
//        $results = $db -> getAll($tablename);
//    }
    //Hopefully if the results have been the right PDO type we should be able
    //to extract the column names with ease.
    $columns = empty($results) ? array() : array_keys($results[0]);
    $idColumn = $columns[0];

    $tableString = '<table border="1"><tr>';
    $inputString = '';
    $insertString = '';
    foreach($columns as $column)
    {
        $tableString .= '<th>'.$column.'</th>';
        $inputString .= '<th>'.$column.'</th>';
        $insertString .= '<td><input type=\'text\' name=\''.$column.'\'/></td>';

    }
    echo $tableString;

    foreach($results as $row)
    {
        echo '<tr>';

        foreach($row as $cell)
        {
            echo '<td>'.$cell.'</td>';
        }
    }
    echo '</table>';
}
?>
    </p>
</form>
</body>
</html>

