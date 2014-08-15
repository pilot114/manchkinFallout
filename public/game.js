var connection = new autobahn.Connection({
    url: 'wss://localhost:9090/wsapi',
    realm: 'realm1'
});
//connection.open();

connection.onopen = function (session) {

    // 1) subscribe to a topic
    function onevent(args) {
        console.log("Event:", args[0]);
    }
//    session.subscribe('com.myapp.hello', onevent);
//
    // 2) publish an event
//    session.publish('com.myapp.hello', ['Hello, world!']);
};
