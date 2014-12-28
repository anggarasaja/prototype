function searchtext() {
	var min_length = 0;
	var keyword = $('#search_atlet').val();
	if (keyword.length >= min_length) {
		$.ajax({
			url: 'ajax/search_atlet.php',
			type: 'POST',
			data: {keyword:keyword},
			success:function(data){
				$('#search_list_atlet').show();
				$('#search_list_atlet').html(data);
			}
		});
	} else {
		$('#search_list_atlet').hide();
	}
}

function set_item(item) {
	$('#search_atlet').val(item);
	$('#search_list_atlet').hide();
}

function search_click(lat,lng) {
	map.panTo(new google.maps.LatLng(lat,lng));
	map.setZoom(15);
}