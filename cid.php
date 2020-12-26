<?php
require "template/header.php";
require "classes/cidade.php";

if(isset($_POST['cidade'])){
$_SESSION['cidade'] = $_POST['cidade'];

header("Location:".BASE_URL."index.php");
}
?>

<div class="form_cidade" >
<form method="POST">
  <div class="form-group" >
    <label for="exampleInputEmail1">ESTADO</label>
    <select name="estado" class="form-control" onchange="mudouOpcao(this.value)" >
    	<?php foreach ($estados as $estado): ?> {
    		<option value="<?php echo $estado['id'] ?>"><?php echo $estado['estado']  ?></option>
    	<?php endforeach ?>
    </select>
  </div>
  <div class="form-group">
    <label for="cidade">CIDADE</label>
    <select  name="cidade" class="form-control">
    	<option></option>
    	<?php foreach ($cidades as $cidade): ?> {
    		<option value="<?php echo $cidade['id'] ?>"><?php echo $cidade['cidade']  ?></option>
    	<?php endforeach ?>
    </select>	
  </div>
 
 <button type="submit" class="btn btn-primary">Enviar</button>
</form>
	
</div>



