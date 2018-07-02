<?php
if ($this->isAdmin)
    $section_class = 'home-content padding-none admin-content';
else
    $section_class = 'setting-page';
?>
<section class="<?php echo $section_class ?>">
    <div class="container">
        <div class="row">
            <?php
            if (!$this->isAdmin)
                $this->load->view('company_admin/settings/settings_header')
                ?>
            <div class="panel-content d-flex">
                <div class="left-nav">
                    <ul>
                        <li class="current-nav">
                            <a href="<?php echo site_url('manage_company') ?>">
                                <span>Manage Company</span>
                            </a>
                        </li>
                        <li class="trends-nav active">
                            <a href="<?php echo site_url('manage_company/add') ?>">
                                <span><?php echo (isset($dataArr)) ? "Edit" : "Add New"; ?></span>
                            </a>
                        </li>
                    </ul>
                </div>                
                <div class="right-panel">
                    <div class="content-wrapper">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" id="add_compnay_form" enctype="multipart/form-data">
                                    <div class="panel panel-body login-form">
                                        <?php
                                        if (!isset($LoginDetailsArr)) {
                                            $field_attribute = $label_attribute = 'required';
                                        } else {
                                            $field_attribute = 'readonly';
                                            $label_attribute = '';
                                        }
                                        ?>
                                        <div class="add-form-wrap">
                                            <div class="add-form-l">
                                                <div class="form-group">
                                                    <label class="control-label required">Company Name</label>
                                                    <input type="text" class="form-control" name="name" id="name" placeholder="Company Name" value="<?php echo (isset($dataArr)) ? $dataArr['companyName'] : set_value('name'); ?>">
                                                    <?php echo '<label id="name-error" class="validation-error-label" for="name">' . form_error('name') . '</label>'; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Parent Company</label>
                                                    <select name="parent_company" class="form-control select-control">
                                                        <option value="">Select Company</option>
                                                        <?php
                                                        foreach ($parent_companies as $company) {
                                                            $selected = '';
                                                            if (isset($dataArr) && $dataArr['parentCompanyGUID'] == $company['companyGUID'])
                                                                $selected = 'selected';
                                                            ?>
                                                            <option value="<?php echo $company['companyGUID'] ?>" <?php echo $selected ?>><?php echo $company['companyName'] ?></option>
                                                        <?php }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label required">City</label>
                                                    <input type="text" class="form-control" name="city" id="city" placeholder="City" value="<?php echo (isset($dataArr)) ? $dataArr['town_city'] : 'Baltimore'; ?>" required>
                                                    <?php echo '<label id="city-error" class="validation-error-label" for="city">' . form_error('city') . '</label>'; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label required">State</label>
                                                    <input type="text" class="form-control" name="state" id="state" placeholder="State" value="<?php echo (isset($dataArr)) ? $dataArr['country_state'] : 'Maryland'; ?>" required>
                                                    <?php echo '<label id="state-error" class="validation-error-label" for="state">' . form_error('state') . '</label>'; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label required">Postal Code</label>
                                                    <input type="text" class="form-control" name="postal_code" id="postal_code" placeholder="Postal code" value="<?php echo (isset($dataArr)) ? $dataArr['postcode_zipcode'] : '21202'; ?>" required>
                                                    <?php echo '<label id="postal_code-error" class="validation-error-label" for="postal_code">' . form_error('postal_code') . '</label>'; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label required">Country</label>
                                                    <input type="text" class="form-control" name="country" id="country" placeholder="Country" value="<?php echo (isset($dataArr)) ? $dataArr['country'] : 'Maryland'; ?>" required>
                                                    <?php echo '<label id="country-error" class="validation-error-label" for="country">' . form_error('country') . '</label>'; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label <?php echo $label_attribute ?>">First Name</label>
                                                    <input type="text" class="form-control" name="txt_fname" id="txt_fname" placeholder="First Name" value="<?php echo (isset($LoginDetailsArr)) ? $LoginDetailsArr['firstName'] : set_value('txt_fname'); ?>" <?php echo $field_attribute ?>>
                                                    <?php echo '<label id="txt_fname-error" class="validation-error-label" for="txt_fname">' . form_error('txt_fname') . '</label>'; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label <?php echo $label_attribute ?>">Last Name</label>
                                                    <input type="text" class="form-control" name="txt_lname" id="txt_lname" placeholder="Last Name" value="<?php echo (isset($LoginDetailsArr)) ? $LoginDetailsArr['lastName'] : set_value('txt_lname'); ?>" <?php echo $field_attribute ?>>
                                                    <?php echo '<label id="txt_lname-error" class="validation-error-label" for="txt_lname">' . form_error('txt_lname') . '</label>'; ?>
                                                </div>    
                                                <div class="form-group">
                                                    <label class="control-label <?php echo $label_attribute ?>">Username</label>
                                                    <input type="text" class="form-control" name="txt_uname" id="txt_uname" placeholder="User Name" value="<?php echo (isset($LoginDetailsArr)) ? $LoginDetailsArr['username'] : set_value('txt_uname'); ?>" <?php echo $field_attribute ?>>
                                                    <?php echo '<label id="txt_uname-error" class="validation-error-label" for="txt_uname">' . form_error('txt_uname') . '</label>'; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label <?php echo $label_attribute ?>">Email</label>
                                                    <input type="email" class="form-control" name="txt_email" id="txt_email" placeholder="Email" value="<?php echo (isset($LoginDetailsArr)) ? $LoginDetailsArr['emailAddress'] : set_value('txt_email'); ?>" <?php echo $field_attribute ?>>
                                                    <?php echo '<label id="txt_email-error" class="validation-error-label" for="txt_email">' . form_error('txt_email') . '</label>'; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label <?php
                                                    if (!isset($LoginDetailsArr)) {
                                                        echo 'required';
                                                    }
                                                    ?>">Password</label>
                                                    <input type="text" class="form-control" name="txt_pass" id="txt_pass" placeholder="Password" value="<?php echo set_value('txt_pass'); ?>" <?php echo $field_attribute ?>>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label <?php
                                                    if (!isset($LoginDetailsArr)) {
                                                        echo 'required';
                                                    }
                                                    ?>">Confirm Password</label>
                                                    <input type="text" class="form-control" name="txt_cpass" id="txt_cpass" placeholder="Confirm Password" value="<?php echo set_value('txt_cpass'); ?>" <?php echo $field_attribute ?>>
                                                </div>
                                            </div>
                                            <div class="add-form-r">
                                                <div class="form-group">
                                                    <label class="control-label required">Address</label>
                                                    <input type="text" class="form-control" name="address" id="address" placeholder="Company Address" value="<?php echo (isset($dataArr)) ? $dataArr['addressLine1'] : set_value('address'); ?>">
                                                    <?php echo '<label id="address_error2" class="validation-error-label" for="address">' . form_error('address') . '</label>'; ?>
                                                    <div id="map_canvas" style="min-height:300px"></div>
                                                </div>
                                                <input type="hidden" name="latitude" id="latitude" value="<?php echo (isset($dataArr)) ? $dataArr['latitude'] : '39.2904'; ?>">
                                                <input type="hidden" name="longitude" id="longitude" value="<?php echo (isset($dataArr)) ? $dataArr['longitude'] : '-76.6122'; ?>">
                                                <!--<input type="hidden" name="city" id="city" value="<?php echo (isset($dataArr)) ? $dataArr['town_city'] : 'Baltimore'; ?>">-->
                                                <!--<input type="hidden" name="country" id="country" value="<?php echo (isset($dataArr)) ? $dataArr['country'] : 'United States'; ?>">-->
                                                <!--<input type="hidden" name="state" id="state" value="<?php echo (isset($dataArr)) ? $dataArr['country_state'] : 'Maryland'; ?>">-->
                                                <!--<input type="hidden" name="postal_code" id="postal_code" value="<?php echo (isset($dataArr)) ? $dataArr['postcode_zipcode'] : '21202'; ?>">-->
                                            </div>    
                                        </div>    
                                        <div class="add-form-btn">
                                            <button type="submit" class="custom_save_button">Save</button>
                                            <a class="custom_cancel_button" href="<?php echo site_url('manage_company'); ?>">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>	
