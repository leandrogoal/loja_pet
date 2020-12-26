<?php
require "template/header.php";
require "classes/compra.php";

?>

<?php 
$user=($_SESSION['usuario']);
$pedido= $_SESSION['pedido'];
$data = date("Y-m-d H:i");

	$sql = "INSERT INTO compras (id_u, pedido,total_compra, data) VALUES (:id_u, :pedido, :total_compra, :data)";
		$sql = $pdo->prepare($sql);
		$sql->bindValue(":pedido", $pedido);
		$sql->bindValue(":id_u", $user);
		$sql->bindValue(":total_compra", $total_compra);
		$sql->bindValue(":data", $data);
		$sql->execute();


		$joinha_pro = floatval($total_compra)*0.03;
		$status= 0;
		$sql = "INSERT INTO joinhas_pro (usuario, pedido, valor, status, data) VALUES (:usuario, :pedido, :valor, :status, :data)";
		$sql = $pdo->prepare($sql);
		$sql->bindValue(":usuario", $user);
		$sql->bindValue(":pedido", $pedido);
		$sql->bindValue(":valor", $joinha_pro);
		$sql->bindValue(":status", $status);
		$sql->bindValue(":data", $data);
			$sql->execute();

		$joinha_doa = floatval($total_compra)*0.02;
		
		$sql = "INSERT INTO joinhas_doa (usuario, pedido, valor, status, data) VALUES (:usuario, :pedido, :valor, :status, :data)";
		$sql = $pdo->prepare($sql);
		$sql->bindValue(":usuario", $user);
		$sql->bindValue(":pedido", $pedido);
		$sql->bindValue(":valor", $joinha_doa);
		$sql->bindValue(":status", $status);
		$sql->bindValue(":data", $data);
		$sql->execute();

	$sql = $pdo->prepare("SELECT * FROM compra_item WHERE pedido = :pedido");
	$sql->bindValue(":pedido", $pedido);
	$sql->execute();
	if($sql->rowCount() > 0) {
		$inf_comp = $sql->fetchAll();
		
		
	}else{
		echo "errou!";
	}
	
	
	unset($_SESSION['carrinho']);
	unset($_SESSION['subTotal']);
	unset($_SESSION['quanti_item']);
?>
        
    

<div class="compra_final" style="width: 70%; margin: auto">
	<center >
		<div class="alert alert-primary" style="margin-top: 30px;">
		  <h3 >Pedido realizada com Sucesso!</h3>
		  Estaremos entrando em contato via Whatssap para confirmar local, agendar a entrega e modo de pagamento.<br><br>
		</div>
	</center>	  

  <table  width="100%" border="2" style="height: 40px;">
  	<th style="padding-left: 50px;">Pedido: <?php echo $pedido; ?> </th>
  	<th class="tabelacompra " ><center>Data : <?php echo date("j / n / Y");?></center></th>
  </table>

  <table width="100%"  class="table table-striped" border="1">
  	<tr>
	  	<th>N° Produto</th>
	  	<th>Produto</th>
	  	<th>Quant</th>
	  	<th>Valor Un</th>
	  	<th>Sub Total</th>
  	</tr>
  	
  		<?php 
  	{
		foreach($inf_comp as $inf_item){
			
		?>
			<tr style="font-size: 18px">
				<td><?php echo $inf_item['id_prod'] ; ?></td>
				<td style="font-size: 13px;"><?php echo $inf_item['nome_prod']; ?></td>
				<td><div class="total_compra"><?php echo $inf_item['qt'] ; ?></div></td>
				<td><div class="total_compra"><?php echo number_format($inf_item['preco'],2, ',', '.') ; ?></div></td>
				<td><div class="total_compra"><?php echo number_format($inf_item['sub_total'],2, ',', '.') ; ?></div></td>
			</tr>

		<?php
			
		}
	}
		?>		
	
	</table>
	<div class="compra_total" style="width: 100%;border: 1px solid black; font-size:20px; margin-bottom: 60px;">
  			<div class="row">
  				<div class="col-sm-9">
  					<div class="total_compra" style="margin-left: 40px">Total</div>
  				</div>
	  			<div class="col-sm-3">
	  				<div class="total_compra" style="margin-left: 100px"> R$ <?php echo number_format($total_compra,2, ',', '.') ?></div>
	  			</div>
  			</div>

 	</div>
<hr>
 	<div class="paw_compra" style="margin-top: 53px; color: #006aabff; ">
			<center><h4 style="font-weight: bold;">Paws adquiridos</h4></center>
			

  		<div class="row">
	  		<div class="col-sm-9" style="font-size: 15px; font-weight: bold;">
	  		Meus Joinhas :     J$ <?php echo number_format($joinha_pro,2, ',', '.');?><br>
	  		Doação joinhas: J$ <?php echo number_format($joinha_doa,2, ',', '.');?><br>
	  		</div>
	  		<div class="col-sm-3">
	  			<a href="<?php echo BASE_URL; ?>conta.php"><button class="btn btn-primary" style="margin-top: 20px;background: #006aabff;">Consulte seus Saldos</button><br></a>
	  		</div>
  		</div><br><br>
  		<div>Obs:. Seus Paws só serão efetivados quando confirmado o Pagamento</div>
  	</div>
  		
</div>

  		



<?php

 
require "template/footer.php";
?>