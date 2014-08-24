var connection = new autobahn.Connection({
    url: 'ws://127.0.0.1:9090',
    realm: 'realm1'
});

var gameId = document.URL.split('/').pop();

connection.onopen = function (session) {

    function onevent(args) {
        console.log("Event:", args[0]);
    }
    function onlog(args) {
        console.log("Log:", args[0]);
    }
    function onchat(args) {
        console.log("Chat:", args[0]);
    }

    session.subscribe('game.event', onevent);
    session.subscribe('com.log', onlog);
    session.subscribe('com.chat', onchat);

    // 2) publish an event
    session.publish('game.event', ['Add player']);
};

connection.open();