</section>
<?php
$edit = 0;
$unique_id = '';
$company_id = '';
if (isset($LoginDetailsArr)) {
    $edit = 1;
    $unique_id = $LoginDetailsArr['userGUID'];
    $company_id = $dataArr['companyGUID'];
}
?>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=geometry,places&v=3.27&key=AIzaSyCcvuBSTZ5P8My0Am1uy0RgRQ7gu5SyuAw"></script>
<script type="text/javascript">
    uname_ajax = '<?php echo site_url('super_admin/company/check_username') ?>';
    email_ajax = '<?php echo site_url('super_admin/company/check_useremail') ?>';
    company_ajax = '<?php echo site_url('super_admin/company/check_comapnyname') ?>';
    edit = <?php echo $edit ?>;
    if (edit == 1) {
        uname_ajax += '/<?php echo $unique_id ?>';
        email_ajax += '/<?php echo $unique_id ?>';
        company_ajax += '/<?php echo $company_id ?>';
    }

    /*********************************************************
     Map Integration
     **********************************************************/
    var map;
<?php if (isset($dataArr)) { ?>
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
<?php } else { ?>
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
<?php } ?>

    /****************************************************************************
     This function is used to validate form
     ****************************************************************************/
    var validator = $("#add_compnay_form").validate({ignore: 'input[type=hidden], .select2-search__field, #txt_status', // ignore hidden fields
        errorClass: 'validation-error-label', successClass: 'validation-valid-label',
        highlight: function (element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function (element, errorClass) {
            $(element).removeClass(errorClass);
        },
        errorPlacement: function (error, element) {
            $(element).parent().find('.form_success_vert_icon').remove();
            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container')) {
                if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo(element.parent().parent().parent().parent());
                } else {
                    error.appendTo(element.parent().parent().parent().parent().parent());
                }
            } else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                error.appendTo(element.parent().parent().parent());
            } else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo(element.parent());
            } else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo(element.parent().parent());
            } else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                error.appendTo(element.parent().parent());
            } else {
                error.insertAfter(element);
            }
        },
        validClass: "validation-valid-label",
        success: function (element) {
            if ($(element).parent('div').hasClass('media-body')) {
                $(element).parent().find('.form_success_vert_icon').remove();
                $(element).remove();
            } else {
                $(element).parent().find('.form_success_vert_icon').remove();
                $(element).parent().append('<div class="form_success_vert_icon form-control-feedback"><i class="icon-checkmark-circle"></i></div>');
                $(element).remove();
            }
        },
        rules: {
            name: {required: true, remote: company_ajax},
            address: {required: true},
            txt_fname: {required: true},
            txt_lname: {required: true},
            txt_uname: {required: true, remote: uname_ajax},
            txt_email: {required: true, email: true, remote: email_ajax},
            txt_pass: {minlength: 8},
            txt_cpass: {minlength: 8, equalTo: "#txt_pass"}
        },
        messages: {
            name: {remote: jQuery.validator.format("Company name already exist!")},
            txt_uname: {
                remote: jQuery.validator.format("Username already exist!"),
            },
            txt_email: {
                remote: jQuery.validator.format("Email already exist!"),
            },
        },
        submitHandler: function (form) {
            form.submit();
            $('.custom_save_button').prop('disabled', true);
        },
        invalidHandler: function () {
            $('.custom_save_button').prop('disabled', false);
        }
    });
</script>