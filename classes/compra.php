
<?php
if (!empty($_POST['compra'])) 
{
$id_user = $_SESSION['usuario'];
$data = date('hisdmY');
$pedido= $id_user.$data.rand(0,99);
$status =0;

$compra =($_SESSION['compra_pro']);
$_SESSION['pedido']= $pedido;

	foreach($compra as $item) 
	{
		$sub_total = floatval($item['qt'])*floatval($item['preco']);

        $sql = "INSERT INTO compra_item (pedido, id_user,id_prod, nome_prod , qt, preco, sub_total) VALUES (:pedido,:id_user,:id_prod, :nome_prod, :qt, :preco, :sub_total)";
		$sql = $pdo->prepare($sql);
		$sql->bindValue(":pedido", $pedido);
		$sql->bindValue(":id_user", $id_user);
		$sql->bindValue(":id_prod", $item['id']);
		$sql->bindValue(":nome_prod", $item['nome']);
		$sql->bindValue(":qt", $item['qt']);
		$sql->bindValue(":preco", $item['preco']);
		$sql->bindValue(":sub_total", $sub_total);			
		$sql->execute();
    	
	}
	
				
}


else{

	echo "<script>location.href='cadastro?log=1';</script>";
}
?>