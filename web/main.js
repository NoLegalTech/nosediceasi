$(function() {
    // Initialize Firebase
    var config = {
        apiKey: "AIzaSyDhM8eHJiZWe2Ecq_wE2i1HgVCFBhfIr_o",
        authDomain: "nosediceasi-569f3.firebaseapp.com",
        databaseURL: "https://nosediceasi-569f3.firebaseio.com",
        projectId: "nosediceasi-569f3",
        storageBucket: "",
        messagingSenderId: "444352464376"
    };
    firebase.initializeApp(config);

    var database = firebase.database();

    database.ref('tweets').on('value', function(snapshot) {
        var tweets = snapshot.val();
        for (id in tweets) {
            var tweet = tweets[id];
            $('#graves').append(
                '<a class="grave" target="_blank" href="https://twitter.com/' + tweet.nick + '/status/' + tweet.id + '">' +
                    '<div class="nickname">' + tweet.nick + '</div>' +
                '</a>'
            );
        }
    });
});
