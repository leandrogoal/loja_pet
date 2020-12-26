<?php
require "template/header.php";
//require "classes/usuario.php";


if (!isset($_SESSION['usu_adm'])) {
header("Location:".BASE_URL."login.php");
exit();
}

?>


<?php
require "template/footer.php"
?>