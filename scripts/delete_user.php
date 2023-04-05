<?php
session_start();
require_once "./connect.php";
$sql = "DELETE FROM users WHERE `users`.`id` = $_GET[deleteUserId]";
$conn->query($sql);
//echo $conn->affected_rows;
$deleteuser = 0;
if($conn->affected_rows != 0){
    //echo "Usunięto rekord";
    // $_SESSION["error"] = "Usunięto użytkownika o id = $_GET[deleteUser]";
    $deleteuser = "$_GET[deleteUserId]";
}else{
    //echo "Nie usunięto rekordu";
    $deleteuser = 0;
}
//header("location: ../4_db/3_db_table.php?deleteuser=$deleteuser")
//header("location: ../4_db/4_db_table_add.php?deleteuser=$deleteuser")
header("location: ../4_db/5_db_table_update.php?deleteuser=$deleteuser")
?>
<script>
    //history.back();
</script>