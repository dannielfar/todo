<?php
function check_login($conn) {
if(isset($_SESSION['user_id'])){
    
    $id = $_SESSION['user_id'];
    $query = "SELECT * from clientes where id = '$id' limit 1";

    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0 && $result){
        $user_data = mysqli_fetch_assoc($result);
        return $user_data;
}
header("Location: pages/login.php");
die;
}
}