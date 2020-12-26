<?php
require "template/header.php";

if(!isset($_SESSION['usuario'])){
	header("Location:".BASE_URL."cadastro.php");

}
$id_user = $_SESSION['usuario'];

$sql = $pdo->prepare("SELECT * FROM joinhas_pro WHERE usuario = :usuario ORDER BY data DESC");
	$sql->bindValue(":usuario", $id_user);
	$sql->execute();
	if($sql->rowCount() > 0) {
		$jop = $sql->fetchAll();
		
		
	}else{
		$jop = 1;
	}

	$sql = $pdo->prepare("SELECT * FROM joinhas_doa WHERE usuario = :usuario ORDER BY data DESC");
	$sql->bindValue(":usuario", $id_user);
	$sql->execute();
	if($sql->rowCount() > 0) {
		$doa = $sql->fetchAll();
		
	}else{
		$doa=1;
	}

	//SALDO USUÁRIO
	$sql = $pdo->prepare("SELECT saldo_joinha_doa FROM usuario WHERE id = :id ");
	$sql->bindValue(":id", $id_user);
	$sql->execute();
	if($sql->rowCount() > 0) {
		$saldo_doa = $sql->fetch();

		
		
	}

	$sql = $pdo->prepare("SELECT saldo_joinha_pro FROM usuario WHERE id = :id");
	$sql->bindValue(":id", $id_user);
	$sql->execute();
	if($sql->rowCount() > 0) {
		$saldo_pro = $sql->fetch();

			
	}

?>

<div class="corpo" style="min-height: 500px;">
	<div class="" style="width: 90%; margin: auto;margin-top: 30px;">
		<center>
			<h2>Conta Joinhas <img style="width: 4%;" src="assets/images/joinha.png"></h2>
			<?php if (isset($_GET['doa_ef'])) {?>
				<h4 class="alert alert-info">
				Obrigado por sua Doação!
				</h4>
			<?php	
			}
			 ?>
		</center>
		<hr>
		<div class="row" style="margin-top: 25px;">
			<div class="col-sm-2">
				<ul >
					<li>
						<a href="doa.php" style="width: 120px; margin-bottom: 10px; background: #006aabff;" class="btn btn-primary">Doação</a>
					</li>
					<li>
						<a href="" style="width: 120px; background: #006aabff;" class="btn btn-primary">Utilizar</a>
					</li>
				</ul>

				
			</div>
			<div class="col-sm-10" >
				<center><h4>Extrato</h4></center><br>
				<div  class="row" style="margin-left: 50px;" >
					<div class="col-sm-6">
						<center>Doar <br>Saldo : $ <?php echo number_format($saldo_doa['saldo_joinha_doa'],2, ',', '.'); ?></center><br> 

						<table class="table table-hover "style="padding: 25px; padding-top: 50px;">
					  <thead style="font-size: 12px; ">
					    <tr>
					      <th scope="col">Data</th>
					      <th scope="col">pedido</th>
					      <th scope="col">Valor</th>
					    
					    </tr>
					  </thead>
					 
					  	<?php
					  	if($doa<>1){
					  	 foreach ($doa as $item) {?>
					  	
					  	
					  	<tbody style="font-size: 10px;<?php if($item['status']==1){echo 'color: blue; font-weight: bold; background: #006aab2b;';} if($item['status']==2){echo 'color: red; font-weight: bold; background: #ffd5d52b;';}?>  ">
					    <tr>
					      
					      <td><?php echo date("d/m/Y", strtotime($item['data'])); ?></td>
					      <td><?php 
					      if($item['status']==1){
					      	echo $item['pedido']; 
					      }if ($item['status']==4) {
					      	echo 'Cancelado '. $item['pedido'];
					      }if($item['status']==2){
					      	echo $item['pedido']; 	
					      } if($item['status']==0) {
					      	echo 'pendente';
					      }
					       ?></td>
					      <td>J$ <?php if($item['status']==2){echo "-";} echo number_format($item['valor'],2, ',', '.') ; ?></td>
					    </tr>
					  </tbody>
					  <?php
					  	}
					  	} ?>
					</table>
					</div>
					
					<div class="col-sm-6" style="border-left: 1px solid black">
							<center>Utilizar <br> Saldo : $<?php echo number_format($saldo_pro['saldo_joinha_pro'],2, ',', '.'); ?></center><br>
							
							<table class="table table-hover "style="padding: 25px; padding-top: 50px;">
						  <thead style="font-size: 12px;">
						    <tr>
						      <th scope="col">Data</th>
						      <th scope="col">pedido</th>
						      <th scope="col">Valor</th>
						    
						    </tr>
						  </thead>
						 	
						  	<?php 
						  	if($jop<>1){
						  	foreach ($jop as $item) {?>
						  	
						  	<tbody style="font-size: 10px;<?php if($item['status']==1){echo 'color: blue; font-weight: bold; background: #006aab2b;';} if($item['status']==2){echo 'color: red; font-weight: bold; background: #ffd5d52b;';}?>">
						    <tr>
						      
						      <td><?php echo date("d/m/Y", strtotime($item['data'])); ?></td>
						      <td><?php if($item['status']>0){echo $item['pedido']; }else{  echo 'pendente';} ?></td>
						      <td>J$ <?php echo number_format($item['valor'],2, ',', '.') ; ?></td>
						    </tr>
						  </tbody>
						  <?php
						  	}
						  	} ?>
						</table>
						
					</div>
					
				</div>
					
				</div>
				
				
		</div>
	</div>
		
</div>
<?php
require "template/footer.php";
?>

