<?php



$uname = $_POST["uname"];
$pwd = $_POST["pwd"];

if($uname=="mapaditya" && $pwd=="mapmapmap"){
    $_SESSION["user"] =$uname;
    header("Location: tes.php");
}
else{
    session_unset();
    echo "Gagal Login";
}

?>