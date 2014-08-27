if(gameId) {

    var game = new autobahn.Connection({
        url: 'ws://127.0.0.1:9090',
        realm: 'realm'
    });

    game.onopen = function (session) {

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

        session.publish('game.event', ['addPlayer']);
    };
//    game.open();
}
