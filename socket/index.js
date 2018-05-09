var net = require('net');
var HOST = '80.95.189.228';
var PORT = 3536;

 var server = net.createServer(function(socket) {
 	socket.write('Echo server\r\n');
 	socket.pipe(socket);
 });
 server.listen(PORT, HOST);

var client = new net.Socket();
client.connect(PORT, HOST, function() {
    console.log('Connected to ' + HOST + ':' + PORT);
    // Write a message to the socket as soon as the client is connected, the server will receive it as message from the client  
    //client.write('GET I am Chuck Norris!');
});

// Add a 'data' event handler for the client socket
client.on('data', function(data) {
    console.log('DATA: ' + data);
    client.destroy();
});

// Add a 'close' event handler for the client socket
client.on('close', function() {
    console.log('Connection closed');
});
