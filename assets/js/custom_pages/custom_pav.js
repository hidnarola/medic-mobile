var gps_device_data = '';

$(function(){
	$('.select-search').select2();
	$('.select').select2({
        minimumResultsForSearch: Infinity
    });
    $('.select-size-sm').select2({
        containerCssClass: 'select-sm'
    });

    $('[data-popup="lightbox"]').fancybox({
        padding: 3
    });

    $('.multiselect-full-featured').multiselect({
        includeSelectAllOption: true,
        enableFiltering: true,
        templates: {
            filter: '<li class="multiselect-item multiselect-filter"><i class="icon-search4"></i> <input class="form-control" type="text" style="min-width: auto;width: 100%;"></li>'
        },
        onSelectAll: function() {
            $.uniform.update();
        }
    });
    $(".styled, .multiselect-container input").uniform({ radioClass: 'choice'});
    var switches = Array.prototype.slice.call(document.querySelectorAll('.switch'));
    switches.forEach(function(html) {
        var switchery = new Switchery(html, {color: '#4CAF50'});
    });

//    get_device_data();
    function get_device_data(){
	    $.ajax({
	        type: "POST",
	        url: site_url + "Device/get_data",
	        async: false,
	        dataType: 'json',
			success: function(data){
				gps_device_data = data;
				console.log(gps_device_data);
				setTimeout(function(){get_device_data();}, 7000);
			}
		});
	}
});
