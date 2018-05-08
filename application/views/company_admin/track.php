<style>
	.navbar{ display:none; }
	.page-container{padding:0px;}
	.btm-page{ position:fixed; bottom:0; right:45px;}
	.btmpage-arrow{position: absolute;width: 28px; right: 150px; bottom: 100%;}
	.btmpage-arrow a{background:#ddd;padding:0 2px; color:#000; font-size:18px; line-height:100%;  }
	.btmpage-arrow a:before {right:100%; border-left:22px solid transparent; }
	.btmpage-arrow a:after { left:100%; border-right:22px solid transparent; }
	.btmpage-arrow a:after,
	.btmpage-arrow a:before{top:-2px; border-bottom:22px solid #ddd; content: " "; display: inline-block; position: absolute; width: 0; height: 0;}
	.btmpage-arrow a i{ line-height: 17px; vertical-align: bottom; font-size: 24px; font-weight:700;}
	.btmpage-arrow a:hover{ color:#FF5722; }
	.data-show:after{content:''; display:block; clear:both;}
	.data-show{ border:1px solid #eee; border-right:0; margin: -2px 0 0 -22px; background: #fff; min-width:400px;	}	
	.datashow-column{ width: 33.33%; float: left; min-width: 300px; border-right: 1px solid #eee;}
	.datashow-column h3{margin:0;padding:0; color:#000; background-color: #ddd; border-bottom:1px solid #eee; font-size: 1.1em; padding:9px 15px;}
    .datashow-column h3 i{color:#ff5722; vertical-align:middle; line-height: 100%;}
    .datashow-column table{ padding:0; border:0; margin:10px; border:0; width:calc(100% - 20px);}
    .datashow-column table.table tbody  tr td{ border:0; border-bottom:1px solid #eee; padding:4px; font-size:13px; letter-spacing: 1px}
	.datashow-column table.table tbody  tr td.heading i{ color: #ccc; }
	.datashow-column table.table tbody  tr td.heading{ font-size: 13px;letter-spacing: 1px;font-weight: 500; }

	.sticky-hdr{position:fixed; top:0; left:0; width:100%; border-top:5px solid #fff; z-index:10;}
	.sticky-hdr-l{float:left; background:#fff;position:relative;    margin:-5px 0 0;}
	.sticky-hdr-l:after{border-left:100px solid #fff; content:" "; display:block; position:absolute; bottom:0; left:100%; width:0; height: 0; z-index: 1; border-bottom:50px solid transparent; }
	.sticky-hdr-l a.hdr-back-btn{width:50px; line-height: 50px; padding: 0 10px; background: #FF5722; display: inline-block; vertical-align: top; color: #fff; text-align: center;} 
	.sticky-hdr-l a.hdr-logo{ display:inline-block; vertical-align:top; padding:5px 10px;}
	.sticky-hdr-l a.hdr-logo img{max-width:40px;}
	.sticky-hdr-r{float:right; background:#fff;position:relative; margin:-5px 0 0;}
	.sticky-hdr-r:after{border-right:100px solid #fff; content:" "; display:block; position:absolute; bottom:0; right:100%; width:0; height: 0; z-index: 1; border-bottom:50px solid transparent; }
	.hdr-setting-btn{background:#fff; width:50px; text-align:center; display:inline-block; vertical-align:top;  }
	.hdr-setting-btn a{position:relative; line-height:50px; color:#666; font-size:18px; }
	ul.hdr-icon-list{margin:0; padding:0; list-style:none; float:left;  }
	ul.hdr-icon-list>li{float:left; padding:0 10px; position:relative;}
	ul.hdr-icon-list>li>a{ display:block; line-height:50px; color:#ccc;  font-size:18px;}
	ul.hdr-icon-list>li>ul{display:none;}
	ul.hdr-icon-list>li:hover>ul{display:block; position:absolute; top:100%; right:0; min-width:130px; background:#fff; border:0; padding:0; border:1px solid #eee; }
	ul.hdr-icon-list>li:hover>a{color:#ff5722;}
	ul.hdr-icon-list>li ul li{display:block; border-bottom:1px solid #f5f5f5;}
	ul.hdr-icon-list>li ul li a{display:block; color:#666; font-size:12px; padding:6px 15px;}
	ul.hdr-icon-list>li ul li a:hover{background:#ff5722; color:#fff; }
</style>
<script>
	var mapOptions 	= '',
   		map 		= '',
    	start_point = [],
		end_point 	= [],
		lat_lng 	= [],
		lat_lng_2 	= [],
		path 		= [],
		marker 		= '',
		prev_latlng;
		var cnt = 0;
		var gps_track = <?php echo json_encode($vehicle_latlong); ?>;
		var last_index = gps_track.length-1;
	function initMap() {
  		$('#map').show();
  		mapOptions = {
			zoom: 19,
	        center: new google.maps.LatLng({lat:54.602129, lng: -7.302873}),
	        mapTypeControl: true,
         	mapTypeControlOptions: {
              	position: google.maps.ControlPosition.LEFT_BOTTOM
          	},
          	fullscreenControl: true,
	        fullscreenControlOptions: {
	            position: google.maps.ControlPosition.RIGHT_BOTTOM
	        },
	        mapTypeId: google.maps.MapTypeId.HYBRID
	    }; 

	    map = new google.maps.Map(document.getElementById("map"), mapOptions);
	    if(gps_track.length!=0){
	    	if(gps_track[0]['is_google_route']==1){
	    		setTimeout(function(){
				  	google_route_livemap('<?php echo $this->uri->segment(3); ?>');
				}, 1000);	
	    	}else{
	    		setTimeout(function(){
				  	normal_livemap('<?php echo $this->uri->segment(3); ?>');
				}, 1000);	
	    	}
	    }else{
			new PNotify({
	            title: 'Warning notice',
	            text: 'No Data Exists for this timeframe. Page will auto redirect to live tracking page.',
	            addclass: 'bg-warning'
	        });
			var deviceGUID = '<?php echo $this->uri->segment(3); ?>';
	        var current_latlng = new google.maps.LatLng(
				parseFloat((gps_device_data[deviceGUID]['GPS']['Latitude'])),
				parseFloat((gps_device_data[deviceGUID]['GPS']['Longitude']))
			);
	        marker = new google.maps.Marker({
	            position: current_latlng,
	            map: map
	        });
	        var latlngbounds = new google.maps.LatLngBounds();
	    	latlngbounds.extend(marker.position);
	    	var bounds = new google.maps.LatLngBounds();
	    	map.setCenter(latlngbounds.getCenter());
	    	setInterval( function(){
		        noraml_live_track(deviceGUID);
		  	}, 7000 );
	    //     setInterval( function(){
		   //      noraml_live_track('<?php echo $this->uri->segment(3); ?>');
		  	// }, 3000 );
	        // setTimeout(function(){
	        // 	window.location.href = 'track/vehicle/<?php echo $this->uri->segment(3); ?>';
	        // },5000);
	    }
	}
	function google_route_livemap(deviceGUID){
		start_point.push(
			parseFloat((gps_track[0]['latitude']).replace('"','')), 
			parseFloat((gps_track[0]['longitude']).replace('"',''))
		);
		var path = new google.maps.MVCArray();
        var service = new google.maps.DirectionsService();
        var poly = new google.maps.Polyline({ 
        	map:map,
        	strokeColor: '#00b3fd',
        	strokeOpacity: 1,
        	strokeWeight: 5
        });

        var src = new google.maps.LatLng(
        	parseFloat(gps_track[0]['latitude'].replace('"','')),
        	parseFloat(gps_track[0]['longitude'].replace('"',''))
        );
        

        var des = new google.maps.LatLng(
        	parseFloat(gps_track[last_index]['latitude'].replace('"','')),
        	parseFloat(gps_track[last_index]['longitude'].replace('"',''))
        );
        var waypoints = [];
        for(var i = 1; i < (gps_track.length-1); i+=500){
        	var source_latlng = new google.maps.LatLng(
				parseFloat((gps_track[i]['latitude']).replace('"','')),
				parseFloat((gps_track[i]['longitude']).replace('"',''))
			);
    		waypoints.push({location:source_latlng, stopover: false});
        }
        path.push(src);
        poly.setPath(path);
        service.route({
            origin: src,
            destination: des,
            waypoints: waypoints,
            travelMode: google.maps.DirectionsTravelMode.DRIVING
        }, function (result, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                for (var k = 0, len = result.routes[0].overview_path.length; k < len; k++) {
                    path.push(result.routes[0].overview_path[k]);
                }
            }
        });

        marker = new google.maps.Marker({
            position: des,
            map: map
        });
        var latlngbounds = new google.maps.LatLngBounds();
    	latlngbounds.extend(marker.position);
    	var bounds = new google.maps.LatLngBounds();
    	map.setCenter(latlngbounds.getCenter());
    	$('.device_time').html(gps_device_data[deviceGUID]['Time_stamp']);
        var infoWindow = new google.maps.InfoWindow({
		    maxWidth: 350,
		    display: 'inline'
		});
        var content = 	'<div id="iw-container">' +
		                	'<div class="iw-title">'+deviceGUID+'</div>' +
		            		'<div class="iw-content">' +
		              			'<p>'+
		              				'<table><tbody>'+
		              					'<tr><th>Address&nbsp;&nbsp;</th><td>'+start_point[0]+', '+start_point[1]+'</td></tr>' +
		              					'<tr><th>Date Time&nbsp;&nbsp;</th><td>'+gps_device_data[deviceGUID]['Time_stamp']+'</td></tr>'+
		              				'</tbody></table></p>' +
		            		'</div>' +
		            		'<div class="iw-bottom-gradient"></div>' +
		          		'</div>';
		google.maps.event.addListener(marker,'mouseover', function(){ 
			infoWindow.close(); 
			infoWindow.setContent(content);
			infoWindow.open(map, this); 
		});
		google.maps.event.addListener(infoWindow, 'domready', function() {
		   	var iwOuter = $('.gm-style-iw');
		    var iwBackground = iwOuter.prev();
		    iwOuter.children(':nth-child(1)').css({'display' : 'inline'});
		    iwBackground.children(':nth-child(2)').css({'display' : 'none'});
		    iwBackground.children(':nth-child(4)').css({'display' : 'none'});
		    iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index' : '1'});
		    var iwCloseBtn = iwOuter.next();
		    iwCloseBtn.css({width:'27px', height:'27px', opacity: '1', right: '38px', top: '3px', border: '7px solid #48b5e9', 'border-radius': '13px', 'box-shadow': '0 0 5px #3990B9'});
		    if($('.iw-content').height() < 140){
		      $('.iw-bottom-gradient').css({display: 'none'});
		    }
		    iwCloseBtn.mouseout(function(){
		      $(this).css({opacity: '1'});
		    });
		});

		if(window.location.href.indexOf('?track_date') == 0){
		 	setInterval( function(){
		        google_route_live_track(deviceGUID);
		  	}, 3000 );
		}
	}

	function google_route_live_track(deviceGUID){
		lat_lng = [];
		if(cnt==0){
			var source_latlng = new google.maps.LatLng(
	        	parseFloat(gps_track[last_index]['latitude'].replace('"','')),
	        	parseFloat(gps_track[last_index]['longitude'].replace('"',''))
	        );
	        lat_lng.push(source_latlng);
	        cnt = 1;
		} else {
			lat_lng.push(prev_latlng);
		}

		var destination_latlng = new google.maps.LatLng(
			parseFloat((gps_device_data[deviceGUID]['GPS']['Latitude'])),
			parseFloat((gps_device_data[deviceGUID]['GPS']['Longitude']))
		);
		lat_lng.push(destination_latlng);
		prev_latlng = destination_latlng;

		marker.setMap(null);
		marker = new google.maps.Marker({
            position: destination_latlng,
            map: map
        });
        var latlngbounds = new google.maps.LatLngBounds();
    	latlngbounds.extend(marker.position);
    	var bounds = new google.maps.LatLngBounds();
    	map.setCenter(latlngbounds.getCenter());
    	$('.device_time').html(gps_device_data[deviceGUID]['Time_stamp']);

        var infoWindow = new google.maps.InfoWindow({
		    maxWidth: 350,
		    display: 'inline'
		});
        var content = 	'<div id="iw-container">' +
		                	'<div class="iw-title">'+deviceGUID+'</div>' +
		            		'<div class="iw-content">' +
		              			'<p>'+
		              				'<table><tbody>'+
		              					'<tr><th>Address&nbsp;&nbsp;</th><td>'+start_point[0]+', '+start_point[1]+'</td></tr>' +
		              					'<tr><th>Date Time&nbsp;&nbsp;</th><td>'+gps_device_data[deviceGUID]['Time_stamp']+'</td></tr>'+
		              				'</tbody></table></p>' +
		            		'</div>' +
		            		'<div class="iw-bottom-gradient"></div>' +
		          		'</div>';
		google.maps.event.addListener(marker,'mouseover', function(){ 
			infoWindow.close(); 
			infoWindow.setContent(content);
			infoWindow.open(map, this); 
		});
		google.maps.event.addListener(infoWindow, 'domready', function() {
		   	var iwOuter = $('.gm-style-iw');
		    var iwBackground = iwOuter.prev();
		    iwOuter.children(':nth-child(1)').css({'display' : 'inline'});
		    iwBackground.children(':nth-child(2)').css({'display' : 'none'});
		    iwBackground.children(':nth-child(4)').css({'display' : 'none'});
		    iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index' : '1'});
		    var iwCloseBtn = iwOuter.next();
		    iwCloseBtn.css({width:'27px', height:'27px', opacity: '1', right: '38px', top: '3px', border: '7px solid #48b5e9', 'border-radius': '13px', 'box-shadow': '0 0 5px #3990B9'});
		    if($('.iw-content').height() < 140){
		      $('.iw-bottom-gradient').css({display: 'none'});
		    }
		    iwCloseBtn.mouseout(function(){
		      $(this).css({opacity: '1'});
		    });
		});

		var path = new google.maps.MVCArray();
        var service = new google.maps.DirectionsService();
        var poly = new google.maps.Polyline({
        	map:map,
        	strokeColor: '#00b3fd',
        	strokeOpacity: 1,
        	strokeWeight: 5
        });

        //Loop and Draw Path Route between the Points on MAP
        for (var j = 0; j < lat_lng.length; j++) {
            if ((j + 1) < lat_lng.length) {
                var src = lat_lng[j];
                var des = lat_lng[j + 1];
                path.push(src);
                poly.setPath(path);
                service.route({
                    origin: src,
                    destination: des,
                    travelMode: google.maps.DirectionsTravelMode.DRIVING
                }, function (result, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                        for (var k = 0, len = result.routes[0].overview_path.length; k < len; k++) {
                            path.push(result.routes[0].overview_path[k]);
                        }
                    }
                });
            }
        }

	    // Address
	    $.getJSON("http://maps.googleapis.com/maps/api/geocode/json?latlng="+parseFloat(gps_device_data[deviceGUID]['GPS']['Latitude'])+","+parseFloat(gps_device_data[deviceGUID]['GPS']['Longitude'])+"&sensor=true",
			function(data) {
		    	$('.device_address').html("<a href='https://www.google.com/maps?q="+parseFloat(gps_device_data[deviceGUID]['GPS']['Latitude'])+","+parseFloat(gps_device_data[deviceGUID]['GPS']['Longitude'])+"' target='_blank'>"+((data['results'][0].formatted_address).substr(0,20))+"...</a>");
			}
		);

	    //Ignition
	    if(gps_device_data[deviceGUID]['STT']!=undefined){
		    if(gps_device_data[deviceGUID]['STT']['Alarm']['[Bit01]']=='0--Moved'){
		    	$('.device_ignition').html('Off');
		    }else{
		    	$('.device_ignition').html('On');
		    }
	    }

	    // Speed
	    var speed = '0 Km/h';
	    if(gps_device_data[deviceGUID]['J1708']!=undefined){
	    	speed = (gps_device_data[deviceGUID]['J1708']['PID84']).split('--')[0];
	    }
	    $('.device_speed').html(speed);

		// Google StreetView
	    html = '<a href="http://maps.google.com/maps?q=&layer=c&cbll='+parseFloat(gps_device_data[deviceGUID].GPS.Latitude)+','+parseFloat(gps_device_data[deviceGUID].GPS.Longitude)+'&cbp=11,0,0,0,0" target="_blank">';
	    html+= '<img src="https://maps.googleapis.com/maps/api/streetview?size=290x150&location='+parseFloat(gps_device_data[deviceGUID].GPS.Latitude)+','+parseFloat(gps_device_data[deviceGUID].GPS.Longitude)+'&heading=151.78&pitch=-0.76&key=AIzaSyAE19qNQTlcPGeOthK32NgAUo1xoiks_-Y">';
		html+= '</a>';
	    $('.tbl_google_strettview tr td').html(html);
	}

	function normal_livemap(deviceGUID){
		start_point.push(
			parseFloat((gps_track[0]['latitude']).replace('"','')), 
			parseFloat((gps_track[0]['longitude']).replace('"',''))
		);
        for(var i = 0; i < gps_track.length; i++){
        	var _latlng = new google.maps.LatLng(
				parseFloat((gps_track[i]['latitude']).replace('"','')),
				parseFloat((gps_track[i]['longitude']).replace('"',''))
			);
    		lat_lng.push(_latlng);
        }
        if(window.location.href.indexOf('?track_date') == 0){
	        var current_latlng = new google.maps.LatLng(
				parseFloat((gps_device_data[deviceGUID]['GPS']['Latitude'])),
				parseFloat((gps_device_data[deviceGUID]['GPS']['Longitude']))
			);
			lat_lng.push(current_latlng);
			prev_latlng = current_latlng;
		}else{
			current_latlng = _latlng;
		}

        for (var j = 0; j < lat_lng.length; j++) {
            if ((j + 1) < lat_lng.length) {
                var src = lat_lng[j];
                var des = lat_lng[j + 1];
                path.push(src);
                path.push(des);
                var poly = new google.maps.Polyline({
		        	map: map,
		        	path: lat_lng,
		        	geodesic: true,
		        	strokeColor: '#FF5722',
		        	strokeOpacity: 1,
		        	strokeWeight: 2
		        });
		        path = [];
		    }
		}
        marker = new google.maps.Marker({
            position: current_latlng,
            map: map
        });
        var latlngbounds = new google.maps.LatLngBounds();
    	latlngbounds.extend(marker.position);
    	var bounds = new google.maps.LatLngBounds();
    	map.setCenter(latlngbounds.getCenter());
    	$('.device_time').html(gps_device_data[deviceGUID]['Time_stamp']);
        var infoWindow = new google.maps.InfoWindow({
		    maxWidth: 350,
		    display: 'inline'
		});
        var content = 	'<div id="iw-container">' +
		                	'<div class="iw-title">'+deviceGUID+'</div>' +
		            		'<div class="iw-content">' +
		              			'<p>'+
		              				'<table><tbody>'+
		              					'<tr><th>Address&nbsp;&nbsp;</th><td>'+start_point[0]+', '+start_point[1]+'</td></tr>' +
		              					'<tr><th>Date Time&nbsp;&nbsp;</th><td>'+gps_device_data[deviceGUID]['Time_stamp']+'</td></tr>'+
		              				'</tbody></table></p>' +
		            		'</div>' +
		            		'<div class="iw-bottom-gradient"></div>' +
		          		'</div>';
		google.maps.event.addListener(marker,'mouseover', function(){ 
			infoWindow.close(); 
			infoWindow.setContent(content);
			infoWindow.open(map, this); 
		});
		google.maps.event.addListener(infoWindow, 'domready', function() {
		   	var iwOuter = $('.gm-style-iw');
		    var iwBackground = iwOuter.prev();
		    iwOuter.children(':nth-child(1)').css({'display' : 'inline'});
		    iwBackground.children(':nth-child(2)').css({'display' : 'none'});
		    iwBackground.children(':nth-child(4)').css({'display' : 'none'});
		    iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index' : '1'});
		    var iwCloseBtn = iwOuter.next();
		    iwCloseBtn.css({width:'27px', height:'27px', opacity: '1', right: '38px', top: '3px', border: '7px solid #48b5e9', 'border-radius': '13px', 'box-shadow': '0 0 5px #3990B9'});
		    if($('.iw-content').height() < 140){
		      $('.iw-bottom-gradient').css({display: 'none'});
		    }
		    iwCloseBtn.mouseout(function(){
		      $(this).css({opacity: '1'});
		    });
		});

		if(window.location.href.indexOf('?track_date') == 0){
		 	setInterval( function(){
		        noraml_live_track(deviceGUID);
		  	}, 7000 );
		}
	}

	function noraml_live_track(deviceGUID){
		start_point.push(
			parseFloat((gps_device_data[deviceGUID]['GPS']['Latitude'])),
			parseFloat((gps_device_data[deviceGUID]['GPS']['Longitude']))
		);
		lat_lng = [];
		lat_lng.push(prev_latlng);
		var destination_latlng = new google.maps.LatLng(
			parseFloat((gps_device_data[deviceGUID]['GPS']['Latitude'])),
			parseFloat((gps_device_data[deviceGUID]['GPS']['Longitude']))
		);
		lat_lng.push(destination_latlng);
		prev_latlng = destination_latlng;

		marker.setMap(null);
		marker = new google.maps.Marker({
            position: destination_latlng,
            map: map
        });
        var latlngbounds = new google.maps.LatLngBounds();
    	latlngbounds.extend(marker.position);
    	var bounds = new google.maps.LatLngBounds();
    	//map.setCenter(latlngbounds.getCenter());
    	$('.device_time').html(gps_device_data[deviceGUID]['Time_stamp']);
        var infoWindow = new google.maps.InfoWindow({
		    maxWidth: 350,
		    display: 'inline'
		});
        var content = 	'<div id="iw-container">' +
		                	'<div class="iw-title">'+deviceGUID+'</div>' +
		            		'<div class="iw-content">' +
		              			'<p>'+
		              				'<table><tbody>'+
		              					'<tr><th>Address&nbsp;&nbsp;</th><td>'+start_point[0]+', '+start_point[1]+'</td></tr>' +
		              					'<tr><th>Date Time&nbsp;&nbsp;</th><td>'+gps_device_data[deviceGUID]['Time_stamp']+'</td></tr>'+
		              				'</tbody></table></p>' +
		            		'</div>' +
		            		'<div class="iw-bottom-gradient"></div>' +
		          		'</div>';
		google.maps.event.addListener(marker,'mouseover', function(){ 
			infoWindow.close(); 
			infoWindow.setContent(content);
			infoWindow.open(map, this); 
		});
		google.maps.event.addListener(infoWindow, 'domready', function() {
		   	var iwOuter = $('.gm-style-iw');
		    var iwBackground = iwOuter.prev();
		    iwOuter.children(':nth-child(1)').css({'display' : 'inline'});
		    iwBackground.children(':nth-child(2)').css({'display' : 'none'});
		    iwBackground.children(':nth-child(4)').css({'display' : 'none'});
		    iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index' : '1'});
		    var iwCloseBtn = iwOuter.next();
		    iwCloseBtn.css({width:'27px', height:'27px', opacity: '1', right: '38px', top: '3px', border: '7px solid #48b5e9', 'border-radius': '13px', 'box-shadow': '0 0 5px #3990B9'});
		    if($('.iw-content').height() < 140){
		      $('.iw-bottom-gradient').css({display: 'none'});
		    }
		    iwCloseBtn.mouseout(function(){
		      $(this).css({opacity: '1'});
		    });
		});

        for (var j = 0; j < lat_lng.length; j++) {
            if ((j + 1) < lat_lng.length) {
                var src = lat_lng[j];
                var des = lat_lng[j + 1];
                path.push(src);
                path.push(des);
                var poly = new google.maps.Polyline({
		        	map: map,
		        	path: path,
		        	geodesic: true,
		        	strokeColor: '#FF5722',
		        	strokeOpacity: 1,
		        	strokeWeight: 2
		        });
		        path = [];
            }
        }

	    // Address
	    $.getJSON("http://maps.googleapis.com/maps/api/geocode/json?latlng="+parseFloat(gps_device_data[deviceGUID]['GPS']['Latitude'])+","+parseFloat(gps_device_data[deviceGUID]['GPS']['Longitude'])+"&sensor=true",
			function(data) {
		    	$('.device_address').html("<a href='https://www.google.com/maps?q="+parseFloat(gps_device_data[deviceGUID]['GPS']['Latitude'])+","+parseFloat(gps_device_data[deviceGUID]['GPS']['Longitude'])+"' target='_blank'>"+((data['results'][0].formatted_address).substr(0,20))+"...</a>");
			}
		);

	    //Ignition
	    if(gps_device_data[deviceGUID]['STT']!=undefined){
		    if(gps_device_data[deviceGUID]['STT']['Alarm']['[Bit01]']=='0--Moved'){
		    	$('.device_ignition').html('Off');
		    }else{
		    	$('.device_ignition').html('On');
		    }
	    }

	    // Speed
	    var speed = '0 Km/h';
	    if(gps_device_data[deviceGUID]['J1708']!=undefined){
	    	speed = (gps_device_data[deviceGUID]['J1708']['PID84']).split('--')[0];
	    }
	    $('.device_speed').html(speed);

		// Google StreetView
	    html = '<a href="http://maps.google.com/maps?q=&layer=c&cbll='+parseFloat(gps_device_data[deviceGUID].GPS.Latitude)+','+parseFloat(gps_device_data[deviceGUID].GPS.Longitude)+'&cbp=11,0,0,0,0" target="_blank">';
	    html+= '<img src="https://maps.googleapis.com/maps/api/streetview?size=290x150&location='+parseFloat(gps_device_data[deviceGUID].GPS.Latitude)+','+parseFloat(gps_device_data[deviceGUID].GPS.Longitude)+'&heading=151.78&pitch=-0.76&key=AIzaSyAE19qNQTlcPGeOthK32NgAUo1xoiks_-Y">';
		html+= '</a>';
	    $('.tbl_google_strettview tr td').html(html);
	}


</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAE19qNQTlcPGeOthK32NgAUo1xoiks_-Y&callback=initMap"></script>
<script>
	$(function(){
		$('#map').css('height',$(window).height()+'px');
		$(".btmpage-arrow").click(function(){
	        $(".data-show").toggle();
	    });
	});
</script>
<div class="content-wrapper">
	<div class="panel panel-flat" style="margin-bottom:0px">
		<div class="panel-heading" style="padding:0px">
			<div class="sticky-hdr">
				<div class="sticky-hdr-l">
					<a href="<?php echo site_url('/'); ?>" class="hdr-back-btn"><i class="icon-arrow-left16"></i></a>
					<a href="<?php echo site_url('/'); ?>" class="hdr-logo"><img src="<?php echo site_url('assets/images/site_img/logo-icon.png'); ?>" alt="" /></a>
				</div>
				<div class="sticky-hdr-r">
					<ul class="hdr-icon-list">
						<li><a href="<?php echo site_url('track/vehicle/'.$this->uri->segment(3)); ?>" class="icon-location3" title="Live Tracking" id="_a_live_track"></a></li>
						<li><a href="javascript:void(0);" class="icon-calendar22" title="Time Frame" id="_a_timeframe"></a></li>
						<li><a href="<?php echo site_url('settings'); ?>" class="icon-gear" title="Settings"></a></li>
						<li><a href="<?php echo site_url('logout'); ?>" class="icon-switch" title="Logout"></a></li>
					</ul>
				</div>
			</div>
			<div id="map"></div>
			<div class="btm-page">
				<div class="btmpage-arrow" style="display:block !important"><a href="javascript:void(0)"><i class="icon-arrow-up12"></i></a></div>
				<div class="data-show" style="display:none">
					<div class="datashow-column">
						<h3>
							<i class="icon-paperplane"></i>&nbsp;&nbsp;<?php echo $this->uri->segment(4); ?>
							<div style="float:right;color:green">
								<ul><li>Online</li></ul>
							</div>
						</h3>
						<table class="table">
							<tbody>
								<tr>
									<td class="heading">Address</td>
									<td class="device_address">N/A</td>
								</tr>
								<tr>
									<td class="heading">Time</td>
									<td class="device_time">00/00/0000 00:00:00</td>
								</tr>
								<tr>
									<td class="heading">Stop duration</td>
									<td>On</td>
								</tr>
								<tr>
									<td class="heading">Driver</td>
									<td>-</td>
								</tr>
							</tbody>
						</table>
					</div>

					<div class="datashow-column">
						<h3><i class="icon-connection"></i>&nbsp;&nbsp;Sensors</h3>
						<table class="table">
							<tbody>
								<tr>
									<td class="heading"><i class="icon-key"></i>&nbsp;&nbsp;Ignition</td>
									<td class="device_ignition">N/A</td>
								</tr>
								<tr>
									<td class="heading"><i class="icon-road"></i>&nbsp;&nbsp;Odometer</td>
									<td>N/A</td>
								</tr>
								<tr>
									<td class="heading"><i class="icon-meter-fast"></i>&nbsp;&nbsp;Speed</td>
									<td class="device_speed">N/A</td>
								</tr>
							</tbody>
						</table>
					</div>

					<div class="datashow-column">
						<h3><i class="icon-camera"></i>&nbsp;&nbsp;Google StreetView</h3>
						<table class="table tbl_google_strettview" style="margin:0px">
							<tbody>
								<tr>
									<td>
										<a href=" http://maps.google.com/maps?q=&layer=c&cbll=54.863628,-7.410302&cbp=11,0,0,0,0" target="_blank">
											<img src="assets/images/map/Google-Maps.png" style="width:290px;height:150px">
										</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	$track_start_date = $track_start_time = $track_end_time = $track_end_date = '';
	if(isset($_GET['track_start_date'])){ $track_start_date = date('d F, Y',strtotime($_GET['track_start_date'])); }
	if(isset($_GET['track_start_time'])){ $track_start_time = date('h:i A',strtotime($_GET['track_start_time'])); }
	if(isset($_GET['track_end_date'])){ $track_end_date = date('d F, Y',strtotime($_GET['track_end_date'])); }
	if(isset($_GET['track_end_time'])){ $track_end_time = date('h:i A',strtotime($_GET['track_end_time'])); }
?>
<div id="custom_timeframe_modal" class="modal fade">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-warning custom_modal_header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title text-center">TimeFrame Selction</h6>
            </div>
            <div class="modal-body panel-body" id="custom_timeframe_body">
            	<form method="get" action="<?php echo site_url('track/vehicle/'.$this->uri->segment(3)); ?>">
            		<div class="row">
	            		<div class="col-md-6">
		            		<div class="form-group">
		            			<label class="text-semibold">Start Date:</label>
		                        <div class="input-group">
									<span class="input-group-addon"><i class="icon-calendar22"></i></span>
									<input type="text" class="form-control pickadate-accessibility" placeholder="Select a date&hellip;" id="txt_track_start_date" name="track_start_date" value="<?php if($track_start_date!=''){ echo $track_start_date; }else{ echo date('d F, Y'); } ?>">
								</div>
		                    </div>
		                </div>
		                <div class="col-md-6">
		                    <div class="form-group">
		            			<label class="text-semibold">Start Time:</label>
		                        <div class="input-group">
									<span class="input-group-addon"><i class="icon-alarm"></i></span>
									<input type="text" class="form-control pickatime-hidden" placeholder="Try me&hellip;" name="track_start_time" id="txt_track_start_time" value="<?php if($track_start_time!=''){ echo $track_start_time; } else { echo '12:00 AM'; } ?>">
								</div>
		                    </div>
		                </div>
		                <div class="col-md-6">
		            		<div class="form-group">
		            			<label class="text-semibold">End Date:</label>
		                        <div class="input-group">
									<span class="input-group-addon"><i class="icon-calendar22"></i></span>
									<input type="text" class="form-control pickadate-accessibility" placeholder="Select a date&hellip;" id="txt_track_end_date" name="track_end_date" value="<?php if($track_end_date!=''){ echo $track_end_date; }else{ echo date('d F, Y'); } ?>">
								</div>
		                    </div>
		                </div>
		                <div class="col-md-6">
		                    <div class="form-group">
		            			<label class="text-semibold">End Time:</label>
		                        <div class="input-group">
									<span class="input-group-addon"><i class="icon-alarm"></i></span>
									<input type="text" class="form-control pickatime-hidden" placeholder="Try me&hellip;" name="track_end_time" id="txt_track_end_time" value="<?php if($track_end_time!=''){ echo $track_end_time; } else { echo '11:30 PM'; } ?>">
								</div>
		                    </div>
		                </div>
            		<button type="submit" class="btn btn-warning btn-block">Search</button>
            	</form>
            </div>
        </div>
    </div>
</div>

<script>
	$('#_a_timeframe').click(function(){
		$('#custom_timeframe_modal').modal('show');
	});
	$('.pickatime-hidden').pickatime({
        formatSubmit: 'HH:i',
        hiddenName: true
    });
</script>
<style>
	.gm-style-iw {
    width: 350px !important;
    top: 15px !important;
    left: 0px !important;
    background-color: #fff;
    box-shadow: 0 1px 6px rgba(178, 178, 178, 0.6);
    border: 1px solid rgba(72, 181, 233, 0.6);
    border-radius: 2px 2px 10px 10px;
}
#iw-container .iw-title {
    font-family: 'Open Sans Condensed', sans-serif;
    font-size: 15px;
    font-weight: 400;
    padding: 8px;
    background-color: #48b5e9;
    color: white;
    margin: 0;
    border-radius: 2px 2px 0 0;
}
#iw-container .iw-content {
    font-size: 13px;
    line-height: 18px;
    font-weight: 400;
    margin-right: 1px;
    padding: 5px 5px 5px 10px;
    max-height: 140px;
    overflow-y: auto;
    overflow-x: hidden;
}
.iw-content img {
    float: right;
    margin: 0 5px 5px 10px; 
}
.iw-subTitle {
    font-size: 16px;
    font-weight: 700;
    padding: 5px 0;
}
.iw-bottom-gradient {
    position: absolute;
    width: 326px;
    height: 25px;
    bottom: 10px;
    right: 18px;
    background: linear-gradient(to bottom, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
    background: -webkit-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
    background: -moz-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
    background: -ms-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
}
</style>