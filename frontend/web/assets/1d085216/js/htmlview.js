$(document).ready(function(){
	$('#ebusca').on('input', function() {
		$('#lbusca').attr('href','http://localhost/cecv/frontend/web/index.php/busca/'+$('#ebusca').val());
	});
	$('#ebusca').on('click', function() {
		$('#ebusca').val('')		
	});
});