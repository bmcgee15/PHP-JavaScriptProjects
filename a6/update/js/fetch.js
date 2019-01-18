/*
  The front end logic for the tweet fetch app

  Bret McGee - December 6th 2018

  I, Bret McGee, 000207475 certify that this material is my original work.
  No other person's work has been used without due acknowledgement.
*/

/**
 * The tweets array
 */
var tweets = []; // initialize empty array

/**
 * The set interval function that fetches tweets from the database every
 * half second if there are changes
 * @param {function} the main function that houses all the front end logic for the fetch app, bringing data from the php backend
 */
setInterval(function(){
    // run the ajax call
            $.ajax({
               url:"fetch.php",
               method:"POST",
               dataType:"json",
               // run function when the ajax call is successfull
               success:function(data){
                   // loop for the length of the json objects passed from the php file
                for (var i = 0; i < data.length; i++){
                    // if the current tweet count is not the same as on the server, run the code (if there are updates)
                    if(tweets.length != data.length){
                        // clear the tweet canvas
                        $("#load_tweets").html("");
                        // push the json data into the tweet array
                        tweets[i] = data[i][0];
                        // loop 10 times
                        for (var j = 0; j < 10; j++){
                            // if tweets are empty null or undefined just display an empty p tag
                            if (tweets[j] == null || tweets[j] == undefined || tweets[j] == "")
                                $("#load_tweets").append("<p></p>");
                            else
                            // if content in the tweet then display
                            $("#load_tweets").append("<p>" + tweets[j] + "</p>");
                        }
                    }
                }
               }
            });
}, 500);