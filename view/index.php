<?php include("../model/DAO/CarroDAO.php")?>
<?php
	$co=new CarroDAO();
	$listaCarros=$co->selectTodosCarros();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php include(__DIR__.'/./template/head.php')?>
	<title>Gerenciar Veiculos</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
	<script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>

</head>
<body>
	<div id="menu">
		<?php
			include(__DIR__.'/./template/menu.php');
		?>
	</div>
	<main>
		<div class="container-fluid" style="padding: 10%">
			<div class="content">
				<div class="text-center">
					<hr>
					<h1>Veiculos</h1>
					<hr>
					<a href="add_veiculo.php" class="btn btn-success btn-lg btn-block">adicionar veiculo</a>
					<hr>
				</div>

				<div class="table-responsive" style="margin-top: 10%">
					<table id="tabelaCarros" class="display table table-striped">
						<caption>Tabela de veiculos</caption>
						<thead>
							<tr>
								<th scope="col">ID</th>
								<th scope="col">Nmr. Chassi</th>
								<th scope="col">Marca</th>
								<th scope="col">Modelo</th>
								<th scope="col">Ano</th>
								<th scope="col">Placa</th>
								<th scope="col">Caracteristicas</th>
								<th scope="col">Editar</th>
								<th scope="col">Excluir</th>
							</tr>
						</thead>
						<tbody>
								<?php
									foreach ($listaCarros as $carros) {
										echo "
												<tr>
													<th scope='row'>".$carros->getId()."</th>
													<td>".$carros->getNmrChassi()."</td>
													<td>".$carros->getMarca()."</td>
													<td>".$carros->getModelo()."</td>
													<td>".$carros->getAno()."</td>
													<td>".$carros->getPlaca()."</td>
													<td>".$carros->getCaracteristicas()."</td>
													<td><a name='idEvento' href=\"edit_veiculo.php?idVeiculo=".$carros->getId()."\" type='button' class='btn btn-warning'>Editar</a></td>
													<td><a type='button' class='btn btn-danger' onclick='excluirVeiculo(".$carros->getId().")'>Excluir</a></td>
												</tr>
											";
									}
								?>							
						</tbody>
					</table>
				</div>
				
				<hr>

			</div>
		</div>
	</main>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#tabelaCarros').dataTable();
		});
	</script>
	<script type="text/javascript">
			$('#tabelaCarros').dataTable( {
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

		<script type="text/javascript">
			function excluirVeiculo(idVeiculo){
				const swalWithBootstrapButtons = Swal.mixin({
				  customClass: {
				    confirmButton: 'btn btn-success',
				    cancelButton: 'btn btn-danger'
				  },
				  buttonsStyling: false
				})

				swalWithBootstrapButtons.fire({
				  title: 'Tem certeza que deseja excluir este veiculo?',
				  text: "Voce nao sera capaz de reverter esta decisao!",
				  icon: 'warning',
				  showCancelButton: true,
				  confirmButtonText: 'Sim, eu desejo excluir!',
				  cancelButtonText: 'Nao, eu nao desejo mais excluir!',
				  reverseButtons: true
				}).then((result) => {
				  if (result.value) {
				    $.ajax({
	                    url:'excluir_veiculo.php',
	                    method:'POST',
	                    data:{
	                       idVeiculo:idVeiculo
	                    },
	                    success:function(response){
	                        Swal.fire(
								'Sucesso!',
								'O veiculo foi excluido com sucesso!',
								'success'
							).then(function() {
								location.reload();
							});
	                    }
	                });
				  } else if (
				    /* Read more about handling dismissals below */
				    result.dismiss === Swal.DismissReason.cancel
				  ) {
				    swalWithBootstrapButtons.fire(
				      'Cancelado',
				      'Seu veiculo nao foi excluido e esta seguro :)',
				      'error'
				    )
				  }
				})
			}
		</script>
</body>
</html>