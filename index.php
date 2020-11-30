
<?php

include 'dbFunctions.php';
include_once 'src/Models/Repository.php';
if(isset($_POST['table']))
{
    $tablename = $_POST['table'];
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

    <input type="submit" value="Submit">
    <p>
<?php
getConnection();
$results = getAll($tablename);
if ($results)
{
    if(isset($tablename)){
        $db=new Repository();
        $results = $db -> getAll($tablename);
    }
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

