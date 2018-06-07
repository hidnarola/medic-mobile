<script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=geometry,places&v=3.27&key=AIzaSyCcvuBSTZ5P8My0Am1uy0RgRQ7gu5SyuAw"></script>
<?php 
	if(isset($dataArr)){
		$form_action = 'manage_company/edit/'.base64_encode($dataArr['companyGUID']);
	}else{
		$form_action = 'manage_company/add';
	}
?>
<div class="content-wrapper">
	<div class="row">
        <div class="col-md-12">
            <form method="post" action="<?php echo site_url($form_action); ?>" id="add_compnay_form" enctype="multipart/form-data">
                <div class="panel panel-body login-form">
                	<fieldset>
						<legend class="text-semibold"><i class="icon-truck position-left"></i> Location details</legend>
	                    <div class="form-group has-feedback">
	                        <label class="control-label required">Company Name</label>
	                        <input type="text" class="form-control" name="name" id="name" placeholder="Company Name" value="<?php echo (isset($dataArr)) ? $dataArr['companyName'] : set_value('name'); ?>">
	                        <?php echo '<label id="name_error2" class="validation-error-label" for="name">' . form_error('name') . '</label>'; ?>
	                    </div>
	                    <div class="form-group has-feedback">
	                        <label class="control-label required">Address</label>
	                        <input type="text" class="form-control" name="address" id="address" placeholder="Company Address" value="<?php echo (isset($dataArr)) ? $dataArr['addressLine1'] : set_value('address'); ?>">
	                        <?php echo '<label id="address_error2" class="validation-error-label" for="address">' . form_error('address') . '</label>'; ?>
	                        <div id="map_canvas" style="min-height:300px"></div>
	                    </div>
		                <input type="hidden" name="latitude" id="latitude" value="<?php echo (isset($dataArr)) ? $dataArr['latitude'] : '39.2904'; ?>">
		                <input type="hidden" name="longitude" id="longitude" value="<?php echo (isset($dataArr)) ? $dataArr['longitude'] : '-76.6122'; ?>">
		                <input type="hidden" name="city" id="city" value="<?php echo (isset($dataArr)) ? $dataArr['town_city'] : 'Baltimore'; ?>">
		                <input type="hidden" name="country" id="country" value="<?php echo (isset($dataArr)) ? $dataArr['country'] : 'United States'; ?>">
		                <input type="hidden" name="state" id="state" value="<?php echo (isset($dataArr)) ? $dataArr['country_state'] : 'Maryland'; ?>">
		                <input type="hidden" name="postal_code" id="postal_code" value="<?php echo (isset($dataArr)) ? $dataArr['postcode_zipcode'] : '21202'; ?>">
		        	</fieldset>

		        	<fieldset>
						<legend class="text-semibold"><i class="icon-truck position-left"></i> Login details</legend>
						<div class="row">
							<div class="col-md-3">
			                    <div class="form-group has-feedback">
			                        <label class="control-label required">First Name</label>
			                        <input type="text" class="form-control" name="txt_fname" id="txt_fname" placeholder="First Name" value="<?php echo (isset($LoginDetailsArr)) ? $LoginDetailsArr['firstName'] : set_value('txt_fname');  ?>">
			                    </div>
			                </div>
			                <div class="col-md-3">
			                    <div class="form-group has-feedback">
			                        <label class="control-label required">Last Name</label>
			                        <input type="text" class="form-control" name="txt_lname" id="txt_lname" placeholder="Last Name" value="<?php echo (isset($LoginDetailsArr)) ? $LoginDetailsArr['lastName'] : set_value('txt_lname');  ?>">
			                    </div>
			                </div>
							<div class="col-md-3">
			                    <div class="form-group has-feedback">
			                        <label class="control-label required">Username</label>
			                        <input type="text" class="form-control" name="txt_uname" id="txt_uname" placeholder="User Name" value="<?php echo (isset($LoginDetailsArr)) ? $LoginDetailsArr['username'] : set_value('txt_uname');  ?>">
			                    </div>
			                </div>
			                <div class="col-md-3">
			                    <div class="form-group has-feedback">
			                        <label class="control-label required">Email</label>
			                        <input type="text" class="form-control" name="txt_email" id="txt_email" placeholder="Email" value="<?php echo (isset($LoginDetailsArr)) ? $LoginDetailsArr['emailAddress'] : set_value('txt_email');  ?>">
			                    </div>
			                </div>
			                <div class="col-md-3">
			                    <div class="form-group has-feedback">
			                        <label class="control-label <?php if(!isset($LoginDetailsArr)){ echo 'required'; } ?>">Password</label>
			                        <input type="text" class="form-control" name="txt_pass" id="txt_pass" placeholder="Password" value="<?php echo set_value('txt_pass');  ?>" <?php if(!isset($LoginDetailsArr)){ echo 'required'; }else{ echo 'readonly'; } ?>>
			                    </div>
			                </div>
			                <div class="col-md-3">
			                    <div class="form-group has-feedback">
			                        <label class="control-label <?php if(!isset($LoginDetailsArr)){ echo 'required'; } ?>">Confirm Password</label>
			                        <input type="text" class="form-control" name="txt_cpass" id="txt_cpass" placeholder="Confirm Password" value="<?php echo set_value('txt_cpass');  ?>" <?php if(!isset($LoginDetailsArr)){ echo 'required'; }else{ echo 'readonly'; } ?>>
			                    </div>
			                </div>
			            </div>
	                </fieldset>
	                <div class="row">
		                    <div class="col-md-12">
		                        <div class="form-group">
		                            <button type="submit" class="btn bg-success custom_save_button">Save</button>
		                            <a class="btn bg-danger custom_cancel_button" href="<?php echo site_url('manage_company'); ?>">Cancel</a>
		                        </div>
		                    </div>
		                </div>
	            </div>
            </form>
        </div>
    </div>
