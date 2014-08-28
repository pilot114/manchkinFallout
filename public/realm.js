
var gameId = document.URL.split('/').pop();
var realm = new autobahn.Connection({
    url: 'ws://127.0.0.1:9090',
    realm: 'realm'
});
realm.onopen = function (session) {
    function onwelcome(args) {
        // connect to game realm
        var game = new autobahn.Connection({
            url: 'ws://127.0.0.1:9090',
            realm: gameId
        });
        // unsub for realm...
    }

    function onfull(args) {
        console.log('Sorry, game is full');
    }

    session.subscribe('realm.welcome', onwelcome);
    session.subscribe('realm.full', onfull);
    session.publish('realm.init', [gameId, session.id]);
};
realm.open();
