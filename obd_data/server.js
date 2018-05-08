var net = require('net');
const fs = require('fs');

var server = net.createServer();  
server.on('connection', handleConnection);

server.listen(3536, function() {  
  console.log('server listening to %j', server.address());
});

function handleConnection(conn) {  
  var remoteAddress = conn.remoteAddress + ':' + conn.remotePort;
  console.log('new client connection from %s', remoteAddress);

  conn.on('data', onConnData);
  conn.once('close', onConnClose);
  conn.on('error', onConnError);

  function onConnData(d) {
    console.log('connection data from %s: %s', remoteAddress, d);
	fs.writeFile('obd_device_data.txt', d, (err) => {  
		if (err) throw err;
		// success case, the file was saved
		console.log('File Edited');
	});
    //conn.write(d);
  }

  function onConnClose() {
    console.log('connection from %s closed', remoteAddress);
  }

  function onConnError(err) {
    console.log('Connection %s error: %s', remoteAddress, err.message);
  }
}
