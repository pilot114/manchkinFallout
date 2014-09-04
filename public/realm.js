
var gameId = document.URL.split('/').pop();
var realm = new autobahn.Connection({
    url: 'ws://127.0.0.1:9090',
    realm: 'realm'
});

render = {
    playerWindow : function(n) {
        $('div').remove();
    }
}
render.playerWindow(3);

realm.onopen = function (session) {
    function onwelcome() {

        // connect to game realm
        var game = new autobahn.Connection({
            url: 'ws://127.0.0.1:9090',
            realm: gameId
        });

        // and close router connection...
        realm.close();

        game.onopen = function (session) {

            function onevent(args) {
                console.log("Event:", args);
            }
            function onlog(args) {
                console.log("Log:", args);
            }
            function onchat(args) {
                console.log("Chat:", args);
            }

            session.subscribe('game.event', onevent);
            session.subscribe('game.log', onlog);
            session.subscribe('game.chat', onchat);

//            session.publish('game.event', ['addPlayer', clientId]);
        };

        game.open();
    }

    function onfull(args) {
        console.log('Sorry, game is full');
    }

    if (localStorage.getItem("clientId")) {
        var clientId = localStorage.getItem("clientId");
    } else {
        var clientId = new Date().valueOf();
        localStorage.setItem("clientId", clientId);
    }

    session.subscribe('realm.welcome', onwelcome);
    session.subscribe('realm.full', onfull);
    session.publish('realm.init', [gameId, clientId]);
};
realm.open();
