<?php include("../model/DAO/CarroDAO.php")?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php include(__DIR__.'/./template/head.php')?>
	<title>Editar veiculo</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
	<script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
	<?php 
		if (!isset($_GET['idVeiculo'])) {
		echo "<script>Swal.fire(
				'Erro!',
				'Este veiculo nao foi encontrado!',
				'error'
				).then(function() {
					window.location.href= './index.php';
			});</script>";
		}else{
			$co=new CarroDAO();	
			$listaCaracteristicas=$co->selectCaracteristicasUpdate($_GET['idVeiculo']);
			$listaMarcaModelos=$co->selectMarcaModeloUpdate($_GET['idVeiculo']);
			$chassi=$co->getNmrChassiById($_GET['idVeiculo']);
			$ano=$co->getAnoById($_GET['idVeiculo']);
			$placa=$co->getPlacaById($_GET['idVeiculo']);
		}
	?>
</head>
<body>
	<div id="menu">
		<?php
			include(__DIR__.'/./template/menu.php');
		?>
	</div>
	<main>
		<div class="content-fluid" style="padding: 10%">
			<div class="text-center">
				<h1>Editar veiculo</h1>
			</div>
			<form method="POST" name="frmveiculo" id="frmveiculo">
				<input type="hidden" name="idVeiculo" value="<?php echo $_GET['idVeiculo']?>">
				<div style="padding-top: 10%" class="table-responsive text-center">
					<hr>
					<h4>Selecione o modelo....</h4>
					<table id="tabelaMarcaModelos" class="display table table-striped">
						<caption>Tabela de modelos</caption>
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
					<hr>
				</div>
				<hr>
				<h4>Descreva o veiculo</h4>
				<div class="form-group">
					<div class="form-row">
						<div class="col">
							<h6>Numero do chassi*</h6>
							<input type="text" maxlength="17" minlength="17" class="form-control" value="<?php echo $chassi; ?>" id="chassi" name="chassi" required="">
						</div>
					</div>
					<div class="form-group">
						<div class="form-row">
							<div class="col-md-6">
								<h6>Ano*</h6>
								<input type="text" maxlength="4" minlength="4" class="form-control" pattern="[0-9]*" id="ano" name="ano" value="<?php echo $ano; ?>" required="">
							</div>
							<div class="col-md-6">
								<h6>Placa</h6>
								<input type="text" maxlength="7" minlength="7" class="form-control" value="<?php echo $placa; ?>" id="placa" name="placa" required="">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<select class="slMultiple form-control" required multiple="multiple" name="caracteristicas[]" id="caracteristicas" size="10">
								<?php
									foreach ($listaCaracteristicas as $carac) {
										echo $carac;
									}
								?>
								option
							</select>
						</div>
					</div>
				</div>
				<hr>
				<button class="btn btn-success btn-lg btn-block" id="btSelecionar" name="btSelecionar">Editar</button>
			</form>
		</div>
	</main>
	<script type="text/javascript" charset="utf-8">
		$(document).on('click', '#btSelecionar', function(event) {
			event.preventDefault();
			
		    $.ajax({type: "POST",
		        url: "editar_veiculo.php",
		        type: "POST",
		        data: $( "form" ).serialize(),
		        success: function(response) {
		        	if (response!=' sucesso') {
		        		var r = JSON.parse(response);
		        		Swal.fire(
								'Erro!',
								"Nao foi possivel editar o veiculo! Erro: "+r.response+"",
								'error'
								).then(function() {
									return false;
								});
		        	}else{
		        		Swal.fire(
						'Sucesso!',
						'O veiculo foi adicionado com sucesso!',
						'success'
							).then(function() {
								window.location.href= "index.php";
							});	
		        	}		        	
		        },
		        error: function(jqXHR, textStatus){
		            console.log(textStatus, jqXHR);
		        }
		    });
		});</script>

	<script type="text/javascript" charset="utf-8">
		$(document).ready(function () {
				$("#frmveiculo").validate({
				    rules:{
				    	caracteristicas:{
				    		minlength:2,
				    		required:true
				    	},
				        chassi:{
				            required: true,
				            minlength: 17,
				            maxlength: 17
				        },
				        modelo:{
				            required: true
				        },
				        ano:{
				        	number:true,
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
				    	caracteristicas:{
				    		required:"Caracteristicas sao obrigatorias...",
				    		minlength:"selecione pelo menos duas caracteristicas"
				    	},    
				       	chassi:{
				            required: "O chassi do veiculo é obrigatório...",
				            minlength: jQuery.format("O chassi deve conter pelo menos {0} digitos..."),
				            maxlength: jQuery.format("O chassi deve conter menos que {0} digitos...")
				        },
				        modelo:{
				            required: "Selecione um modelo..."
				        },
				        ano:{
				        	number: "Por favor, digite apenas o ano...",
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
			});</script>

	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			$('#tabelaMarcaModelos').dataTable();
		});

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