
var gameId = document.URL.split('/').pop();
var realm = new autobahn.Connection({
    url: 'ws://127.0.0.1:9090',
    realm: 'realm'
});
realm.onopen = function (session) {

//    session.subscribe('realm.add', onevent);
    session.publish('realm.create', [gameId]);
};
realm.open();
