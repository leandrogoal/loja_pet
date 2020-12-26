<?php
require "template/header.php";
//require "classes/usuario.php";



if (!isset($_SESSION['usu_adm'])) {
header("Location:".BASE_URL."login.php");
exit();
}


if(isset($_POST['pedido_procura'])){
	$pedido = $_POST['pedido_procura'];
	
	$sql = "SELECT * FROM compras WHERE pedido = :pedido";
		$sql = $pdo->prepare($sql);
    	$sql->bindValue(":pedido", $pedido);
    	$sql->execute();

		if($sql->rowCount() > 0){
			$pedido_procura = $sql->fetch();
			
			$_SESSION['id_cliente']=$pedido_procura['id_u'];
			$_SESSION['total_compra'] = $pedido_procura['total_compra'];
	}

}

	if(!empty($_POST['tipo_pagamento']) & !empty($_POST['status']) ) {
		$pedido = $_POST['pedido'];
		$tipo_pagamento = $_POST['tipo_pagamento'];
		$status = $_POST['status'];
		$obs = $_POST['obs'];

		$sql="UPDATE compras SET tipo_pagamento=:tipo_pagamento, status=:status, obs = :obs WHERE pedido= :pedido";
		$sql = $pdo->prepare($sql);
	    $sql->bindValue(":pedido", $pedido);
	    $sql->bindValue(":tipo_pagamento", $tipo_pagamento);
	    $sql->bindValue(":status", $status);
	    $sql->bindValue(":obs", $obs);
	    $sql->execute();

	    
	    $sql="UPDATE joinhas_doa SET status=:status WHERE pedido= :pedido";
		$sql = $pdo->prepare($sql);
	    $sql->bindValue(":pedido", $pedido);
	    $sql->bindValue(":status", $status);
	    $sql->execute();

	    $sql="UPDATE joinhas_pro SET status=:status WHERE pedido= :pedido";
		$sql = $pdo->prepare($sql);
	    $sql->bindValue(":pedido", $pedido);
	    $sql->bindValue(":status", $status);
	    $sql->execute();

	    //Alterando Saldo Cliente
	if($tipo_pagamento=1){    
	    $usuario= $_SESSION['id_cliente'];

	    $sql = "SELECT * FROM usuario WHERE id = :id";
		$sql = $pdo->prepare($sql);
    	$sql->bindValue(":id", $usuario);
    	$sql->execute();

		if($sql->rowCount() > 0){
			$info_usuario = $sql->fetch();
			$saldo_joinha_pro = $info_usuario['saldo_joinha_pro'];
			$saldo_joinha_doa = $info_usuario['saldo_joinha_doa'];
			
		}

		$total_compra= $_SESSION['total_compra'];
		$saldo_joinha_pro= ($total_compra*.03)+$saldo_joinha_pro;
		$saldo_joinha_pr1 = (floatval($total_compra)*0.03)+floatval($saldo_joinha_pro);
	    $sql="UPDATE usuario SET saldo_joinha_pro=:saldo_joinha_pro WHERE id= :id";
		$sql = $pdo->prepare($sql);
	    $sql->bindValue(":id", $usuario);
	    $sql->bindValue(":saldo_joinha_pro", $saldo_joinha_pro);
	    $sql->execute();

	    $saldo_joinha_doa= ($total_compra*.02)+$saldo_joinha_doa;
		$saldo_joinha_pr1 = (floatval($total_compra)*0.02)+floatval($saldo_joinha_doa);
	    $sql="UPDATE usuario SET saldo_joinha_doa=:saldo_joinha_doa WHERE id= :id";
		$sql = $pdo->prepare($sql);
	    $sql->bindValue(":id", $usuario);
	    $sql->bindValue(":saldo_joinha_doa", $saldo_joinha_doa);
	    $sql->execute();

	 }   
	    
	}
$status = 0;
$sql = "SELECT * FROM compras WHERE status = :status";
		$sql = $pdo->prepare($sql);
    	$sql->bindValue(":status", $status);
    	$sql->execute();

		if($sql->rowCount() > 0){
			$pedidos = $sql->fetchAll();

	}else{
		$pedidos=1;
	}
		
?>

