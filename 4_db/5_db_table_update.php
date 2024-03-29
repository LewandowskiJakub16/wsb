<?php
    session_start();
?>
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
    if(isset($_SESSION["error"])){
        echo $_SESSION["error"];
        unset($_SESSION["error"]);
    }
    require_once("../scripts/connect.php");
    $sql = "SELECT users.id, users.firstname, users.lastname, users.birthday, cities.city, states.state, countries.country FROM users INNER JOIN cities ON users.city_id = cities.id
    INNER JOIN states ON cities.state_id = states.id
    INNER JOIN countries ON states.country_id = countries.id";

    $result = $conn->query( $sql);
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
            <td><a href="./5_db_table_update.php?updateUserId=$user[id]">Edytuj</a></td>
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
    if (isset($_GET["addUserForm"])){
        echo <<< ADDUSERFORM
            <hr><h4>Dodawnie użytkownika</h4>
            <form action="../scripts/add_user.php" method="post">
            <input type="text" name="firstname" placeholder ="Podaj imię" autofocus><br><br>
            <input type="text" name="lastname" placeholder ="Podaj nazwisko"><br><br>
            <select name="city_id">
    ADDUSERFORM;
            $sql = "SELECT * FROM cities";
            $result = $conn->query($sql);
            while($city = $result->fetch_assoc()){
                echo "<option value=\"$city[id]\">$city[city]</option>";
            }
        echo <<< ADDUSERFORM
            </select><br><br>
            <input type="date" name="birthday"> Data urodzenia<br><br>
            <input type="checkbox" name="term" checked> Regulamin<br><br>
            <input type="submit" value="Dodaj użytkownika">
            </form>

    ADDUSERFORM;
        }else{
           echo '<hr><a href="./5_db_table_update.php?addUserForm=1">Dodawanie użytkownika</a>';
        }

        if(isset($_GET["updateUserId"])){
            $sql = "SELECT * FROM users WHERE id = $_GET[updateUserId]";
            $result = $conn->query($sql);
            $updateUser = $result->fetch_assoc();
            $_SESSION["updateUserId"] = $_GET["updateUserId"];
                echo <<< UPDATEUSERFORM
                    <hr><h4>Aktualizacja użytkownika</h4>
                    <form action="../scripts/update_user.php" method="post">
                    <input type="text" name="firstname" placeholder ="Podaj imię" value="$updateUser[firstname]"autofocus><br><br>
                    <input type="text" name="lastname" placeholder ="Podaj nazwisko" value="$updateUser[lastname]"><br><br>
                    <select name="city_id">
                UPDATEUSERFORM;
                    $sql = "SELECT * FROM cities";
                    $result = $conn->query($sql);
                    while($city = $result->fetch_assoc()){
                        if($updateUser["city_id"] == $city["id"]){
                            echo "<option value=\"$city[id]\"selected>$city[city]</option>";
                        }else{
                            echo "<option value=\"$city[id]\">$city[city]</option>";
                        }   
                    }
                echo <<< UPDATEUSERFORM
                    </select><br><br>
                    <input type="date" name="birthday" value="$updateUser[birthday]"> Data urodzenia <br><br>
                    <input type="submit" value="Aktualizuj użytkownika">
                    </form>
        UPDATEUSERFORM;
        }
        $conn->close();
    ?>
     
</body>
</html>