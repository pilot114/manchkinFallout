var webSocket = new WebSocket('ws://127.0.0.1:9090');
//
//webSocket.onopen = function(event) {
//    console.log('onopen');
//    webSocket.send("Hello Web Socket!");
//};
//
//webSocket.onmessage = function(event) {
//    console.log('onmessage, ' + event.data);
////    webSocket.close();
//};
//
//webSocket.onclose = function(event) {
//    console.log('onclose');
//};

var connection = new autobahn.Connection({
    url: 'ws://127.0.0.1:9090/',
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
