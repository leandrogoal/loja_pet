<?php
session_start();

if (isset($_GET['id_del'])) {
	$id = $_GET['id_del'];
	unset($_SESSION['carrinho'][$id]);

	header("Location: index.php");
 	exit();

}

?>