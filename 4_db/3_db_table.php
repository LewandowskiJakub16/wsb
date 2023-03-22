<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/table.css">
    <title>Uzytkownicy</title>
</head>
<body>
    <h4>Uzytkownicy</h4>    
    <?php   
    require_once("../scripts/connect.php");
    $sql = "SELECT users.id, users.firstname, users.lastname, users.birthday, cities.city, states.state, countries.country FROM users INNER JOIN cities ON users.city_id = cities.id
    INNER JOIN states ON cities.state_id = states.id
    INNER JOIN countries ON states.country_id = countries.id";

    $result = $conn->query(query: $sql);
    echo <<< USERSTABLE
    <table>
        <tr>
            <th>Imie</th>
            <th>Nazwisko</th>
            <th>Data urodzenia</th>
            <th>Miasto</th>
            <th>Wojewodztwo</th>
            <th>Panstwo</th>
        </tr>
USERSTABLE;

    if ($result->num_rows > 0){
        while($user = $result->fetch_assoc()){
            echo <<< USERSTABLE
            <tr>
            <td>$user[firstname]</td>
            <td>$user[lastname]</td>
            <td>$user[birthday]</td>
            <td>$user[city]</td>
            <td>$user[state]</td>
            <td>$user[country]</td>
            <td><a href="../scripts/delete_user.php?deleteUserId=$user[id]">Usuń</a></td>
            <td><a href="../scripts/show_cities.php?">Wyświetl</a></td>
            </tr>
    USERSTABLE;
        }
    }else{  
        echo <<< USERSTABLE
        <tr>
        <td colspan="6">Brak rekordów do wyświetlenia</td>
        </tr>
    USERSTABLE;
    }
    echo "</table>";
    if (isset($_GET["deleteUser"])){
        if ($_GET["deleteUser"] != 0){
            echo "<hr>Usunięto użytkownika o id = $_GET[deleteUser]";
        }else{
            echo "<hr>Nie usunięto użytkownika";
        }
    }
    ?> 
</body>
</html>