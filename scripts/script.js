/**
Funcao que modifica o progresso da barra de progresso
*/
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