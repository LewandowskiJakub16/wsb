<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $errors = [];
    foreach($_POST as $key => $value){
        if(empty($value))
        $errors[] = "Pole $key musi być wypełnione";
    }

    if (!empty($errors)){
        $error_message = implode("<br>", $errors);
		header("location: ../pages/index.php?erro
        r=".urlencode($error_message));
		exit();
	}

    echo "email: ", $_POST["email"]. " hasło: ", $_POST["pass"];
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    echo "email: ", $_POST["email"]. " hasło: ", $_POST["pass"];

    require_once "./connect.php";
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $_POST("email"));
    $stmt->execute();
    $result = $stmt->get_result();
    //$result->num_rows;
    if($result->num_rows != 0){
        //echo "istnieje email";
        //print_r($user);
        echo password_verify($_POST["pass"], $user["password"]);
        if(password_verify($_POST["pass"], $user["password"])){
            echo "zalogowany";
        }else{
            echo "niezalogowany";
        }
    }else{
        $_SESSION["error"] = "Błędny login lub hasło!";
        echo "<script>history.back();</script>";
    }

}else{
    header("location: ../pages");
}