<?php
    session_start();
    // print_r($_POST);
    $error = 0;
    foreach($_POST as $key => $value){
        // echo "$key: $value<br>";
        if(empty($value)){
            // echo "$key: $value<br>";
            $_SESSION["error"] = "Wypełnij wszystkie pola w formularzu";
            echo "<script>history.back();</script>";
            exit();
        }
    }
    if(!isset($_POST["term"])){
        $_SESSION["error"] = "Zatwierdź regulamin";
        $error++;
    }

    if($error != 0){
        echo "<script>history.back();</script>";
        exit();
    }
    
    require_once "./connect.php";
    $sql = "INSERT INTO `users` (`id`, `city_id`, `firstname`, `lastname`, `birthday`) VALUES (NULL, '$_POST[city_id]', '$_POST[firstname]', '$_POST[lastname]', '$_POST[birthday]');";
    $conn->query($sql);
    
    // echo $conn->affected_rows;
    if($conn->affected_rows == 1){
        // echo "Prawidłowo dodano użytkownika";
        $_SESSION["error"] = "Prawidłowo dodano użytkownika";
    }else{
        // echo "Nie dodano użytkownika";
        $_SESSION["error"] = "Nie dodano użytkownika";
    }

    //header("location: ../4_db/4_db_table_add.php");
    header("location: ../4_db/5_db_table_update.php");
?>