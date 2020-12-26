<?php
require "template/header.php";
if(!isset($_SESSION['usuario'])){
	header("Location:".BASE_URL."cadastro.php");

}
if($inf_pro<1){
	header("Location:".BASE_URL."index.php");
}
	
?>
<div class="corpo">
	<div class="carrinho">
 
		<div class="row">
			<div class="col-sm-8">
			<center><h1>Carrinho de Compras</h1></center>
			</div>
			<div class="col-sm-4">
			<div class="bcart">
				<a href="<?php echo BASE_URL; ?>"><button class="btn btn-primary" style="background: #006aabff;">Continue Comprando</button></a>
			</div>
			</div>
		</div>
		<table class="table table-borderless tabelacarrinho" width="100%">
			<tr>
				<th ></th>
				<th>Nome</th>
				<th >Qtd</th>
				<th style="width: 150px;">Preço</th>
				<th ></th>
			</tr>
			<?php
			$subtotal = 0;
			?>
			<?php foreach($inf_pro as $item): ?>
			<?php
			$subtotal += (floatval($item['preco']) * intval($item['qt']));
			?>
			<tr class="prodcarrinho" style="border-bottom: 1px solid #e3dbdbff">
				<td><img src="<?php echo BASE_URL; ?>midia/produtos/<?php echo $item['imagem']; ?>" width="80" /></td>
				<td style="padding-top: 50px;"><?php echo ($item['nome']); ?></td>
				<td style="padding-top: 50px;"><?php echo $item['qt']; ?></td>
				<td style="padding-top: 50px; ">R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></td>
				<td style="padding-top: 50px;"><a class="btn btn-light" style="font-size: 12px; color: #b3b3b3ff; margin-top: -5px;" href="<?php echo BASE_URL; ?>sair.php?id_del=<?php echo $item['id']; ?>">Remover</a> </td><br>

			</tr>
			
			<?php endforeach; ?>
			
		</table>
			<br>
			

		<form method="POST" action="compra.php" >

		<div>

		<?php
		  
		?>

		<?php if(!isset($end)){ ?>
			<div class="carrinho_end-buto">
				<br><br>
				 <a type="button" href="cadastro_end.php" class="btn btn-primary" >Cadastre o Endereço de Entrega</a> 
			</div>
		 	<?php }else{ ?>
			<div class="carrinho_end-buto">
				<h6 style="font-weight: bold; font-size: 14px;">Endereço de Entrega </h6>
				Rua : <?php echo $end['rua']; ?><br>
				Nº : <?php echo $end['num'] ; ?><br>
				CEP : <?php echo $end['cep'] ; ?><br>
				Cidade : <?php echo $end['cidade'] ; ?> - <?php echo $end['estado'] ; ?><br><br>

				<a href="<?php echo BASE_URL ?>cadastro_end.php?id_end=<?php echo $_SESSION['usuario'] ?>" class="btn btn-primary">Alterar Endereço</a>
			</div>
			<?php }; ?>	
			
		    <div class="carrinho_fin" >
		 
		    	<div class="paw_cart" >
				
				<strong class="alert alert-info" style="font-size: 15px;">	
						TOTAL : 
						R$
				<?php
				$total = $subtotal +0;
				echo number_format($total, 2, ',', '.');
				?>
					
				</strong>
				<br><br><br><br>
			
					<div>Meus Joinhas  : <img src="assets/images/joinha.png" width="20"> $ 
					
						  <?php 
						  	$paw_propria= $total*0.03;
						  	echo number_format($paw_propria, 2, ',', '.') ;

						     ?>
					</div>
					<br>
				
			
					<div>Doação Joinhas: <img src="assets/images/joinha.png" width="20"> $  
					
						  <?php 

						 $doacao= $total*0.02;
						 echo number_format($doacao, 2, ',', '.');
						     ?>

					</div>
				
			</div>
			
			<br>

		<?php if(isset($end)): ?>
			<div class="button_cart">
				<input type="hidden" name="compra" value="1">
				<input type="submit" value="Finalizar Compra" class="btn btn-primary"/>
			</div>
		<?php endif; ?>	
			</div>
		</div>

		</form>

	</div>
</div>
<?php

require "template/footer.php";
?>