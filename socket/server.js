var net = require('net');
const fs = require('fs');
const _ = require('underscore');

var device_id_array = [];
var data_array = [];

var server = net.createServer();  
server.on('connection', handleConnection);

server.listen(3536, function() {  
  console.log('server listening to %j', server.address());
});

function handleConnection(conn) {  
  var remoteAddress = conn.remoteAddress + ':' + conn.remotePort;
  //console.log('new client connection from %s', remoteAddress);

  conn.on('data', onConnData);
  conn.once('close', onConnClose);
  conn.on('error', onConnError);

  var i = 0;
  function onConnData(d) {
	var data = d.toString('utf8');
	var attr = data.split(',');
	var device_data = '';

	var devices = _.pluck(data_array,'device_id');

	if(devices.length > 0){
		var i = _.indexOf(devices,(attr[1].split('#'))[0]);
		if(i === -1){
			data_array.push({"device_id":(attr[1].split('#'))[0],"data":data});
		} else {
			data_array[i].data = data;
		}
	} else {
		data_array.push({"device_id":(attr[1].split('#'))[0],"data":data});
	}
	data_array.forEach(function(item) {
		device_data = device_data.concat(item.data);
	});
	fs.writeFile('obd_device_data.txt', device_data, (err) => {
		if (err) throw err;
	});
  }

  function onConnClose() {
    //console.log('connection from %s closed', remoteAddress);
  }

  function onConnError(err) {
    //console.log('Connection %s error: %s', remoteAddress, err.message);
  }
}
