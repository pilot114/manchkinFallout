var ab = new autobahn.Connection({
    url: 'wss://localhost:8080'
});

ab.onopen = function(session) {

    console.log('Connect');
    console.log(session);

    // 1) subscribe to a topic
    function onevent(args) {
        console.log("Event:", args[0]);
    }
    session.subscribe('game', onevent);

    // 2) publish an event
    session.publish('game', ['Hello, world!']);


    // 3) register a procedure for remoting
        function add2(args) {
            return args[0] + args[1];
        }
    session.register('game.test', add2);

    // 4) call a remote procedure
    session.call('game.test.add2', [2, 3]).then(
        function (res) {
            console.log("Result:", res);
        }
    );
};

ab.onclose = function(session) {

    console.log('Disconnect');
};

ab.open();
