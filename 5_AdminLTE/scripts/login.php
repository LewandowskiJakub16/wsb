<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $errors = [];
    foreach($_POST as $key => $value){
        if(empty($value))
        $errors[] = "Pole $key musi być wypełnione";
    }

    if (!empty($errors)){
        $error_message = implode("<br>", $errors);
		header("location: ../pages/index.php?error=".urlencode($error_message));
		exit();
	}

    echo "email: ", $_POST["email"]. " hasło: ", $_POST["pass"];
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    echo "email: ", $_POST["email"]. " hasło: ", $_POST["pass"];

}else{
    header("location: ../pages");
}