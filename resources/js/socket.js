window.onload = function() {

    socket = io.connect('http://goldenmines.online:3000', {rememberTransport: false});
    
    socket.on('loadLiveDrop', function(t){
        var userId = $("body").attr("data-user-id");
        t.userId == userId ? setTimeout(function() {
                updateLive(t)
        }, 3e3) : updateLive(t)
    });	


    socket.on('online', function(t){
        // console.log('online');
        updateOnline(t)
    });	
    
    socket.on('reg', function(t){
        // console.log('reg');
        updateReg(t.count)
    });
    
    socket.on('connection', function(socket){
        // console.log('a user connected');
    });

};

var count = {
    online: 0,
    users: 0,
    eggs: 0
}

var updateReg = function(t) {
    var e = count.users;
    count.users = t, 
    // $("#user-counter").numTo(e, count.users + 169000)
    $("#user-counter").text(count.users + 169000)
}

var updateOnline = function(t) {
    var e = count.online;
    count.online = t, 
    // $("#online-counter").numTo(e, count.online + 200)
    $("#online-counter").text(count.online + 200)
}

var updateEggs =function(t) {
    var e = count.eggs;
    count.eggs = t, 
    // $("#case-counter").numTo(e, count.eggs + 2780000)
    $("#case-counter").text(count.eggs + 2780000)
}


var updateLive = function(t) {
    if (location.host.indexOf('golden-mines.club') != -1) t.photo = '/img/avatar2.png';
    var e = '<div class="coin-block-min__coin-glow"></div><img src="' + t.image + '" alt="" class="coin-block-min__coin-img"><div class="coin-block-min__ava-link"><div class="circle-ava"><a href="' + t.link + '"><img src="' + t.photo + '" alt="" class="circle-ava__img"></a></div></div>';

    $(".coin-block-min__new").html(e)
    .addClass("coin-block-min_" + t.light)
    .removeClass("coin-block-min__new");
    $(".coin-block-min__new_min")
    .addClass("coin-block-min__new")
    .removeClass("coin-block-min__new_min"); 
    $(".live-win__coins-wrapper")
    .prepend('<div class="coin-block-min coin-block-min__new_min"></div>');
    $(".coin-block-min:last").remove(), updateEggs(t.total);
    var n = $("#list-box-" + t.boxId);
    if(n.length) {
        var r = n.find(".case-block__all-paid .case-block__sum");
        r.numTo(r.attr("data-value"), t.totalBox), r.attr("data-value", t.totalBox)
    }
}

