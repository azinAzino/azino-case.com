
var io = require('socket.io').listen(3000); 
var requestify = require('requestify');

io.on('connection', function (socket) {

	io.sockets.emit('online', Object.keys(io.sockets.adapter.rooms).length);
	console.info('Connected ' + Object.keys(io.sockets.adapter.rooms).length + ' clients');

    socket.on('NEWdrop', function(e){
		// console.log(e);
		drop(e);
		reg();
    });
	
	socket.on('disconnect', function(){
		// console.log('DiSCONNECTED!');
		io.sockets.emit('online', Object.keys(io.sockets.adapter.rooms).length);
		reg();
	});

});


function drop(e)
{
	// console.log(e);
	requestify.get('http://goldenmines.online/api/lastOpen/' + e )
	.then(function (response) {
		data = JSON.parse(response.body);
		io.sockets.emit('loadLiveDrop', data);
		// console.log("[!] loadLiveDrop");
	}, 
	function (err) 
	{
		// console.log('[!] ERROR WITH loadLiveDrop!');
	});
}


function reg()
{
	requestify.get('http://goldenmines.online/api/users')
	.then(function(response) {
		data = JSON.parse(response.body);
		io.sockets.emit('reg', data);
		// console.log('[!] USERS: ' + data.count);
	},
	function(err)
	{
		// console.log('[!] ERROR WITH USERS!');
	});
}