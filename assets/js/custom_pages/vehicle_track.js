var pinImage = base_url + 'assets/images/loader-track-marker.png';

function google_route_livemap(deviceGUID) {
    start_point.push(parseFloat((gps_track[0]['latitude']).replace('"', '')), parseFloat((gps_track[0]['longitude']).replace('"', '')));
    var path = new google.maps.MVCArray();
    var service = new google.maps.DirectionsService();
    var poly = new google.maps.Polyline({
        map: vmap,
        strokeColor: '#00b3fd',
        strokeOpacity: 1,
        strokeWeight: 5
    });

    var src = new google.maps.LatLng(
            parseFloat(gps_track[0]['latitude'].replace('"', '')),
            parseFloat(gps_track[0]['longitude'].replace('"', ''))
            );


    var des = new google.maps.LatLng(
            parseFloat(gps_track[last_index]['latitude'].replace('"', '')),
            parseFloat(gps_track[last_index]['longitude'].replace('"', ''))
            );
    var waypoints = [];
    for (var i = 1; i < (gps_track.length - 1); i += 500) {
        var source_latlng = new google.maps.LatLng(
                parseFloat((gps_track[i]['latitude']).replace('"', '')),
                parseFloat((gps_track[i]['longitude']).replace('"', ''))
                );
        waypoints.push({location: source_latlng, stopover: false});
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
    vmarker = new google.maps.Marker({
        position: des,
        map: vmap,
        icon: {
            url: pinImage,
        },
    });
    var latlngbounds = new google.maps.LatLngBounds();
    latlngbounds.extend(vmarker.position);
    var bounds = new google.maps.LatLngBounds();
    vmap.setCenter(latlngbounds.getCenter());
    $('.device_time').html(gps_device_data[deviceGUID]['Time_stamp']);
    var infoWindow = new google.maps.InfoWindow({
        maxWidth: 350,
        display: 'inline'
    });
    var content = '<div id="iw-container">' +
            '<div class="iw-title">' + deviceGUID + '</div>' +
            '<div class="iw-content">' +
            '<p>' +
            '<table><tbody>' +
            '<tr><th>Address&nbsp;&nbsp;</th><td>' + start_point[0] + ', ' + start_point[1] + '</td></tr>' +
            '<tr><th>Date Time&nbsp;&nbsp;</th><td>' + gps_device_data[deviceGUID]['Time_stamp'] + '</td></tr>' +
            '</tbody></table></p>' +
            '</div>' +
            '<div class="iw-bottom-gradient"></div>' +
            '</div>';
    google.maps.event.addListener(vmarker, 'mouseover', function () {
        infoWindow.close();
        infoWindow.setContent(content);
        infoWindow.open(vmap, this);
    });
    google.maps.event.addListener(infoWindow, 'domready', function () {
        var iwOuter = $('.gm-style-iw');
        var iwBackground = iwOuter.prev();
        iwOuter.children(':nth-child(1)').css({'display': 'inline'});
        iwBackground.children(':nth-child(2)').css({'display': 'none'});
        iwBackground.children(':nth-child(4)').css({'display': 'none'});
        iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index': '1'});
        var iwCloseBtn = iwOuter.next();
        iwCloseBtn.css({width: '27px', height: '27px', opacity: '1', right: '38px', top: '3px', border: '7px solid #48b5e9', 'border-radius': '13px', 'box-shadow': '0 0 5px #3990B9'});
        if ($('.iw-content').height() < 140) {
            $('.iw-bottom-gradient').css({display: 'none'});
        }
        iwCloseBtn.mouseout(function () {
            $(this).css({opacity: '1'});
        });
    });

    if (window.location.href.indexOf('?track_date') == 0) {
        setInterval(function () {
            google_route_live_track(deviceGUID);
        }, 3000);
    }
}

function google_route_live_track(deviceGUID) {
    lat_lng = [];
    if (cnt == 0) {
        var source_latlng = new google.maps.LatLng(
                parseFloat(gps_track[last_index]['latitude'].replace('"', '')),
                parseFloat(gps_track[last_index]['longitude'].replace('"', ''))
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

    vmarker.setMap(null);

    vmarker = new google.maps.Marker({
        position: destination_latlng,
        map: vmap,
        icon: {
            url: pinImage,
        },
    });
    var latlngbounds = new google.maps.LatLngBounds();
    latlngbounds.extend(vmarker.position);
    var bounds = new google.maps.LatLngBounds();
    vmap.setCenter(latlngbounds.getCenter());
    $('.device_time').html(gps_device_data[deviceGUID]['Time_stamp']);

    var infoWindow = new google.maps.InfoWindow({
        maxWidth: 350,
        display: 'inline'
    });
    var content = '<div id="iw-container">' +
            '<div class="iw-title">' + deviceGUID + '</div>' +
            '<div class="iw-content">' +
            '<p>' +
            '<table><tbody>' +
            '<tr><th>Address&nbsp;&nbsp;</th><td>' + start_point[0] + ', ' + start_point[1] + '</td></tr>' +
            '<tr><th>Date Time&nbsp;&nbsp;</th><td>' + gps_device_data[deviceGUID]['Time_stamp'] + '</td></tr>' +
            '</tbody></table></p>' +
            '</div>' +
            '<div class="iw-bottom-gradient"></div>' +
            '</div>';
    google.maps.event.addListener(vmarker, 'mouseover', function () {
        infoWindow.close();
        infoWindow.setContent(content);
        infoWindow.open(vmap, this);
    });
    google.maps.event.addListener(infoWindow, 'domready', function () {
        var iwOuter = $('.gm-style-iw');
        var iwBackground = iwOuter.prev();
        iwOuter.children(':nth-child(1)').css({'display': 'inline'});
        iwBackground.children(':nth-child(2)').css({'display': 'none'});
        iwBackground.children(':nth-child(4)').css({'display': 'none'});
        iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index': '1'});
        var iwCloseBtn = iwOuter.next();
        iwCloseBtn.css({width: '27px', height: '27px', opacity: '1', right: '38px', top: '3px', border: '7px solid #48b5e9', 'border-radius': '13px', 'box-shadow': '0 0 5px #3990B9'});
        if ($('.iw-content').height() < 140) {
            $('.iw-bottom-gradient').css({display: 'none'});
        }
        iwCloseBtn.mouseout(function () {
            $(this).css({opacity: '1'});
        });
    });

    var path = new google.maps.MVCArray();
    var service = new google.maps.DirectionsService();
    var poly = new google.maps.Polyline({
        map: vmap,
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
    $.getJSON("http://maps.googleapis.com/maps/api/geocode/json?latlng=" + parseFloat(gps_device_data[deviceGUID]['GPS']['Latitude']) + "," + parseFloat(gps_device_data[deviceGUID]['GPS']['Longitude']) + "&sensor=true",
            function (data) {
                $('.device_address').html("<a href='https://www.google.com/maps?q=" + parseFloat(gps_device_data[deviceGUID]['GPS']['Latitude']) + "," + parseFloat(gps_device_data[deviceGUID]['GPS']['Longitude']) + "' target='_blank'>" + ((data['results'][0].formatted_address).substr(0, 20)) + "...</a>");
            }
    );

    //Ignition
    if (gps_device_data[deviceGUID]['STT'] != undefined) {
        if (gps_device_data[deviceGUID]['STT']['Alarm']['[Bit01]'] == '0--Moved') {
            $('.device_ignition').html('Off');
        } else {
            $('.device_ignition').html('On');
        }
    }

    // Speed
    var speed = '0 Km/h';
    if (gps_device_data[deviceGUID]['J1708'] != undefined) {
        speed = (gps_device_data[deviceGUID]['J1708']['PID84']).split('--')[0];
    }
    $('.device_speed').html(speed);

    // Google StreetView
    html = '<a href="http://maps.google.com/maps?q=&layer=c&cbll=' + parseFloat(gps_device_data[deviceGUID].GPS.Latitude) + ',' + parseFloat(gps_device_data[deviceGUID].GPS.Longitude) + '&cbp=11,0,0,0,0" target="_blank">';
    html += '<img src="https://maps.googleapis.com/maps/api/streetview?size=290x150&location=' + parseFloat(gps_device_data[deviceGUID].GPS.Latitude) + ',' + parseFloat(gps_device_data[deviceGUID].GPS.Longitude) + '&heading=151.78&pitch=-0.76&key=AIzaSyAE19qNQTlcPGeOthK32NgAUo1xoiks_-Y">';
    html += '</a>';
    $('.tbl_google_strettview tr td').html(html);
}

function normal_livemap(deviceGUID) {
    start_point.push(
            parseFloat((gps_track[0]['latitude']).replace('"', '')),
            parseFloat((gps_track[0]['longitude']).replace('"', ''))
            );
    for (var i = 0; i < gps_track.length; i++) {
        var _latlng = new google.maps.LatLng(
                parseFloat((gps_track[i]['latitude']).replace('"', '')),
                parseFloat((gps_track[i]['longitude']).replace('"', ''))
                );
        lat_lng.push(_latlng);
    }
    if (window.location.href.indexOf('?track_date') == 0) {
        var current_latlng = new google.maps.LatLng(
                parseFloat((gps_device_data[deviceGUID]['GPS']['Latitude'])),
                parseFloat((gps_device_data[deviceGUID]['GPS']['Longitude']))
                );
        lat_lng.push(current_latlng);
        prev_latlng = current_latlng;
    } else {
        current_latlng = _latlng;
    }

    for (var j = 0; j < lat_lng.length; j++) {
        if ((j + 1) < lat_lng.length) {
            var src = lat_lng[j];
            var des = lat_lng[j + 1];
            path.push(src);
            path.push(des);
            var poly = new google.maps.Polyline({
                map: vmap,
                path: lat_lng,
                geodesic: true,
                strokeColor: '#FF5722',
                strokeOpacity: 1,
                strokeWeight: 2
            });
            path = [];
        }
    }

    vmarker = new google.maps.Marker({
        position: current_latlng,
        map: vmap,
        icon: {
            url: pinImage,
        },
    });
    var latlngbounds = new google.maps.LatLngBounds();
    latlngbounds.extend(vmarker.position);
    var bounds = new google.maps.LatLngBounds();
    vmap.setCenter(latlngbounds.getCenter());
    $('.device_time').html(gps_device_data[deviceGUID]['Time_stamp']);
    var infoWindow = new google.maps.InfoWindow({
        maxWidth: 350,
        display: 'inline'
    });
    var content = '<div id="iw-container">' +
            '<div class="iw-title">' + deviceGUID + '</div>' +
            '<div class="iw-content">' +
            '<p>' +
            '<table><tbody>' +
            '<tr><th>Address&nbsp;&nbsp;</th><td>' + start_point[0] + ', ' + start_point[1] + '</td></tr>' +
            '<tr><th>Date Time&nbsp;&nbsp;</th><td>' + gps_device_data[deviceGUID]['Time_stamp'] + '</td></tr>' +
            '</tbody></table></p>' +
            '</div>' +
            '<div class="iw-bottom-gradient"></div>' +
            '</div>';
    google.maps.event.addListener(vmarker, 'mouseover', function () {
        infoWindow.close();
        infoWindow.setContent(content);
        infoWindow.open(vmap, this);
    });
    google.maps.event.addListener(infoWindow, 'domready', function () {
        var iwOuter = $('.gm-style-iw');
        var iwBackground = iwOuter.prev();
        iwOuter.children(':nth-child(1)').css({'display': 'inline'});
        iwBackground.children(':nth-child(2)').css({'display': 'none'});
        iwBackground.children(':nth-child(4)').css({'display': 'none'});
        iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index': '1'});
        var iwCloseBtn = iwOuter.next();
        iwCloseBtn.css({width: '27px', height: '27px', opacity: '1', right: '38px', top: '3px', border: '7px solid #48b5e9', 'border-radius': '13px', 'box-shadow': '0 0 5px #3990B9'});
        if ($('.iw-content').height() < 140) {
            $('.iw-bottom-gradient').css({display: 'none'});
        }
        iwCloseBtn.mouseout(function () {
            $(this).css({opacity: '1'});
        });
    });

    if (window.location.href.indexOf('?track_date') == 0) {
        setInterval(function () {
            noraml_live_track(deviceGUID);
        }, 7000);
    }
}

function noraml_live_track(deviceGUID) {
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

    vmarker.setMap(null);

    vmarker = new google.maps.Marker({
        position: destination_latlng,
        map: vmap,
        icon: {
            url: pinImage,
        },
    });
    var latlngbounds = new google.maps.LatLngBounds();
    latlngbounds.extend(vmarker.position);
    var bounds = new google.maps.LatLngBounds();
    //map.setCenter(latlngbounds.getCenter());
    $('.device_time').html(gps_device_data[deviceGUID]['Time_stamp']);
    var infoWindow = new google.maps.InfoWindow({
        maxWidth: 350,
        display: 'inline'
    });
    var content = '<div id="iw-container">' +
            '<div class="iw-title">' + deviceGUID + '</div>' +
            '<div class="iw-content">' +
            '<p>' +
            '<table><tbody>' +
            '<tr><th>Address&nbsp;&nbsp;</th><td>' + start_point[0] + ', ' + start_point[1] + '</td></tr>' +
            '<tr><th>Date Time&nbsp;&nbsp;</th><td>' + gps_device_data[deviceGUID]['Time_stamp'] + '</td></tr>' +
            '</tbody></table></p>' +
            '</div>' +
            '<div class="iw-bottom-gradient"></div>' +
            '</div>';
    google.maps.event.addListener(vmarker, 'mouseover', function () {
        infoWindow.close();
        infoWindow.setContent(content);
        infoWindow.open(vmap, this);
    });
    google.maps.event.addListener(infoWindow, 'domready', function () {
        var iwOuter = $('.gm-style-iw');
        var iwBackground = iwOuter.prev();
        iwOuter.children(':nth-child(1)').css({'display': 'inline'});
        iwBackground.children(':nth-child(2)').css({'display': 'none'});
        iwBackground.children(':nth-child(4)').css({'display': 'none'});
        iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index': '1'});
        var iwCloseBtn = iwOuter.next();
        iwCloseBtn.css({width: '27px', height: '27px', opacity: '1', right: '38px', top: '3px', border: '7px solid #48b5e9', 'border-radius': '13px', 'box-shadow': '0 0 5px #3990B9'});
        if ($('.iw-content').height() < 140) {
            $('.iw-bottom-gradient').css({display: 'none'});
        }
        iwCloseBtn.mouseout(function () {
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
                map: vmap,
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
    $.getJSON("http://maps.googleapis.com/maps/api/geocode/json?latlng=" + parseFloat(gps_device_data[deviceGUID]['GPS']['Latitude']) + "," + parseFloat(gps_device_data[deviceGUID]['GPS']['Longitude']) + "&sensor=true",
            function (data) {
                $('.device_address').html("<a href='https://www.google.com/maps?q=" + parseFloat(gps_device_data[deviceGUID]['GPS']['Latitude']) + "," + parseFloat(gps_device_data[deviceGUID]['GPS']['Longitude']) + "' target='_blank'>" + ((data['results'][0].formatted_address).substr(0, 20)) + "...</a>");
            }
    );

    //Ignition
    if (gps_device_data[deviceGUID]['STT'] != undefined) {
        if (gps_device_data[deviceGUID]['STT']['Alarm']['[Bit01]'] == '0--Moved') {
            $('.device_ignition').html('Off');
        } else {
            $('.device_ignition').html('On');
        }
    }

    // Speed
    var speed = '0 Km/h';
    if (gps_device_data[deviceGUID]['J1708'] != undefined) {
        speed = (gps_device_data[deviceGUID]['J1708']['PID84']).split('--')[0];
    }
    $('.device_speed').html(speed);

    // Google StreetView
    html = '<a href="http://maps.google.com/maps?q=&layer=c&cbll=' + parseFloat(gps_device_data[deviceGUID].GPS.Latitude) + ',' + parseFloat(gps_device_data[deviceGUID].GPS.Longitude) + '&cbp=11,0,0,0,0" target="_blank">';
    html += '<img src="https://maps.googleapis.com/maps/api/streetview?size=290x150&location=' + parseFloat(gps_device_data[deviceGUID].GPS.Latitude) + ',' + parseFloat(gps_device_data[deviceGUID].GPS.Longitude) + '&heading=151.78&pitch=-0.76&key=AIzaSyAE19qNQTlcPGeOthK32NgAUo1xoiks_-Y">';
    html += '</a>';
    $('.tbl_google_strettview tr td').html(html);
}