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
	<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
	<script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
</head>
<body>
	<div id="menu">
		<?php
			include(__DIR__.'/./template/menu.php');
		?>
	</div>
	<main>
		<div class="container-fluid">
			<div class="content">
				<div class="table-responsive">
					<table id="tabelaCarros" class="display">
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
								<th scope="col"><!--Editar--></th>
								<th scope="col"><!--Excluir--></th>
							</tr>
						</thead>
						<tbody>
							
								<?php
									if ($listaCarros==null) {
										echo "<h1>Nao ha nenhum veiculo na nossa base de dados</h1>";
									}else{
										foreach ($listaCarros as $carros) {
											echo "
													<tr>
														<th scope='row'>".$carros->getId()."</th>
														<td>".$carros->getNmrChassi()."</td>
														<td>".$carros->getMarca()."</td>
														<td>".$carros->getModelo()."</td>
														<td>".$carros->getAno()."</td>
														<td>".$carros->getId()."</td>
														<td>".$carros->getId()."</td>
														<td>".$carros->getCaracteristicas()."</td>
														<td><button class='btn btn-warning'>Editar</button></td>
														<td><button class='btn btn-danger'>Editar</button></td>
													</tr>
												";
										}
									}
								?>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</main>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#tabelaCarros').dataTable(filter: true);
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
			        "zeroRecords":    "Não há nenhum evento disponivel",
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