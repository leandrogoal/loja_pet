<?php
session_start();

if (isset($_GET['id_del'])) {
	$id = $_GET['id_del'];
	unset($_SESSION['carrinho'][$id]);

	header("Location: carrinho.php?id_product='0'&qt_product=''");
 	exit();

}

unset($_SESSION['usuario']);
unset($_SESSION['carrinho']);
unset($_SESSION['subTotal']);
unset($_SESSION['quanti_item']);
header("Location: index.php");
 	exit();
?>