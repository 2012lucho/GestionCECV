$(document).ready(function(){
	$('#ebusca').on('input', function() {
		$('#lbusca').attr('href','http://localhost/cecv/frontend/web/index.php/busca/'+encodeURIComponent($('#ebusca').val()));
	});
	$('#ebusca').on('click', function() {
		$('#ebusca').val('')		
	});
});