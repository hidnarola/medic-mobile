<?php if(get_AdminLogin('A')){ ?>
	<div class="content-wrapper"></div>
<?php }else{ ?>
	<?php 
		if($this->input->get('txt_report_type')=='overview')
			$report_type = 'overview';
		else if($this->input->get('txt_report_type')=='dailycheck')
			$report_type = 'dailycheck';
		else if($this->input->get('txt_report_type')=='dailyalerts')
			$report_type = 'dailyalerts';
		else if($this->input->get('txt_report_type')=='faults')
			$report_type = 'faults';
		else if($this->input->get('txt_report_type')=='service_due')
			$report_type = 'service_due';
		else if($this->input->get('txt_report_type')=='proof_of_delivery')
			$report_type = 'proof_of_delivery';
		else if($this->input->get('txt_report_type')=='incidents')
			$report_type = 'incidents';
		else if($this->input->get('txt_report_type')=='operators')
			$report_type = 'operators';
		else
			$report_type = 'overview';

		if($this->input->get('txt_date')){ $uri_date = $this->input->get('txt_date'); }else{ $uri_date = ''; }
	?>
	<div class="content-wrapper">
		<div class="row">
			<div class="col-sm-6 col-md-2">
				<a href="<?php echo site_url('dashboard?txt_date='.$uri_date.'&txt_report_type=dailycheck'); ?>" title="Daily Check">
					<div class="panel panel-body panel-body-accent dashboard_tile <?php if($report_type=='dailycheck'){ echo 'active'; } ?>" style="padding:10px;border:2px solid #ff5722">
						<div class="media no-margin">
							<div class="media-body text-center">
								<h4 class="no-margin text-semibold">Daily Checks</h4>
								<span class="text-uppercase text-size-mini text-muted">
									<span class="icon-checkmark" style="color:green;font-size: medium;top:-3px"></span> 
									<span class="text-uppercase text-size-mini text-muted" style="font-size:medium"><?php echo $stat['daily_check_checked_cnt']; ?> &nbsp;</span>
									<span class="icon-cross" style="color:red;font-size: medium;top:-3px"></span> 
									<span class="text-uppercase text-size-mini text-muted" style="font-size:medium"><?php echo $stat['daily_check_unchecked_cnt']; ?></span>
								</span>
							</div>
						</div>
					</div>
				</a>
			</div>

			<div class="col-sm-6 col-md-2">
				<div class="panel panel-body panel-body-accent dashboard_tile <?php if($report_type=='dailyalerts'){ echo 'active'; } ?>" style="padding:10px;border:2px solid #ff5722">
					<div class="media no-margin">
						<div class="media-body text-center">
							<h4 class="no-margin text-semibold">Daily Alerts</h4>
							<span class="text-uppercase text-size-mini text-muted">
								<span class="text-uppercase text-size-mini text-muted" style="font-size: medium">0</span>
							</span>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-md-2">
				<a href="<?php echo site_url('dashboard?txt_date='.$uri_date.'&txt_report_type=faults'); ?>" title="Faults">
					<div class="panel panel-body panel-body-accent dashboard_tile <?php if($report_type=='faults'){ echo 'active'; } ?>" style="padding:10px;border:2px solid #ff5722">
						<div class="media no-margin">
							<div class="media-body text-center">
								<h4 class="no-margin text-semibold">Faults</h4>
								<span class="text-uppercase text-size-mini text-muted">
									<span class="text-uppercase text-size-mini text-muted" style="font-size: medium"><?php echo $stat['daily_check_fault_cnt']; ?></span>
								</span>
							</div>
						</div>
					</div>
				</a>
			</div>

			<div class="col-sm-6 col-md-2">
				<a href="<?php echo site_url('dashboard?txt_date='.$uri_date.'&txt_report_type=service_due'); ?>" title="Service Due">
					<div class="panel panel-body panel-body-accent dashboard_tile <?php if($report_type=='service_due'){ echo 'active'; } ?>" style="padding:10px;border:2px solid #ff5722">
						<div class="media no-margin">
							<div class="media-body text-center">
								<h4 class="no-margin text-semibold">Service Due</h4>
								<span class="text-uppercase text-size-mini text-muted">
									<span class="text-uppercase text-size-mini text-muted" style="font-size: medium"><?php echo $stat['service_due_cnt']; ?></span>
								</span>
							</div>
						</div>
					</div>
				</a>
			</div>

			<div class="col-sm-6 col-md-2">
				<a href="<?php echo site_url('dashboard?txt_date='.$uri_date.'&txt_report_type=proof_of_delivery'); ?>" title="Proof of Delivery">
					<div class="panel panel-body panel-body-accent dashboard_tile <?php if($report_type=='proof_of_delivery'){ echo 'active'; } ?>" style="padding:10px;border:2px solid #ff5722">
						<div class="media no-margin">
							<div class="media-body text-center">
								<h4 class="no-margin text-semibold">P.O.D</h4>
								<span class="text-uppercase text-size-mini text-muted">
									<span class="text-uppercase text-size-mini text-muted" style="font-size: medium"><?php echo $stat['pod_cnt']; ?></span>
								</span>
							</div>
						</div>
					</div>
				</a>
			</div>

			<div class="col-sm-6 col-md-2">
				<a href="<?php echo site_url('dashboard?txt_date='.$uri_date.'&txt_report_type=incidents'); ?>" title="Incidents">
					<div class="panel panel-body panel-body-accent dashboard_tile <?php if($report_type=='incidents'){ echo 'active'; } ?>" style="padding:10px;border:2px solid #ff5722">
						<div class="media no-margin">
							<div class="media-body text-center">
								<h4 class="no-margin text-semibold">Incidents</h4>
								<span class="text-uppercase text-size-mini text-muted">
									<span class="text-uppercase text-size-mini text-muted" style="font-size: medium"><?php echo $stat['daily_check_incident_cnt']; ?></span>
								</span>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
		<?php if((isset($dataArr) && $dataArr['report_data']=='overview') || !isset($dataArr)){ ?>
			<script type="text/javascript">
				const MONTH_NAMES = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
		  		var vehicle_data = <?php echo json_encode($vehicle_latlong); ?>;
		  		
		  		var vehicle_latlong = [],
		  			markers 		= [],
		      		map,
		      		random_color	= '';

		  		$(vehicle_data).each(function(key,value){
		  			vehicle_latlong.push({
		  				lat:parseFloat(value['latitude'].replace('"','')), 
		  				lng:parseFloat(value['longitude'].replace('"',''))
		  			});
		  		});

		      	function initMap() {
		      		$('#map').show();
		      		var mapOptions = {
		      			zoom: 16,
			            center: new google.maps.LatLng(vehicle_latlong[0]),
			            mapTypeId: 'satellite'
			     //        styles: [
								//   {
								//     "elementType": "geometry",
								//     "stylers": [
								//       {
								//         "color": "#f5f5f5"
								//       }
								//     ]
								//   },
								//   {
								//     "elementType": "labels.icon",
								//     "stylers": [
								//       {
								//         "visibility": "off"
								//       }
								//     ]
								//   },
								//   {
								//     "elementType": "labels.text.fill",
								//     "stylers": [
								//       {
								//         "color": "#616161"
								//       }
								//     ]
								//   },
								//   {
								//     "elementType": "labels.text.stroke",
								//     "stylers": [
								//       {
								//         "color": "#f5f5f5"
								//       }
								//     ]
								//   },
								//   {
								//     "featureType": "administrative.land_parcel",
								//     "elementType": "labels.text.fill",
								//     "stylers": [
								//       {
								//         "color": "#bdbdbd"
								//       }
								//     ]
								//   },
								//   {
								//     "featureType": "poi",
								//     "elementType": "geometry",
								//     "stylers": [
								//       {
								//         "color": "#eeeeee"
								//       }
								//     ]
								//   },
								//   {
								//     "featureType": "poi",
								//     "elementType": "labels.text.fill",
								//     "stylers": [
								//       {
								//         "color": "#757575"
								//       }
								//     ]
								//   },
								//   {
								//     "featureType": "poi.park",
								//     "elementType": "geometry",
								//     "stylers": [
								//       {
								//         "color": "#e5e5e5"
								//       }
								//     ]
								//   },
								//   {
								//     "featureType": "poi.park",
								//     "elementType": "labels.text.fill",
								//     "stylers": [
								//       {
								//         "color": "#9e9e9e"
								//       }
								//     ]
								//   },
								//   {
								//     "featureType": "road",
								//     "elementType": "geometry",
								//     "stylers": [
								//       {
								//         "color": "#ffffff"
								//       }
								//     ]
								//   },
								//   {
								//     "featureType": "road.arterial",
								//     "elementType": "labels.text.fill",
								//     "stylers": [
								//       {
								//         "color": "#757575"
								//       }
								//     ]
								//   },
								//   {
								//     "featureType": "road.highway",
								//     "elementType": "geometry",
								//     "stylers": [
								//       {
								//         "color": "#dadada"
								//       }
								//     ]
								//   },
								//   {
								//     "featureType": "road.highway",
								//     "elementType": "labels.text.fill",
								//     "stylers": [
								//       {
								//         "color": "#616161"
								//       }
								//     ]
								//   },
								//   {
								//     "featureType": "road.local",
								//     "elementType": "labels.text.fill",
								//     "stylers": [
								//       {
								//         "color": "#9e9e9e"
								//       }
								//     ]
								//   },
								//   {
								//     "featureType": "transit.line",
								//     "elementType": "geometry",
								//     "stylers": [
								//       {
								//         "color": "#e5e5e5"
								//       }
								//     ]
								//   },
								//   {
								//     "featureType": "transit.station",
								//     "elementType": "geometry",
								//     "stylers": [
								//       {
								//         "color": "#eeeeee"
								//       }
								//     ]
								//   },
								//   {
								//     "featureType": "water",
								//     "elementType": "geometry",
								//     "stylers": [
								//       {
								//         "color": "#c9c9c9"
								//       }
								//     ]
								//   },
								//   {
								//     "featureType": "water",
								//     "elementType": "labels.text.fill",
								//     "stylers": [
								//       {
								//         "color": "#9e9e9e"
								//       }
								//     ]
								//   }
								// ]
			        };
			        map = new google.maps.Map(document.getElementById("map"), mapOptions);
			        var latlngbounds = new google.maps.LatLngBounds();
			        var infoWindow = new google.maps.InfoWindow();
			        $(vehicle_latlong).each(function(key,value){
			            var myLatlng = new google.maps.LatLng(parseFloat(value['lat']),parseFloat(value['lng']));
			            random_color = randomColor();
			            var pinImage = new google.maps.MarkerImage("http://www.googlemapsmarkers.com/v1/"+random_color+'/');
			            var marker = new google.maps.Marker({
			                position: myLatlng,
			                map: map,
			                icon: pinImage,
			                //url: site_url + 'track/vehicle/' + vehicle_data[key]['deviceGUID'],
			            	label: {
							    color: 'black',
							    fontWeight: 'bold',
							    text: vehicle_data[key]['deviceGUID'],
							},
			            });
			            //var markerCluster = new MarkerClusterer(map, marker,{imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
			            var d = new Date();
			            var date = d.getDate()+' '+MONTH_NAMES[d.getMonth()]+', '+d.getFullYear();
			            var time = d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
			            var last_hour = "?track_start_date="+date+"&track_start_time="+(d.getHours()-1) + ":" + d.getMinutes() + ":" + d.getSeconds()+"&track_end_date="+date+"&track_end_time="+time;
			            var last_two_hour = "?track_start_date="+date+"&track_start_time="+(d.getHours()-2) + ":" + d.getMinutes() + ":" + d.getSeconds()+"&track_end_date="+date+"&track_end_time="+time;
			            var last_three_hour = "?track_start_date="+date+"&track_start_time="+(d.getHours()-3) + ":" + d.getMinutes() + ":" + d.getSeconds()+"&track_end_date="+date+"&track_end_time="+time;
			            var today = "?track_start_date="+date+"&track_start_time=00:00:01"+"&track_end_date="+date+"&track_end_time=23:30:00";
			            var yesterday = "?track_start_date="+(d.getDate()-1)+" "+MONTH_NAMES[d.getMonth()]+", "+d.getFullYear()+"&track_start_time=00:00:01"+"&track_end_date="+(d.getDate()-1)+"&track_end_time=23:30:00";
			            var content ='<div>'+
			            				'<label><b>Track</b> : '+vehicle_data[key]['deviceGUID']+'</label>'+
				            			'<ul style="padding-left:16px;margin-bottom:0px">'+
				            				'<li style="padding:3px"><b><a href="'+site_url+"track/vehicle/"+vehicle_data[key]['deviceGUID']+"/"+last_hour+'" style="color:#000">Last Hour</a></b></li>'+
				            				'<li style="padding:3px"><b><a href="'+site_url+"track/vehicle/"+vehicle_data[key]['deviceGUID']+"/"+last_two_hour+'" style="color:#000">Last 2 Hours</a></b></li>'+
				            				'<li style="padding:3px"><b><a href="'+site_url+"track/vehicle/"+vehicle_data[key]['deviceGUID']+"/"+last_three_hour+'" style="color:#000">Last 3 Hours</a></b></li>'+
				            				'<li style="padding:3px"><b><a href="'+site_url+"track/vehicle/"+vehicle_data[key]['deviceGUID']+"/"+today+'" style="color:#000">Today</a></b></li>'+
				            				'<li style="padding:3px"><b><a href="'+site_url+"track/vehicle/"+vehicle_data[key]['deviceGUID']+"/"+yesterday+'" style="color:#000">Yesterday</a></b></li>'+
				            				'<li style="padding:3px"><b><a href="javascript:void(0)" onClick="open_custom_timeframe_modal(\''+vehicle_data[key]['deviceGUID']+'\')" style="color:#000">Custom</a></b></li>'+
				            			'</ul>'+
				            		 '</div>';
			            google.maps.event.addListener(marker,'click', function(){
							infoWindow.close();
							infoWindow.setContent(content);
							infoWindow.open(map, this);
						});
			            markers.push(marker);
			            //google.maps.event.addListener(marker, 'click', function() { window.location.href = this.url; });
			            latlngbounds.extend(marker.position);
			            $('.'+vehicle_data[key]['deviceGUID']+'_star').css('color','#'+random_color);
			        });
			 		
			 		
			        var bounds = new google.maps.LatLngBounds();
			        map.setCenter(latlngbounds.getCenter());
			        map.fitBounds(latlngbounds);
			        var markerCluster = new MarkerClusterer(map, markers,{imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
		      	}

		      	/******************************************
						Marker Random Color
				*******************************************/
				var safeColors = ['00','33','66','99','cc','ff'];
				function rand() {
				    return Math.floor(Math.random()*6);
				};
				function randomColor() {
				    var r = safeColors[rand()];
				    var g = safeColors[rand()];
				    var b = safeColors[rand()];
				    var color = '#'+r+g+b;
				    return (color.split('#'))[1];
				};				
			</script>
			<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
			<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAE19qNQTlcPGeOthK32NgAUo1xoiks_-Y&callback=initMap"></script>			
			<div class="row">
				<div class="col-lg-1" style="width:13%">
					<div class="text-center"><label style="font-size:14px;"><b>Most recently used :</b></label></div>
					<ul style="list-style-type:none;padding:0px">
						<?php foreach($vehicle_latlong as $k => $v){ ?>
							<li>
								<label style="font-size:13px;"><b><a href="<?php echo site_url('track/vehicle/'.$v['deviceGUID']); ?>" style="color:black"><?= $v['deviceGUID']; ?></a></b></label>
								<label style="font-size:13px;float:right"><b><i class="icon-star-full2 <?php echo $v['deviceGUID'].'_star'; ?>" style="font-size:13px;"></i>&nbsp;&nbsp;&nbsp;Current</b></label>
							</li>
						<?php } ?>

					</ul>
				</div>
				<div class="col-lg-11" style="width:87%">
					<div class="panel panel-flat">
						<div class="panel-heading" style="padding:0px">
							<div id="map" style="height:620px;display: none;"></div>
						</div>
					</div>
				</div>
			</div>
		<?php } else if((isset($dataArr) && $dataArr['report_data']=='dailycheck')){ ?>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-flat" style="padding:0px">
						<div class="table-responsive">
							<table class="table text-nowrap table-bordered tbl_dailycheck table-xxs">
								<thead>
									<tr class="cbg-black-100 border-solid">
										<th style="padding-top:10px; padding-bottom:10px">Driver</th>
										<th>Vehicle RegNo.</th>
										<th>Vehicle Type</th>
										<th>Mileage</th>
										<th>Total Fault</th>
										<th>Added On</th>
										<th class="text-center">Action</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
						<div class="panel-body">
							<button type="button" class="btn btn-warning btn-md" onClick="print_report('dailycheck')"><i class="icon-printer position-left"></i> Print Report</button>
							<ul class="pagination-separated pagination-md twbs-default pull-right dailycheck_pagination"></ul>
						</div>
					</div>
				</div>
			</div>
			<div id="dailycheck_view_modal" class="modal fade">
			    <div class="modal-dialog modal-full">
			        <div class="modal-content">
			            <div class="modal-header cbg-black-300 custom_modal_header">
			                <button type="button" class="close" data-dismiss="modal">&times;</button>
			                <h6 class="modal-title text-center" style="font-size: 18px;letter-spacing: 2px;font-family: Verdana;">DailyCheck Details</h6>
			            </div>
			            <div class="modal-body panel-body" id="dailycheck_view_body" style="box-shadow: 5px 10px 30px -4px rgba(8, 8, 8, 0.8)"></div>         
			        </div>
			    </div>
			</div>
			<script>
				$(function(){
					var total_pagination_links = '<?php echo $total_pagination_links; ?>';
					if(total_pagination_links!=0){
						$('.dailycheck_pagination').twbsPagination({
						    totalPages: '<?php echo $total_pagination_links; ?>',
						    visiblePages: 7,
						    prev: 'Prev',
						    first: null,
						    last: null,
						    onPageClick: function (event, page) {
						    	$.ajax({
							        type: "POST",
							        url: site_url + "Dashboard/get_dailycheck_pagination",
							        data: { page_no: page, txt_date: $('#txt_date').val() },
							        async: false,
							        dataType: 'json',
									success: function(data){
										$('.tbl_dailycheck tbody').html(data);
										$('html,body').animate({scrollTop: $('.navbar').offset().top});
									}
								});
						    }
						});
					}else{
						$.ajax({
					        type: "POST",
					        url: site_url + "Dashboard/get_dailycheck_pagination",
					        data: { page_no: 1, txt_date: $('#txt_date').val() },
					        async: false,
					        dataType: 'json',
							success: function(data){
								$('.tbl_dailycheck tbody').html(data);
								$('html,body').animate({scrollTop: $('.navbar').offset().top});
							}
						});
					}
				});
				$(document).on('click','.btn_view_dailycheck',function(){
					var dailyCheckID = $(this).data('id');
					$.ajax({
				        url: site_url + "Dashboard/view_dailycheck",
				        data: { dailyCheckID: dailyCheckID },
				        dataType: 'json',
				        type: "POST",
						success: function(data){
							$('#dailycheck_view_body').html(data);
							$('#dailycheck_view_modal').modal('show');
						}
					});
				});
			</script>	
		<?php } else if((isset($dataArr) && $dataArr['report_data']=='faults')){ ?>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-flat" style="padding:0px">
						<div class="table-responsive">
							<table class="table text-nowrap table-bordered tbl_faults table-xxs">
								<thead>
									<tr class="cbg-black-100 border-solid">
										<th style="padding-top:10px; padding-bottom:10px">Registration</th>
										<th>Operator Name</th>
										<th>Vehicle Details</th>
										<th>Total Faults</th>
										<th class="text-center">Action</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
						<div class="panel-body">
							<!-- <button type="button" class="btn btn-warning btn-md" onClick="print_report('dailycheck')"><i class="icon-printer position-left"></i> Print Report</button> -->
							<ul class="pagination-separated pagination-md twbs-default pull-right faults_pagination"></ul>
						</div>
					</div>
				</div>
			</div>
			<div id="faults_view_modal" class="modal fade">
			    <div class="modal-dialog modal-full">
			        <div class="modal-content">
			            <div class="modal-header bg-warning custom_modal_header">
			                <button type="button" class="close" data-dismiss="modal">&times;</button>
			                <h6 class="modal-title text-center" style="font-size: 18px;letter-spacing: 2px;font-family: Verdana;">Fault's Details</h6>
			            </div>
			            <div class="modal-body panel-body custom_scrollbar" id="faults_view_body" style="box-shadow: 5px 10px 30px -4px rgba(8, 8, 8, 0.8);height: 600px;overflow-y: auto;"></div>         
			        </div>
			    </div>
			</div>
			<script>
				$(function(){
					var total_pagination_links = '<?php echo $total_pagination_links; ?>';
					if(total_pagination_links!=0){
						$('.faults_pagination').twbsPagination({
						    totalPages: '<?php echo $total_pagination_links; ?>',
						    visiblePages: 7,
						    prev: 'Prev',
						    first: null,
						    last: null,
						    onPageClick: function (event, page) {
						    	$.ajax({
							        type: "POST",
							        url: site_url + "Dashboard/get_faults_pagination",
							        data: { page_no: page, txt_date: $('#txt_date').val() },
							        async: false,
							        dataType: 'json',
									success: function(data){
										$('.tbl_faults tbody').html(data);
										$('html,body').animate({scrollTop: $('.navbar').offset().top});
									}
								});
						    }
						});
					}else{
						$.ajax({
					        type: "POST",
					        url: site_url + "Dashboard/get_faults_pagination",
					        data: { page_no: 1, txt_date: $('#txt_date').val() },
					        async: false,
					        dataType: 'json',
							success: function(data){
								$('.tbl_faults tbody').html(data);
								$('html,body').animate({scrollTop: $('.navbar').offset().top});
							}
						});
					}
				});
				$(document).on('click','.btn_view_faults',function(){
					var vehicleGUID = $(this).data('id');
					$.ajax({
				        url: site_url + "Dashboard/view_faults",
				        data: { vehicleGUID: vehicleGUID },
				        dataType: 'json',
				        type: "POST",
						success: function(data){
							$('#faults_view_body').html(data);
							$('#faults_view_modal').modal('show');
						}
					});
				});
			</script>	
		<?php } else if((isset($dataArr) && $dataArr['report_data']=='service_due')){ ?>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-flat" style="padding:0px">
						<div class="table-responsive">
							<table class="table text-nowrap table-bordered tbl_service_due table-xxs">
								<thead>
									<tr class="cbg-black-100 border-solid">
										<th style="padding-top:10px; padding-bottom:10px">Registration</th>
										<th>Current ODO</th>
										<th>Vehicle Description</th>
										<th>Last Inspection Date</th>
										<th>Last Inspection ODO</th>
										<th>Next Inspection Due</th>
										<th>Confirmed?</th>
										<th>Status</th>
										<th class="text-center">Action</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
						<div class="panel-body">
							<button type="button" class="btn btn-warning btn-md" onClick="print_report('service_due')"><i class="icon-printer position-left"></i> Print Report</button>
							<ul class="pagination-separated pagination-md twbs-default pull-right service_due_pagination"></ul>
						</div>
					</div>
				</div>
			</div>
			<script>
				$(function(){
					var total_pagination_links = '<?php echo $total_pagination_links; ?>';
					if(total_pagination_links!=0){
						$('.service_due_pagination').twbsPagination({
						    totalPages: '<?php echo $total_pagination_links; ?>',
						    visiblePages: 7,
						    prev: 'Prev',
						    first: null,
						    last: null,
						    onPageClick: function (event, page) {
						    	$.ajax({
							        type: "POST",
							        url: site_url + "Dashboard/get_service_due_pagination",
							        data: { page_no: page, txt_date: $('#txt_date').val() },
							        async: false,
							        dataType: 'json',
									success: function(data){
										$('.tbl_service_due tbody').html(data);
										$('html,body').animate({scrollTop: $('.navbar').offset().top});
									}
								});
						    }
						});
					}else{
						$.ajax({
					        type: "POST",
					        url: site_url + "Dashboard/get_service_due_pagination",
					        data: { page_no: 1, txt_date: $('#txt_date').val() },
					        async: false,
					        dataType: 'json',
							success: function(data){
								$('.tbl_service_due tbody').html(data);
								$('html,body').animate({scrollTop: $('.navbar').offset().top});
							}
						});
					}
				});
			</script>
		<?php } else if((isset($dataArr) && $dataArr['report_data']=='proof_of_delivery')){ ?>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-flat" style="padding:0px">
						<div class="table-responsive">
							<table class="table text-nowrap table-bordered tbl_pod table-xxs">
								<thead>
									<tr class="cbg-black-100 border-solid">
										<th style="padding-top:10px; padding-bottom:10px">Registration</th>
										<th>Operator Name</th>
										<th>Depot Name</th>
										<th>Total Drops</th>
										<th class="text-center">Action</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
						<div class="panel-body">
							<ul class="pagination-separated pagination-md twbs-default pull-right pod_pagination"></ul>
						</div>
					</div>
				</div>
			</div>
			<div id="pod_view_modal" class="modal fade" aria-hidden="true">
			    <div class="modal-dialog modal-lg">
			        <div class="modal-content">
			            <div class="modal-header bg-warning custom_modal_header">
			                <button type="button" class="close" data-dismiss="modal">&times;</button>
			                <h6 class="modal-title text-center" style="font-size: 18px;letter-spacing: 2px;font-family: Verdana;">POD's Details</h6>
			            </div>
			            <div class="modal-body panel-body" id="pod_view_body" style="box-shadow: 5px 10px 30px -4px rgba(8, 8, 8, 0.8);"></div>
			        </div>
			    </div>
			</div>
			<div class="modal fade" id="pod_img_view_modal" data-backdrop="static" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
					    <div class="modal-header bg-warning custom_modal_header">
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					        <h6 class="modal-title text-center" style="font-size: 18px;letter-spacing: 2px;font-family: Verdana;">POD's Images</h6>
				    	</div>
					    <div class="modal-body panel-body" id="pod_img_view_body" style="box-shadow: 5px 10px 30px -4px rgba(8, 8, 8, 0.8);"></div>
					</div>
				</div>
			</div>
			<script>
				$(function(){
					var total_pagination_links = '<?php echo $total_pagination_links; ?>';
					if(total_pagination_links!=0){
						$('.pod_pagination').twbsPagination({
						    totalPages: '<?php echo $total_pagination_links; ?>',
						    visiblePages: 7,
						    prev: 'Prev',
						    first: null,
						    last: null,
						    onPageClick: function (event, page) {
						    	$.ajax({
							        type: "POST",
							        url: site_url + "Dashboard/get_pod_pagination",
							        data: { page_no: page, txt_date: $('#txt_date').val() },
							        async: false,
							        dataType: 'json',
									success: function(data){
										$('.tbl_pod tbody').html(data);
										$('html,body').animate({scrollTop: $('.navbar').offset().top});
									}
								});
						    }
						});
					}else{
						$.ajax({
					        type: "POST",
					        url: site_url + "Dashboard/get_pod_pagination",
					        data: { page_no: 1, txt_date: $('#txt_date').val() },
					        async: false,
					        dataType: 'json',
							success: function(data){
								$('.tbl_pod tbody').html(data);
								$('html,body').animate({scrollTop: $('.navbar').offset().top});
							}
						});
					}
				});
				$(document).on('click','.btn_view_pod',function(){
					//$('#pod_view_modal').modal('show');
					var vehicleGUID = $(this).data('id');
					$.ajax({
				        url: site_url + "Dashboard/view_pod",
				        data: { vehicleGUID: vehicleGUID },
				        dataType: 'json',
				        type: "POST",
						success: function(data){
							$('#pod_view_body').html(data);
							$('#pod_view_modal').modal('show');
						}
					});
				});

				$(document).on('click','.btn_view_img',function(){
					var proofID = $(this).data('id');
					$.ajax({
				        url: site_url + "Dashboard/view_pod_images",
				        data: { proofID: proofID },
				        dataType: 'json',
				        type: "POST",
						success: function(data){
							$('#pod_img_view_body').html(data);
							$('#pod_img_view_modal').modal('show');
						}
					});
				});
			</script>	
		<?php } else if((isset($dataArr) && $dataArr['report_data']=='incidents')){ ?>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-flat" style="padding:0px">
						<div class="table-responsive">
							<table class="table text-nowrap table-bordered tbl_incidents table-xxs">
								<thead>
									<tr class="cbg-black-100 border-solid">
										<th style="padding-top:10px; padding-bottom:10px">Registration</th>
										<th>Operator Name</th>
										<th>Vehicle Details</th>
										<th>Total Incidents</th>
										<th class="text-center">Action</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
						<div class="panel-body">
							<!-- <button type="button" class="btn btn-warning btn-md" onClick="print_report('dailycheck')"><i class="icon-printer position-left"></i> Print Report</button> -->
							<ul class="pagination-separated pagination-md twbs-default pull-right incidents_pagination"></ul>
						</div>
					</div>
				</div>
			</div>
			<div id="incidents_view_modal" class="modal fade">
			    <div class="modal-dialog modal-full">
			        <div class="modal-content">
			            <div class="modal-header bg-warning custom_modal_header">
			                <button type="button" class="close" data-dismiss="modal">&times;</button>
			                <h6 class="modal-title text-center" style="font-size: 18px;letter-spacing: 2px;font-family: Verdana;">Incident's Details</h6>
			            </div>
			            <div class="modal-body panel-body custom_scrollbar" id="incidents_view_body" style="box-shadow: 5px 10px 30px -4px rgba(8, 8, 8, 0.8);height: 600px;overflow-y: auto;"></div>         
			        </div>
			    </div>
			</div>
			<script>
				$(function(){
					var total_pagination_links = '<?php echo $total_pagination_links; ?>';
					if(total_pagination_links!=0){
						$('.incidents_pagination').twbsPagination({
						    totalPages: '<?php echo $total_pagination_links; ?>',
						    visiblePages: 7,
						    prev: 'Prev',
						    first: null,
						    last: null,
						    onPageClick: function (event, page) {
						    	$.ajax({
							        type: "POST",
							        url: site_url + "Dashboard/get_incidents_pagination",
							        data: { page_no: page, txt_date: $('#txt_date').val() },
							        async: false,
							        dataType: 'json',
									success: function(data){
										$('.tbl_incidents tbody').html(data);
										$('html,body').animate({scrollTop: $('.navbar').offset().top});
									}
								});
						    }
						});
					}else{
						$.ajax({
					        type: "POST",
					        url: site_url + "Dashboard/get_incidents_pagination",
					        data: { page_no: 1, txt_date: $('#txt_date').val() },
					        async: false,
					        dataType: 'json',
							success: function(data){
								$('.tbl_incidents tbody').html(data);
								$('html,body').animate({scrollTop: $('.navbar').offset().top});
							}
						});
					}
				});
				$(document).on('click','.btn_view_incidents',function(){
					var vehicleGUID = $(this).data('id');
					$.ajax({
				        url: site_url + "Dashboard/view_incidents",
				        data: { vehicleGUID: vehicleGUID },
				        dataType: 'json',
				        type: "POST",
						success: function(data){
							$('#incidents_view_body').html(data);
							$('#incidents_view_modal').modal('show');
						}
					});
				});
			</script>	
		<?php } else if((isset($dataArr) && $dataArr['report_data']=='operators')){ ?>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-flat" style="padding:0px">
						<div class="table-responsive">
							<table class="table text-nowrap table-bordered tbl_operators">
								<thead>
									<tr class="cbg-black-100 border-solid">
										<th>Driver</th>
										<th>HGV Licence No</th>
										<th>Expiry Date</th>
										<th>Classes Covered</th>
										<th>Additional Licence 1</th>
										<th>Expiry Date</th>
										<th>Additional Licence 2</th>
										<th>Expiry Date</th>
										<th>Classes Covered</th>
										<th class="text-center">Status</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
						<div class="panel-body">
							<button type="button" class="btn btn-warning btn-md" onClick="print_report('operators')"><i class="icon-printer position-left"></i> Print Report</button>
							<ul class="pagination-separated pagination-md twbs-default pull-right operators_pagination"></ul>
						</div>
					</div>
				</div>
			</div>
			<script>
				$('.operators_pagination').twbsPagination({
				    totalPages: '<?php echo $total_pagination_links; ?>',
				    visiblePages: 7,
				    prev: 'Prev',
				    first: null,
				    last: null,
				    onPageClick: function (event, page) {
				    	$.ajax({
					        type: "POST",
					        url: site_url + "Dashboard/get_operators_pagination",
					        data: { page_no: page },
					        async: false,
					        dataType: 'json',
							success: function(data){
								$('.tbl_operators tbody').html(data);
							}
						});
				    }
				});
			</script>
		<?php } ?>
	</div>
<?php } ?>

<div id="custom_timeframe_modal" class="modal fade">
    <div class="modal-dialog modal-md" style="margin:12% auto">
        <div class="modal-content">
            <div class="modal-header bg-warning custom_modal_header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title text-center">TimeFrame Selction</h6>
            </div>
            <div class="modal-body panel-body" id="custom_timeframe_body">
            	<div class="row">
            		<div class="col-md-6">
	            		<div class="form-group">
	            			<label class="text-semibold">Start Date:</label>
	                        <div class="input-group">
								<span class="input-group-addon"><i class="icon-calendar22"></i></span>
								<input type="text" class="form-control pickadate-accessibility" placeholder="Select a date&hellip;" id="txt_track_start_date" name="track_start_date" value="<?php echo date('d F, Y'); ?>">
							</div>
	                    </div>
	                </div>
	                <div class="col-md-6">
	                    <div class="form-group">
	            			<label class="text-semibold">Start Time:</label>
	                        <div class="input-group">
								<span class="input-group-addon"><i class="icon-alarm"></i></span>
								<input type="text" class="form-control pickatime-hidden" placeholder="Try me&hellip;" name="track_start_time" id="txt_track_start_time" value="<?php echo '12:00 AM'; ?>">
							</div>
	                    </div>
	                </div>
	                <hr>
	                <div class="col-md-6">
	            		<div class="form-group">
	            			<label class="text-semibold">End Date:</label>
	                        <div class="input-group">
								<span class="input-group-addon"><i class="icon-calendar22"></i></span>
								<input type="text" class="form-control pickadate-accessibility" placeholder="Select a date&hellip;" id="txt_track_end_date" name="track_end_date" value="<?php echo date('d F, Y'); ?>">
							</div>
	                    </div>
	                </div>
	                <div class="col-md-6">    
	                    <div class="form-group">
	            			<label class="text-semibold">End Time:</label>
	                        <div class="input-group">
								<span class="input-group-addon"><i class="icon-alarm"></i></span>
								<input type="text" class="form-control pickatime-hidden" placeholder="Try me&hellip;" name="track_end_time" id="txt_track_end_time" value="<?php echo '11:30 PM'; ?>">
							</div>
	                    </div>
	                </div>
	                <input type="hidden" name="txt_deviceGUID" id="txt_deviceGUID">
            		<button type="button" class="btn btn-warning btn-block btn_custom_tf_serach">Search</button>
            	</div>
            </div>
        </div>
    </div>
</div>

<script>
	function open_custom_timeframe_modal(deviceGUID){
		$('#txt_deviceGUID').val(deviceGUID);
		$('#custom_timeframe_modal').modal('show');
	}

	$(document).on('click','.btn_custom_tf_serach',function(){
	    	var href = '?track_start_date='+$('#txt_track_start_date').val()+'&track_start_time='+$('#txt_track_start_time').val()+'&track_end_date='+$('#txt_track_end_date').val()+'&track_end_time='+$('#txt_track_end_time').val();
	    	window.location.href = site_url+'track/vehicle/'+$('#txt_deviceGUID').val()+'/'+href;
	    });
	$(function(){
		$('.pickatime-hidden').pickatime({
	        formatSubmit: 'HH:i',
	        hiddenName: true
	    });

		$('#tbl_tracking tr td a').on('click',function(){
			$('.indi_div').removeClass('hide');
			livemap($(this).attr('deviceGUID'));
			map2($(this).attr('deviceGUID'));
			$('.td_last_service').html($(this).attr('lastServiceDate'));
			$('.td_next_service').html($(this).attr('nextServiceDue'));
			$('.td_last_inspection').html($(this).attr('lastInspectionDate'));
			$('.td_next_inspection').html($(this).attr('nextInspectionDue'));
		});

		// Pie with legend
	    // ------------------------------

	    // Initialize chart
	    animatedPieWithLegend("#pie_basic_legend", 200);

	    // Chart setup
	    function animatedPieWithLegend(element, size) {

	        // Add data set
	        var data = [
	            {
	                "status": "New",
	                "value": 578,
	                "color": "#29B6F6"
	            }, {
	                "status": "Pending",
	                "value": 983,
	                "color": "#66BB6A"
	            }, {
	                "status": "Shipped",
	                "value": 459,
	                "color": "#EF5350"
	            }
	        ];

	        // Main variables
	        var d3Container = d3.select(element),
	            distance = 2, // reserve 2px space for mouseover arc moving
	            radius = (size/2) - distance,
	            sum = d3.sum(data, function(d) { return d.value; });


	        // Create chart
	        // ------------------------------

	        // Add svg element
	        var container = d3Container.append("svg");
	        
	        // Add SVG group
	        var svg = container
	            .attr("width", size)
	            .attr("height", size)
	            .append("g")
	                .attr("transform", "translate(" + (size / 2) + "," + (size / 2) + ")");  


	        // Construct chart layout
	        // ------------------------------

	        // Pie
	        var pie = d3.layout.pie()
	            .sort(null)
	            .startAngle(Math.PI)
	            .endAngle(3 * Math.PI)
	            .value(function (d) { 
	                return d.value;
	            }); 

	        // Arc
	        var arc = d3.svg.arc()
	            .outerRadius(radius);


	        //
	        // Append chart elements
	        //

	        // Group chart elements
	        var arcGroup = svg.selectAll(".d3-arc")
	            .data(pie(data))
	            .enter()
	            .append("g") 
	                .attr("class", "d3-arc")
	                .style({
	                    'stroke': '#fff',
	                    'stroke-width': 2,
	                    'cursor': 'pointer'
	                });
	        
	        // Append path
	        var arcPath = arcGroup
	            .append("path")
	            .style("fill", function (d) {
	                return d.data.color;
	            });


	        // Add interactions
	        arcPath
	            .on('mouseover', function (d, i) {

	                // Transition on mouseover
	                d3.select(this)
	                .transition()
	                    .duration(500)
	                    .ease('elastic')
	                    .attr('transform', function (d) {
	                        d.midAngle = ((d.endAngle - d.startAngle) / 2) + d.startAngle;
	                        var x = Math.sin(d.midAngle) * distance;
	                        var y = -Math.cos(d.midAngle) * distance;
	                        return 'translate(' + x + ',' + y + ')';
	                    });

	                // Animate legend
	                $(element + ' [data-slice]').css({
	                    'opacity': 0.3,
	                    'transition': 'all ease-in-out 0.15s'
	                });
	                $(element + ' [data-slice=' + i + ']').css({'opacity': 1});
	            })
	            .on('mouseout', function (d, i) {

	                // Mouseout transition
	                d3.select(this)
	                .transition()
	                    .duration(500)
	                    .ease('bounce')
	                    .attr('transform', 'translate(0,0)');

	                // Revert legend animation
	                $(element + ' [data-slice]').css('opacity', 1);
	            });

	        // Animate chart on load
	        arcPath
	            .transition()
	                .delay(function(d, i) { return i * 500; })
	                .duration(500)
	                .attrTween("d", function(d) {
	                    var interpolate = d3.interpolate(d.startAngle,d.endAngle);
	                    return function(t) {
	                        d.endAngle = interpolate(t);
	                        return arc(d);  
	                    }; 
	                });


	        //
	        // Append counter
	        //

	        // Append element
	        d3Container
	            .append('h2')
	            .attr('class', 'mt-15 mb-5 text-semibold');

	        // Animate counter
	        d3Container.select('h2')
	            .transition()
	            .duration(1500)
	            .tween("text", function(d) {
	                var i = d3.interpolate(this.textContent, sum);

	                return function(t) {
	                    this.textContent = d3.format(",d")(Math.round(i(t)));
	                };
	            });


	        //
	        // Append legend
	        //

	        // Add element
	        var legend = d3.select(element)
	            .append('ul')
	            .attr('class', 'chart-widget-legend')
	            .selectAll('li').data(pie(data))
	            .enter().append('li')
	            .attr('data-slice', function(d, i) {
	                return i;
	            })
	            .attr('style', function(d, i) {
	                return 'border-bottom: 2px solid ' + d.data.color;
	            })
	            .text(function(d, i) {
	                return d.data.status + ': ';
	            });

	        // Add value
	        legend.append('span')
	            .text(function(d, i) {
	                return d.data.value;
	            });
	    }
	});
	// $('.twbs-default').twbsPagination({
	//     totalPages: 20,
	//     visiblePages: 7,
	//     prev: 'Prev',
	//     first: null,
	//     last: null,
	//     onPageClick: function (event, page) {
	//         $('.twbs-content-default').text('Page ' + page);
	//     }
	// });
	function print_report(elem){
		if(elem=='dailycheck')
			url = site_url + "Dashboard/get_dailycheck_pagination";
		else if(elem=='service_due')
			url = site_url + "Dashboard/get_service_due_pagination";
		else if(elem=='operators')
			url = site_url + "Dashboard/get_operators_pagination";

		$.ajax({
	        type: "POST",
	        url: url,
	        data: { print: 'yes', txt_date: $('#txt_date').val() },
	        async: false,
	        dataType: 'json',
			success: function(data){
				//$('body').html(data);
				var mywindow = window.open('', 'PRINT', 'height=400,width=600');
			    mywindow.document.write('<h1>' + document.title  + '</h1>');
			    mywindow.document.write(data);
			    mywindow.document.close();
			    mywindow.focus();
			    mywindow.print();
			    mywindow.close();
			}
		});
   }
</script>

<style>
/*.gm-style-iw {
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
}*/

.picker__select--year{ width:26% !important; }
</style>