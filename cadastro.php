<?php
require "template/header.php";

?>

<div class="corpo">
	<div class="cadastro">
		<h2>Cadastro</h2>
		<form method="POST" class="form-horizontal" >
		<div class="form-group">
			<label class="control-label col-sm-2" for="nome_ca">Nome</label>
			<div class="col-sm-8">
				<input type="text" id="nome_ca" name="nome_ca" class="form-control">
			</div>
		</div>	

		<div class="form-group">
			<label class="control-label col-sm-2" for="sobrenome">Sobrenome</label>
			<div class="col-sm-8">
				<input type="text" id="sobre_nome" name="sobre_nome" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-sm-2" for="email">E-mail</label>
			<div class="col-sm-8">
				<input type="email" id="email_ca" name="email_ca" class="form-control">
			</div>
		</div>	

		<div class="form-group">
			<label class="control-label col-sm-2"  for="msg">Senha</label>
			<div class="col-sm-8">
				<input type="password" id="senha" name="senha" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-sm-2" for="celular">Celular</label>
			<div class="col-sm-8">
				<script type="text/javascript">
						$(document).ready(function(){
							$("#celular").mask("(99) 9 9999-9999");
						});
				</script>
				<input type="tel" id="celular" name="celular" class="form-control celular">
			</div>
		</div>	

		<div class="form-group">
			<label class="control-label col-sm-2" for= "cidade" > Cidade </label> 
			<div class="col-sm-8">
				<select  name="cidade" class="form-control">
			    	<option></option>
			    	<?php foreach ($cidades as $cidade): ?> {
			    		<option value="<?php echo $cidade['id'] ?>"><?php echo $cidade['cidade']  ?></option>
			    	<?php endforeach ?>
			    </select>	
		 	</div> 
		 </div>	

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-default">Enviar</button>
			</div>
		</div>	
		</form>
	</div>
</div>
<?php
require "template/footer.php";
?>

