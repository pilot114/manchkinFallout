var connection = new autobahn.Connection({
    url: 'ws://127.0.0.1:9090',
    realm: 'realm1'
});
connection.open();

connection.onclose = function (reason, details) {
    console.log(reason)
};

connection.onopen = function (session) {

    function onevent(args) {
        console.log("Event:", args[0]);
    }
    session.subscribe('game.log', onevent);
    session.publish('game.log', ['Hello, world!']);
};