</div>
<script src="assets/js/custom_pages/super_admin/company.js"></script>
<script type="text/javascript">
	/*********************************************************
                        Map Integration
    **********************************************************/
        var map;
        <?php if(isset($dataArr)){ ?>
        	generateMap($('#latitude').val(), $('#longitude').val(), '');
	        google.maps.event.addDomListener(window, 'load', function () {
	            var businessAddress = new google.maps.places.Autocomplete(document.getElementById('address'));
	            google.maps.event.addListener(businessAddress, 'place_changed', function () {
	                var place = businessAddress.getPlace();
	                getlocality(place);
	                var address = place.formatted_address;
	                var latitude = place.geometry.location.lat();
	                var longitude = place.geometry.location.lng();

	                var mesg = "Address: " + address;
	                mesg += "\nLatitude: " + latitude;
	                mesg += "\nLongitude: " + longitude;

	                business_address = $("#location").val();
	                $("#latitude").val(latitude);
	                $("#longitude").val(longitude);
	                generateMap(latitude, longitude, '');
	            });
	        });

	        function getlocality(data) {
	            for (var i = 0; i < data.address_components.length; i++) {
	                if (data.address_components[i].types[0] == 'locality') {
	                    $('#city').val(data.address_components[i].long_name);
	                }
	                if (data.address_components[i].types[0] == 'postal_code') {
	                    $('#postal_code').val(data.address_components[i].long_name);
	                }
	                if (data.address_components[i].types[0] == 'administrative_area_level_1') {
	                    $('#state').val(data.address_components[i].long_name);
	                }
	                if (data.address_components[i].types[0] == 'country') {
	                    $('#country').val(data.address_components[i].long_name);
	                }
	            }
	        }
	        var canvas = '';
	        function generateMap(latitude, longitude, canvas) {
	            var latlngPos = new google.maps.LatLng(latitude, longitude);
	            var marker = new google.maps.Marker({
	                map: map,
	                position: latlngPos,
	                draggable: true,
	            });

	            var geocoder = new google.maps.Geocoder();
	            map = new google.maps.Map(document.getElementById("map_canvas"), {
	                center: latlngPos,
	                zoom: 13,
	                mapTypeId: 'roadmap',
	                draggable: true
	            });
	            marker = new google.maps.Marker({
	                map: map,
	                position: latlngPos,
	                draggable: true
	            });

	            if (latitude == 0 && longitude == 0) {
	                navigator.geolocation.getCurrentPosition(function (position) {
	                    geocoder.geocode({'latLng': new google.maps.LatLng(position.coords.latitude, position.coords.longitude)}, function (results, status) {
	                        if (status == google.maps.GeocoderStatus.OK) {
	                            if (results[0]) {
	                                $('#address').val(results[0].formatted_address);
	                                $('#latitude').val(results[0].geometry.location.lat)
	                                $('#longitude').val(results[0].geometry.location.lng)
	                            }
	                        }
	                    });
	                    generateMap(position.coords.latitude, position.coords.longitude, '');
	                }, function () {
	                    handleLocationError(true, map.getCenter());
	                });

	                function handleLocationError(browserHasGeolocation, infoWindow, pos) {
	                    generateMap($('#latitude').val(), $('#longitude').val());
	                    geocoder.geocode({'latLng': new google.maps.LatLng($('#latitude').val(), $('#longitude').val())}, function (results, status) {
	                        if (status == google.maps.GeocoderStatus.OK) {
	                            if (results[0]) {
	                                $('#address').val(results[0].formatted_address);
	                            }
	                        }
	                    });
	                }
	            }

	            google.maps.event.addListener(marker, 'dragend', function (e) {
	                geocoder.geocode({
	                    latLng: marker.getPosition()
	                }, function (responses) {
	                    if (responses && responses.length > 0) {
	                        $('#address').val(responses[0].formatted_address);
	                        $("#latitude").val(marker.getPosition().lat());
	                        $("#longitude").val(marker.getPosition().lng());
	                        getlocality(responses[0]);
	                    } else {
	                        $('#location').val('');
	                        $("#latitude").val('');
	                        $("#longitude").val('');
	                    }
	                });
	            });
	            codeLatLng(latitude, longitude);
	        }

	        var input = document.getElementById('address');
	        google.maps.event.addDomListener(input, 'keydown', function (e) {
	            if (e.keyCode == 13) {
	                if ($(".pac-container .pac-item:first span:eq(3)").text() == "")
	                    var firstResult = $(".pac-container .pac-item:first .pac-item-query").text();
	                else
	                    var firstResult = $(".pac-container .pac-item:first .pac-item-query").text() + ", " + $(".pac-container .pac-item:first span:eq(3)").text();

	                var geocoder = new google.maps.Geocoder();
	                geocoder.geocode({"address": firstResult}, function (results, status) {
	                    if (status == google.maps.GeocoderStatus.OK) {
	                        var lat = results[0].geometry.location.lat(),
	                                lng = results[0].geometry.location.lng();
	                        e.target.value = firstResult;
	                        generateMap(lat, lng);
	                        codeLatLng(lat, lng);
	                        $(".pac-container").hide();
	                    }
	                });
	                e.preventDefault();
	            }
	        });

	        function codeLatLng(lat, lng) {
	            var latlng = new google.maps.LatLng(lat, lng);
	            var geocoder = new google.maps.Geocoder();
	            geocoder.geocode({'latLng': latlng}, function (results, status) {
	                if (status == google.maps.GeocoderStatus.OK) {
	                    if (results[1]) {
	                        $("#latitude").val(lat);
	                        $("#longitude").val(lng);
	                        for (var i = 0; i < results[0].address_components.length; i++) {
	                            if (results[0].address_components[i].types[0] == 'locality') {
	                                $('#city').val(results[0].address_components[i].long_name);
	                            }
	                            if (results[0].address_components[i].types[0] == 'postal_code') {
	                                $('#postal_code').val(results[0].address_components[i].long_name);
	                            }
	                            if (results[0].address_components[i].types[0] == 'administrative_area_level_1') {
	                                $('#state').val(results[0].address_components[i].long_name);
	                            }
	                            if (results[0].address_components[i].types[0] == 'country') {
	                                $('#country').val(results[0].address_components[i].long_name);
	                            }
	                        }
	                    }
	                }
	            });
	        }
        <?php }else{ ?>
	        generateMap(0, 0, '');
	        google.maps.event.addDomListener(window, 'load', function () {
	            var businessAddress = new google.maps.places.Autocomplete(document.getElementById('address'));
	            google.maps.event.addListener(businessAddress, 'place_changed', function () {
	                var place = businessAddress.getPlace();
	                var address = place.formatted_address;
	                getlocality(place);
	                /*Use to get latitude and longitude */
	                var latitude = place.geometry.location.lat();
	                var longitude = place.geometry.location.lng();

	                var mesg = "Address: " + address;
	                mesg += "\nLatitude: " + latitude;
	                mesg += "\nLongitude: " + longitude;

	                business_address = $("#location").val();
	                $("#latitude").val(latitude);
	                $("#longitude").val(longitude);
	                generateMap(latitude, longitude, '');
	            });
	        });

	        function getlocality(data) {
	            for (var i = 0; i < data.address_components.length; i++) {
	                if (data.address_components[i].types[0] == 'locality') {
	                    $('#city').val(data.address_components[i].long_name);
	                }
	                if (data.address_components[i].types[0] == 'postal_code') {
	                    $('#postal_code').val(data.address_components[i].long_name);
	                }
	                if (data.address_components[i].types[0] == 'administrative_area_level_1') {
	                    $('#state').val(data.address_components[i].long_name);
	                }
	                if (data.address_components[i].types[0] == 'country') {
	                    $('#country').val(data.address_components[i].long_name);
	                }
	            }
	        }
	        var canvas = '';
	        function generateMap(latitude, longitude, canvas) {
	            var latlngPos = new google.maps.LatLng(latitude, longitude);
	            var marker = new google.maps.Marker({
	                map: map,
	                position: latlngPos,
	                draggable: true,
	            });

	            var geocoder = new google.maps.Geocoder();
	            map = new google.maps.Map(document.getElementById("map_canvas"), {
	                center: latlngPos,
	                zoom: 13,
	                mapTypeId: 'roadmap',
	                draggable: true
	            });
	            marker = new google.maps.Marker({
	                map: map,
	                position: latlngPos,
	                draggable: true
	            });

	            if (latitude == 0 && longitude == 0) {
	                navigator.geolocation.getCurrentPosition(function (position) {
	                    geocoder.geocode({'latLng': new google.maps.LatLng(position.coords.latitude, position.coords.longitude)}, function (results, status) {
	                        if (status == google.maps.GeocoderStatus.OK) {
	                            if (results[0]) {
	                            	console.log(results[0]);
	                                $('#address').val(results[0].formatted_address);
	                                $('#latitude').val(results[0].geometry.location.lat)
	                                $('#longitude').val(results[0].geometry.location.lng)
	                            }
	                        }
	                    });
	                    generateMap(position.coords.latitude, position.coords.longitude, '');
	                }, function () {
	                    handleLocationError(true, map.getCenter());
	                });

	                function handleLocationError(browserHasGeolocation, infoWindow, pos) {
	                    generateMap($('#latitude').val(), $('#longitude').val());
	                    geocoder.geocode({'latLng': new google.maps.LatLng($('#latitude').val(), $('#longitude').val())}, function (results, status) {
	                        if (status == google.maps.GeocoderStatus.OK) {
	                            if (results[0]) {
	                                $('#address').val(results[0].formatted_address);
	                            }
	                        }
	                    });
	                }
	            }

	            google.maps.event.addListener(marker, 'dragend', function (e) {
	                geocoder.geocode({
	                    latLng: marker.getPosition()
	                }, function (responses) {
	                    if (responses && responses.length > 0) {
	                    	console.log(results[0]);
	                        $('#address').val(responses[0].formatted_address);
	                        $("#latitude").val(marker.getPosition().lat());
	                        $("#longitude").val(marker.getPosition().lng());
	                        getlocality(responses[0]);
	                    } else {
	                        $('#location').val('');
	                        $("#latitude").val('');
	                        $("#longitude").val('');
	                    }
	                });
	            });
	        }

	        var input = document.getElementById('address');
	        google.maps.event.addDomListener(input, 'keydown', function (e) {
	            if (e.keyCode == 13) {
	                if($(".pac-container .pac-item:first span:eq(3)").text() == "")
	                    var firstResult = $(".pac-container .pac-item:first .pac-item-query").text();
	                else
	                    var firstResult = $(".pac-container .pac-item:first .pac-item-query").text() + ", " + $(".pac-container .pac-item:first span:eq(3)").text();

	                var geocoder = new google.maps.Geocoder();
	                geocoder.geocode({"address":firstResult }, function(results, status) {
	                    if (status == google.maps.GeocoderStatus.OK) {
	                        var lat = results[0].geometry.location.lat(),
	                            lng = results[0].geometry.location.lng();
	                        e.target.value = firstResult;
	                        generateMap(lat,lng);
	                        codeLatLng(lat,lng);
	                        $(".pac-container").hide();
	                    }
	                });
	                e.preventDefault();
	            }
	        });
	        
	        function codeLatLng(lat, lng) {
	            var latlng = new google.maps.LatLng(lat, lng);
	            var geocoder = new google.maps.Geocoder();
	            geocoder.geocode({'latLng': latlng}, function(results, status) {
	                if (status == google.maps.GeocoderStatus.OK) {
	                    if (results[1]) {
	                        $("#latitude").val(lat);
	                        $("#longitude").val(lng);
	                        for (var i = 0; i < results[0].address_components.length; i++) {
	                            if (results[0].address_components[i].types[0] == 'locality') {
	                                $('#city').val(results[0].address_components[i].long_name);
	                            }
	                            if (results[0].address_components[i].types[0] == 'postal_code') {
	                                $('#postal_code').val(results[0].address_components[i].long_name);
	                            }
	                            if (results[0].address_components[i].types[0] == 'administrative_area_level_1') {
	                                $('#state').val(results[0].address_components[i].long_name);
	                            }
	                            if (results[0].address_components[i].types[0] == 'country') {
	                                $('#country').val(results[0].address_components[i].long_name);
	                            }
	                        }
	                    }
	                }
	            });
	        }
	    <?php } ?>
</script>