<?php
require_once "./connect.php";
$sql = "DELETE FROM users WHERE `users`.`id` = $_GET[deleteUserId]";
$conn->query($sql);
//echo $conn->affected_rows;
$deleteuser = 0;
if($conn->affected_rows != 0){
    //echo "Usunięto rekord";
    $deleteuser = "$_GET[deleteUserId]";
}else{
    //echo "Nie usunięto rekordu";
    $deleteuser = 0;
}
header("location: ../4_db/3_db_table.php?deleteuser=$deleteuser")
?>
<script>
    //history.back();
</script>