<?php
//SELECIONA PRODUTO INDIVIDUAL PARA A PAGINA PRODUTO
if (isset($_GET['id_prod'])) {
	$produto = $_GET['id_prod'];

	$sql = "SELECT * FROM produtos WHERE id = :id";
		$sql = $pdo->prepare($sql);
    	$sql->bindValue(":id", $produto);
    	$sql->execute();

		if($sql->rowCount() > 0){
			$produto_item = $sql->fetch();
	}
	
}
// SELECIONAR PRODUTOS DO CARRINHO
if(isset($_SESSION['usuario'])) {
	$carrinho= array();
	
  	 if(!empty($_GET['id_product'])){
    $id = $_GET['id_product'];
    $qt = $_GET['qt_product'];

    if(!isset($_SESSION['carrinho'])){
        $_SESSION['carrinho'] = array();
    }
    if($_GET['id_product']<>0){
    if(isset($_SESSION['carrinho'][$id])){
        $_SESSION['carrinho'][$id] += $qt;
    }else{
        $_SESSION['carrinho'][$id] = $qt;
    }
	}
    if (isset($_SESSION['carrinho'])) {
			$carrinho = $_SESSION['carrinho'];
		}

		foreach($carrinho as $id => $qt){
		$sql = "SELECT * FROM produtos WHERE id = :id";
		$sql = $pdo->prepare($sql);
    	$sql->bindValue(":id", $id);
    	$sql->execute();

		if($sql->rowCount() > 0){
			$prod = $sql->fetch();
		}
			
			$inf_pro[] = array(
				'id' =>$id,
				'nome' => $prod['nome'],
				'qt' => $qt,
				'preco' =>$prod['preco'],
				'imagem'=>$prod['imagem']
		);

			 $subtotal = 0;
			 $quanti_item = 0;
		foreach($inf_pro as $item){
			$subtotal += (floatval($item['preco'])* intval($item['qt']));
			$quanti_item += intval($item['qt']);
		}
		$_SESSION['subTotal']=$subtotal;
		
		$_SESSION['quanti_item']=$quanti_item;

		$_SESSION['compra_pro']= $inf_pro;
    }
   		

}
	

}
?>