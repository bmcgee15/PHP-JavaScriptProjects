/*
  The front end logic for the tweet writter app

  Bret McGee - December 6th 2018

  I, Bret McGee, 000207475 certify that this material is my original work.
  No other person's work has been used without due acknowledgement.
*/

/**
 * The ready event handler where all the insert logic lives
 * @param {function} the main function that runs when the page is ready
 */
$(document).ready(function(){
    /**
     * The tweet button click event handler
     * @param {function} the ajax passing of the tweet to the php back end
     */
    $("#btn_tweet").click(function(){
        // Pulling the value of the index.html tweet box and storing it
        var tweet_txt = $("#tweet").val();
        // if the tweet is not empty, run the ajax call
        if($.trim(tweet_txt) != ""){
            $.ajax({
               url:"insert.php",
               method:"POST",
               data:{tweet:tweet_txt},
               dataType:"text",
               // run after the ajax call is successfull
               success:function(data){
                   // clear the tweet field
                   $("#tweet").val("");
               }
            });
        }
    });
    /**
     * The generate ten button click event handler
     * @param {funtion} the ajax passing of 10 randomly generated tweets the the php back end
     */
    $("#gen_ten").click(function(){
        // loop ten times
        for (var i = 0; i < 10; i++){
            // randomly generate the tweet
            var tweet_txt = `Randomly Generated Number - ${Math.floor((Math.random() * 1000) + 1)}`;
            // run the ajax call
            $.ajax({
               url:"insert.php",
               method:"POST",
               data:{tweet:tweet_txt},
               dataType:"text",
               // run after the ajax call is successfull
               success:function(data){
                   // clear the tweet field
                   $("#tweet").val("");
               }
            });
        }
        // alert the user that the 10 random tweets have been generated
        alert("10 Random Tweets Have Been Generated");
    });
});