<?php include("../model/DAO/CarroDAO.php")?>
<?php
	$co=new CarroDAO();
	$listaMarcas=$co->selectMarca();
	$listaCaracteristicas=$co->selectCaracteristicas();
	$listaModelos=$co->selectModelos();
	$listaMarcaModelos=$co->selectMarcaModelo();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php include(__DIR__.'/./template/head.php')?>
	<title>Adicionar veiculo</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
	<script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<link href="vendor/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="vendor/select2/dist/js/select2.min.js"></script>
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
			<form method="POST" id="input-progress" role="form" onsubmit="adicionaVeiculo()">
				<div class="form-group">
					<div class="form-row">
						<div class="col">
							<h6>nmr_chassi*</h6>
							<input type="text" maxlength="19" minlength="19" class="form-control" placeholder="Digite o chassi do veiculo..." id="chassi" name="chassi" required="">
						</div>
					</div>
				</div>

				<div class="table-responsive text-center">
					<table id="tabelaMarcaModelos" class="display table table-striped">
						<caption>Tabela de veiculos</caption>
						<thead>
							<tr>
								<th scope="col">Marca</th>
								<th scope="col">Modelo</th>
								<th scope="col">Selecionar</th>
							</tr>
						</thead>
						<tbody>
								<?php
									foreach ($listaMarcaModelos as $modelos) {
										echo "<tr>";
										echo $modelos;
										echo "</tr>";
									}	
								?>
						</tbody>
					</table>
				</div>
				<br>
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
							<select class="js-example-basic-multiple" required="" name="caracteristicas[]" id="carac" multiple="multiple">
								<?php
									foreach ($listaCaracteristicas as &$l) {
										echo $l;
									}
								?>
							</select>
					</div>
				</div>

				<br>
				<button type="submit" id="sub" class="btn btn-success btn-lg btn-block">adicionar veiculo</button>
			</form>
		</div>
	</main>

	<script type="text/javascript" charset="utf-8" async defer>
		$(document).ready(function() {
		    $('.js-example-basic-multiple').select2();
		});
	</script>

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
			var modelo=$('input[type=radio][name=modelo]:checked').val();
			var placa=$('#placa').val();
			//var caracteristicas=$("input[type=checkbox]:checked");
			checked = $("option:selected").length;
			var caract;
			alert(placa);
			$("#carac").each(function(){
		    	caract.push($(this).val());
			});
			alert(toString(caract));
		    if(checked<2) {
		     	Swal.fire("Erro", "vc precisa selecionar ao menos duas caracteristicas...", "error");
		    }else if (!chassi || !ano || !modelo || !placa) {
				Swal.fire(
					'Erro!',
					'Nao foi possivel adicionar este veiculo, ha campos em branco!',
					'error'
					);
			}else{
				alert("SADASDSADASDASD");
				$.ajax({
					url:'adicionar_veiculo.php',
					method:'POST',
					data:{
						chassi:chassi,
						ano:ano,
						modelo:modelo,
						placa:placa
					},
					success:function(response){
						if (!response){
							Swal.fire(
								'Erro!',
								'Nao foi possivel adicionar o veiculo! '+response+'',
								'error'
								).then(function() {
									location.reload();
								});
						}
						Swal.fire(
							'Sucesso!',
							'O veiculo foi adicionado com sucesso!',
							'success'
							).then(function() {
								window.location.href= "index.php";
							});
						},
						error:function(response) {
							Swal.fire(
								'Erro!',
								'Nao foi possivel adicionar o veiculo! '+response+'',
								'error'
								).then(function() {
									location.reload();
								});
							}
						});
			}
			return false;
		}
	</script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#tabelaMarcaModelos').dataTable();
		});
	</script>
	<script type="text/javascript">
			$('#tabelaMarcaModelos').dataTable( {
				"language": {
				  	"emptyTable": "Não há nenhum veiculo disponivel",
				  	"info": "Mostrando _START_ de _END_ de um total de _TOTAL_ veiculos",
				  	"infoEmpty": "Mostrando 0 de um total de 0 entradas",
				  	"infoFiltered":   "(filtrado de um total de _MAX_ total veiculos)",
			        "infoPostFix":    "",
			        "thousands":      ".",
			        "lengthMenu":     "Mostrar _MENU_ veiculos",
				  	"loadingRecords": "Carregando...",
			        "processing":     "Processando...",
			        "search":         "Buscar:",
				  	"searchPlaceholder": "Filtre por qualquer coisa aqui...",
			        "zeroRecords":    "Não há nenhum veiculo disponivel",
				    "paginate": {
				      "first":      "Primeira",
	            	  "last":       "Última",
				      "previous": "Anterior",
				      "next": "Próximo"
			    }
			  },
			  	"Search": {
            		"addClass": 'form-control input-lg col-xs-12'
        		},
        		"fnDrawCallback":function(){
		            $("input[type='search']").attr("id", "searchBox");
		            $('#dialPlanListTable').css('cssText', "margin-top: 0px !important;");
		            $("select[name='dialPlanListTable_length'], #searchBox").removeClass("input-sm");
		            $('#searchBox').css("width", "300px").focus();
		            $('#dialPlanListTable_filter').removeClass('dataTables_filter');
        		}
        
			} );
		</script>

</body>

</html>