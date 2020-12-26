<?php
require "template/header.php";
?>
 <script>
    
    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");
            document.getElementById('ibge').value=("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
            document.getElementById('ibge').value=(conteudo.ibge);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf').value="...";
                document.getElementById('ibge').value="...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };

    </script>

<div class="endereco">

<?php
if(isset($_GET['id_end'])):?>
	<br><br>
	<h2>Alterar o Endereço</h2>

<?php else:?> 
	<br><br>
<h2>Cadastro de Endereço</h2>
<?php endif;?> 
		<form method="POST" >
				<div class="row">
					<div class="form-group col-sm-3">
					<label class="control-label" for="nome">CEP</label>
					<div class="">
						<input type="text" id="cep" name="cep" maxlength="9" value="<?php if(isset($_GET['id_end'])) echo $end['cep'];?>" class="form-control cep-mask" OnKeyPress="formatar('#####-###', this)" value="" size="10" maxlength="9"
               onblur="pesquisacep(this.value)">
					</div>
				</div>
				<div class="col-sm-3">
					
				</div>	

				<div class="form-group col-sm-8">
					<label class="control-label" for="logradouro">Logradouro</label>
					<div class="">
						<input type="text" id="rua" name="rua" value="<?php if(isset($_GET['id_end'])) echo $end['rua']?>" class="form-control">
					</div>
				</div>
					
				</div>
				
				<div class="row input_cadastro_end">

					<div class="form-group col-sm-3">
					<label class="control-label"  for="num">Número</label>
					<div class="">
						<input type="text" id="num" name="num" value="<?php if(isset($_GET['id_end'])) echo $end['num']?>" class="form-control">
					</div>
					</div>

					<div class="form-group col-sm-5">
						<label class="control-label" for="num">Bairro</label>
						<div class="">
							<input type="text" id="bairro" value="<?php if(isset($_GET['id_end'])) echo $end['vila']?>" name="vila" class="form-control">
						</div>
					</div>

				</div>
				
				<div class="row input_cadastro_end">
					<div class="form-group col-sm-3">
					<label class="control-label"  for="msg">Cidade</label>
					<div class="">
						<div class="">
							<input type="text" id="cidade" value="<?php if(isset($_GET['cidade'])) echo $end['cidade']?>" name="cidade" class="form-control">
						</div>	
					</div>
					</div>

					<div class="form-group col-sm-5">
					<label class="control-label"  for="msg">Estado</label>
					<div class="">
						<div class="">
							<input type="text" id="uf" value="<?php if(isset($_GET['estado'])) echo $end['estado']?>" name="estado" class="form-control">
						</div>	
				    </div>
				</div>	
					
				</div>
				
				<input name="ibge" type="hidden" id="ibge" size="8" /></label><br />
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<?php if(isset($_GET['id_end'])){ ?>
							<input type="hidden" name="alterar_end" id="alterar_end" value="1">
						<button type="submit" class="btn btn-primary">Alterar</button>
					<?php }else{ ?>
						<input type="hidden" name="cadastra_end" id="alterar_end" value="1">
						<button type="submit" class="btn btn-primary">Cadastrar</button>
					<?php }?>
					</div>
				</div>	
		</form>
	</div>
	<br>
<?php
require 'template/footer.php';
?>


   
  