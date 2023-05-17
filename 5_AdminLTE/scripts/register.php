<?php
if($_SERVER["REQUEST_METOD"] == "POST")
{
	
    /*echo "<pre>";
     print_r($_POST);
    echo "</pre>";
	*/
    

	$required_fields = ["firstname", "lastname", "email1", "email2", "pass1", "pass2", "birthday", "city_id", "gender"];

	/*foreach($required_fields as $key => $value){
		echo "$key: $value<br>";
	}
	exit();
	*/

    session_start();

    /*foreach($_POST as $key => $value){
        if(empty($value)){
            $_SESSION["error"] = "Wypełnij wszystkie pola!";
            echo "<script>history.back();</script>";
            exit();
        }
    }
	*/

	foreach($required_fields as $value){
        if(empty($_POST[$value])){
            $_SESSION["error"] = "Wypełnij wszystkie pola!";
            echo "<script>history.back();</script>";
            exit();
        }
    }

    $error = 0;

    if (!isset($_POST["terms"])){
		$error = 1;
		$_SESSION["error"] = "Zaznacz regulamin!";
	}

    if (!isset($_POST["gender"])){
		$error = 1;
		$_SESSION["error"] = "Zaznacz płeć!";
	}

    if ($_POST["pass1"] != $_POST["pass2"]){
		$error = 1;
		$_SESSION["error"] = "Hasła są różne!";
	}

    if ($_POST["email1"] != $_POST["email2"]){
		$error = 1;
		$_SESSION["error"] = "Adresy poczty elektronicznej są różne!";
	}

	if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\d\s])\S{8,}$/', $_POST["pass1"])) {
		$error = 1;
		$_SESSION["error"] = "Hasło nie spełnia wymagań!";
	}

	if ($error != 0){
		echo "<script>history.back();</script>";
		exit();
	}

    require_once("./connect.php");

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
	$stmt->bind_param('s', $_POST["email1"]);
	$stmt->execute();
	$result = $stmt->get_result();
	if ($result->num_rows != 0){
		$_SESSION["error"] = "Adres $_POST[email1] jest zajęty!";
		echo "<script>history.back();</script>";
		exit();
	}

    $stmt = $conn->prepare("INSERT INTO `users` (`email`, `city_id`, `firstName`, `lastName`, `birthday`, `gender`, `avatar`, `password`, `created_at`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, current_timestamp());");
    $pass = password_hash('$_POST[pass1]', PASSWORD_ARGON2ID);

    $avatar = ($_POST["gender"] == 'w') ? './jpg/woman.png' : './jpg/man.png';

    $stmt->bind_param('sissssss', $_POST["email1"], $_POST["city_id"], $_POST["firstName"], $_POST["lastName"], $_POST["birthday"], $_POST["gender"], $avatar, $pass);
    $stmt->execute();

    if ($stmt->affected_rows == 1){
		$_SESSION["success"] = "Dodano użytkownika $_POST[firstName] $_POST[lastName]";
	}else{
		$_SESSION["error"] = "Nie udało się dodać użytkownika";
	}
}
header("location: ../pages/register.php");   
?>