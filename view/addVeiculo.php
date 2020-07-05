<?php include("../model/DAO/CarroDAO.php")?>
<?php
	$co=new CarroDAO();
	$listaMarcas=$co->selectMarca();
	$listaCaracteristicas=$co->selectCaracteristicas();
	$listaModelos=$co->selectModelos();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php include(__DIR__.'/./template/head.php')?>
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<div id="menu">
		<?php
			include(__DIR__.'/./template/menu.php')
		?>
	</div>
	<main>
		<div class="content" style="padding-left: 2%;padding-right: 2%;padding-top: 2%">
			<h1 id="t" class="text-center">Adicionar veiculo</h1>
			<hr>
			<div id="progress-inputs" class="progress">
				<div class="progress-bar bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
					<span class="sr-only">0%</span>
				</div>
			</div>
			<small class="form-text text-muted">Este é o seu progresso</small>
			<hr>
			<form method="POST" id="input-progress" role="form" action="">
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-6">
							<h6>Id veiculo*</h6>
							<input type="text" class="form-control" pattern="[0-9]*" id="id" name="id" placeholder="Digite o id do veiculo..." required="">
						</div>
						<div class="col-md-6">
							<h6>nmr_chassi*</h6>
							<input type="text" maxlength="19" minlength="19" class="form-control" placeholder="Digite o chassi do veiculo..." id="chassi" name="chassi" required="">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-6">
							<h6>Marca*</h6>
							<select class="form-control" readonly  id="marca" name="marca">
								<?php
									foreach ($listaMarcas as &$li) {
										echo $li;
									}
								?>
							</select>
						</div>
						
						<div class="col-md-6">
							<h6>Modelo*</h6>
							<select class="form-control" id="modelo" name="modelo" required="">
								<?php
									foreach ($listaModelos as &$li) {
										echo $li;
									}
								?>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-6">
							<h6>Ano*</h6>
							<input type="text" maxlength="4" minlength="4" class="form-control" pattern="[0-9]*" id="ano" name="ano" placeholder="Digite o ano do veiculo..." required="">
						</div>
						<div class="col-md-6">
							<h6>Placa</h6>
							<input type="text" maxlength="7" minlength="7" class="form-control" placeholder="Digite a placa do veiculo..." id="placa" name="placa" required="">
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-6">
						<h6>Caracteristicas*</h6>
						<?php
							foreach ($listaCaracteristicas as &$l) {
								echo $l;
							}
						?>
					</div>
				</div>
				<br>
				<button type="submit" id="sub" class="btn btn-success btn-lg btn-block">adicionar veiculo</button>
			</form>
		</div>
	</main>


	<script type="text/javascript" charset="utf-8" async defer>
		$(document).ready(function(){
			function updateInputProgress(){
				var inputsPreenchidos = 0;
				$("#input-progress").find("input, select, textarea").each(function(){
					if($(this).val() != ""){
						inputsPreenchidos++;
					}
				});
				var percentual = Math.ceil(100 * inputsPreenchidos / nmrTotalInputs);
				$("#progress-inputs .progress-bar").attr("aria-valuenow", percentual).width(percentual + "%").find(".sr-only").html(percentual + "% Complete");
					return percentual;
				}
				//Input Progress
				var nmrTotalInputs = $("#input-progress").find("input, select, textarea").length+1;
				$("#input-progress").click(function(){
					updateInputProgress();
				});
		});	
	</script>
	<script type="text/javascript" charset="utf-8" async defer>
		$(document).ready(function () {
				$("#input-progress").validate({
				    rules:{
				        id:  {
				            required: true,
				            minlength: 1
				        },
				        chassi:{
				            required: true,
				            minlength: 19,
				            maxlength: 19
				        },
				        marca:{
				            required: true
				        },
				        modelo:{
				            required: true
				        },
				        ano:{
				            required: true,
				            minlength: 4,
				            maxlength: 4
				        },
				        placa:{
				            required: true,
				            minlength: 7,
				            maxlength: 7
				        }
				    },
				    messages: {
				        id:{
				            required: "O id do veiculo é obrigatório...",
				            minlength: jQuery.format("Seu nome deve conter pelo menos {0} caracteres...")
				        },
				       	chassi:{
				            required: "O chassi do veiculo é obrigatório...",
				            minlength: jQuery.format("O chassi deve conter pelo menos {0} digitos..."),
				            maxlength: jQuery.format("O chassi deve conter menos que {0} digitos...")
				        },
				        marca:{
				            required: "Selecione uma marca..."
				        },
				        modelo:{
				            required: "Selecione um modelo..."
				        },
				        ano:{
				        	required: "O ano do veiculo é obrigatório...",
				            minlength: jQuery.format("O ano do veiculo deve conter pelo menos {0} digitos..."),
				            maxlength: jQuery.format("O ano do veiculo deve conter menos que {0} digitos...")
				        },
				        placa:{
				        	required: "A placa do veiculo é obrigatório...",
				            minlength: jQuery.format("A placa deve conter pelo menos {0} digitos..."),
				            maxlength: jQuery.format("A placa deve conter menos que {0} digitos...")
				        }
				    }
				});
			});
	</script>

	<script type="text/javascript">
		function adicionaVeiculo(){
			var chassi=$('#chassi').val();
			var ano=$('#ano').val();
			var modelo=$('#modelo').val();
			var placa=$('#placa').val();
			var caracteristicas=$("input[type=checkbox]:checked").val();
			alert(chassi+' ?? '+ano+' ?? '+modelo+' ?? '+placa+' ?? '+caracteristicas);
			swal({
			     title: 'Remover foto de perfil?',
			      showCancelButton: true,
			      confirmButtonText: 'Sim, pode remover!',
			      cancelButtonText: 'Cancelar',
			      text: 'Essa ação não poderá ser desfeita.',
			      type: 'warning',
			      confirmButtonColor: '#F54400',
			      showLoaderOnConfirm: true,
			      preConfirm: ()=>{
			            $.ajax({
			                url: 'adicionar_veiculo.php',
			                method: 'POST',
			                data:{
								chassi:chassi,
								ano:ano,
								modelo:modelo,
								placa:placa
								//caracteristicas:caracteristicas
							},
			                success: function(resp)
			                      {
			                        if(resp) return "ok",
			                          swal(
			                            'Foto Removida!',
			                            'Sua foto de perfil foi removida com sucesso.',
			                            'success'
			                          ).then(function() {
			                            location.href = 'perfil.php';
			                          });
			                      }
			            })
			          }
			    })

		};
	</script>
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function () {
		    $('#sub').click(function() {
		      checked = $("input[type=checkbox]:checked").length;
		      //nmrChassi = $("#chassi").val();
		      nmrChassi = $("#chassi").length;
		      modelo = $("#modelo").val();
		      if(checked<2) {
		      	Swal.fire("Erro", "vc precisa selecionar ao menos duas caracteristicas...", "error");
		      	return false;
		      }
		      else{
		      	adicionaVeiculo();
		      }
		    });
		});
	</script>

</body>

</html>