<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../4_db/style/table.css">
    <title>Miasta</title>
</head>
<body>
    <h4>Miasta</h4>
<?php
require_once "./connect.php";
$sql = "SELECT * FROM cities";
$result = $conn->query(query: $sql);
    echo <<< CITIESTABLE
    <table>
        <tr>
            <th>Id</th>
            <th>State_id</th>
            <th>City</th>
        </tr>
CITIESTABLE;

    while($city = $result->fetch_assoc()){
        echo <<< CITIESTABLE
        <tr>
        <td>$city[id]</td>
        <td>$city[state_id]</td>
        <td>$city[city]</td>
    CITIESTABLE;
    }
    echo "</table>";
    ?> 
</body>
</html>