<div class="" style="width: 90%; margin: auto;">
	<center>
		<h3 style="margin-top: 30px;">Confirmação de Pedido</h3>
		<hr>
		<form method="POST" class="form-horizontal row" style="width: 70%; margin: auto;">
			<div class="form-group col-sm-4" style="margin-left: 210px;">
				<label class="control-label " for="sobrenome">PEDIDO</label>
				<div class="">
					<input type="text" id="pedido_procura" name="pedido_procura" class="form-control" >
				</div>
			</div>
			<input type="hidden" name="pedido" value="<?php echo $pedido_procura ?>">
			<div class="form-group col-sm-2">
				<div class="">
					<input type="submit" value="Procurar" style="margin-top: 25px;" class="form-control btn btn-primary">
				</div>
			</div>

		</form>
	</center>
	<?php
	if(isset($_POST['pedido_procura'])){ ?>
		<hr>
	<form class="form-horizontal row" method="POST">
		<div class="form-group col-sm-2">
			<label class="control-label " for="sobrenome">PEDIDO</label>
			<div class="">
				<input  style="font-size: 12px;" type="text" name="pedido" class="form-control" value="<?php echo $pedido_procura['pedido']; ?>" readonly>
			</div>
		</div>
		<div class="form-group col-sm-1" >
			<label class="control-label" >DATA</label>
			<div class="">
				<input  style="font-size: 12px; width: 100px; margin-left: -10px;" type="text"  class="form-control" disabled value="<?php echo date('d/m/Y',strtotime($pedido_procura['data'])); ?>">
			</div>
		</div>
		<div class="form-group col-sm-2">
			<label class="control-label" >TOTAL</label>
			<div class="">
				<input style="font-size: 12px;" type="text"  class="form-control" disabled value="<?php echo 'R$'.  number_format($pedido_procura['total_compra'],2, ',', '.'); ?>">
			</div>
		</div>
		<div class="form-group col-sm-2">
			<label class="control-labeL" >TIPO DE PAGAMENTO</label>
			<div class="">
				<select class="form-control" style="font-size: 12px;" name="tipo_pagamento">
					<option value="7"></option>
					<option value="1">Dinheiro</option>
					<option value="2">Débito</option>
					<option value="3">Credito A vista</option>
					<option value="4">Credito 2X</option>
					<option value="5">Credito 3X</option>
					<option value="6">Credito 4X</option>
				</select>
			</div>
		</div>
		<div class="form-group col-sm-2">
			<label class="control-label " >STATUS</label>
			<div class="">
				<div class="">
				<select class="form-control" name="status" style="font-size: 12px;">
					<option></option>
					<option value="3">PENDENTE</option>
					<option value="1">CONFIRMADO</option>
					<option value="4">CANCELADO</option>
					
				</select>
			</div>
			</div>
		</div>
		<div class="form-group col-sm-2">
			<label  class="control-label " for="sobrenome">OBSERVAÇÕES</label>
			<div class="">
				<textarea style="height: 40PX; font-size: 10PX;" type="text" id="obs" name="obs" class="form-control"><?php echo $pedido_procura['obs'] ?></textarea> 
			</div>
		</div>
		<div lass="form-group">
			
			<input  type="submit" name="Alterar" class="btn btn-primary" style="margin-top: 25px;">
		</div>
		
	</form>

	<?php
	}
	 ?>
	
	
	<hr>
	<center><h4 style="margin: 20px;">PEDIDOS PENDENTES</h4></center>
	<?php
	if($pedidos<>1){
	 ?>
	
	<table class="table table-sm">
	  <thead class="thead-dark">
	    <tr>
	      <th scope="col">PEDIDO</th>
	      <th scope="col">DATA</th>
	      <th scope="col">TOTAL</th>
	        
	    </tr>
	  </thead>
	  <tbody>
	  	<?php
	  	foreach ($pedidos as $pedido) {?>
	  	<tr>
	      
	      <td><?php echo $pedido['pedido']; ?></td>
	      <td><?php echo $pedido['data']; ?></td>
	      <td>R$ <?php echo number_format($pedido['total_compra'], 2, ',', '.'); ?></td>
	    </tr>

	  	<?php
	  	}
	  	 ?>
	   
	  </tbody>
	</table>
	<?php
	}else{?>

		<div class="alert alert-secondary" role="alert">
	 		<center><h4>Não existe Pedidos Pendentes.</h4></center>
		</div>

	<?php	
	}
	?>
</div>

<?php
require "template/footer.php"
?>