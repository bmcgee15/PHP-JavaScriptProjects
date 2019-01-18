/*
  The logic for the Space themed quiz that ends with a "Big Bang"
  

  Bret McGee - December 1st 2018

  I, Bret McGee, 000207475 certify that this material is my original work.
  No other person's work has been used without due acknowledgement.
*/

/**
 * The Load Even Handler where all the logical code lives
 * @param {event} the load event
 * @param {function} the main program function
 */
window.addEventListener("load", function() {
  /**
   * The current round of the quiz
   * @type Number
   */
  var round = 1;
  /**
   *The current users score
   @type Number
   */
  var score = 0;
  /**
   *The current color of the users score
   @type Text
   */
  var color = "green";
  /**
   *The current message
   @type Text
   */
  var message = "";
  /**
   *The selector shortcut for the begin button
   @type Selector
   */
  var start = document.getElementById("start");
  /**
   *The selector shortcut for the submit answer button
   @type Selector
   */
  var verify = document.getElementById("verifyResult");
  /**
   *The selector shortcut for the next question button
   @type Text
   */
  var next = document.getElementById("nextQuestion");
  /**
   * The array of questions to keep code DRY
   * @type Text Array
   */
  var questions = [
    "",
    "<h1>Approximately how many stars are in our Milky Way Galaxy?</h1>",
    "<h1>What is the closest planet to our sun out of Mercury, Venus or Mars?</h1>",
    "<h1> How many planets are there in our solar system?</h1>",
    "<h1>What is the name of the next closest star to us out of the Centauri Group?</h1>",
    "<h1>What is the state of earths core?</h1>"
  ];
  /**
   * The array of forms to keep code DRY
   * @type Text Array
   */
  var forms = [
    "",
    `
  <form id="quizForm">
  <input type="radio" name="stars" value="100 Million" checked>     100 Million<br>
  <input type="radio" name="stars" value="100 Billion">      100 Billion<br>
  <input type="radio" name="stars" value="250 Billion">      250 Billion<br>
  </form>
    `,
    `
  <form id="quizForm">
  <input type="text" name="closestPlanet"><br><br>
  </form>
    `,
    `
  <form id="quizForm">
  <input type="number" name="quantity" onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"min="1" max="10"><br><br>
  </form>
    `,
    `
  <form id="quizForm">
  <input type="text" name="closestStar"><br><br>
  </form>
    `,
    `
  <form id="quizForm">
  <input type="radio" name="cores" value="1" checked>     Outer Core: Solid | Inner Core: Liquid<br>
  <input type="radio" name="cores" value="2">      Outer Core: Liquid | Inner Core: Solid<br>
  <input type="radio" name="cores" value="3">      Outer Core: Solid | Inner Core: Solid<br>
  </form>
    `
  ];
  /**
   * The array of inputs to keep code DRY
   * @type Text Array
   */
  var inputs = [
    "",
    `input[name="stars"]:checked`,
    `input[name="closestPlanet"]`,
    `input[name="quantity"]`,
    `input[name="closestStar"]`,
    `input[name="cores"]:checked`
  ];
  /**
   * The array of answers to keep code DRY
   * @type Text Array
   */
  var answers = ["", "250 Billion", "Mercury", "8", "Proxima Centauri", "2"];

  /**
   * The on click event handler for the begin button
   * This function sets the inner html to the propper
   * question, shows the submit answer button, displays
   * the appropriate form, and updates the round.
   */
  start.onclick = function() {
    var question = document.getElementById("question");
    question.innerHTML = `${questions[round]}`;
    verify.style.display = "block";
    document.getElementById("formDiv").innerHTML = forms[round];
    document.getElementById("score").innerHTML = `Round ${round}`;
  };
  /**
   * The on click event handler for the submit answer button
   * This function checks if the right answer was chosed, shows
   * the current score, increments the round, clears the form,
   * changes the score color based on score, updates the message variable,
   * hides the submit answer button, and shows the next question button.
   * If the quiz is over it displays the appropriate messages, and runs the
   * end animation functions.
   */
  verify.onclick = function() {
    // if answer if correct
    if (document.querySelector(inputs[round]).value == answers[round]) {
      score++;
      document.getElementById(
        "score"
      ).innerHTML = `Round ${round}<br>Score:<font color="${color}">${score}/${round}</font>`;
    } else
      document.getElementById(
        "score"
      ).innerHTML = `Round ${round}<br>Score:<font color="${color}">${score}/${round}</font>`;

    round++; // increment round

    if (round <= 6) {
      var form = `
    <form id="quizForm">
    </form>
    `;
      verify.style.display = "none";
      next.style.display = "block";
      if (round - score < 2) {
        color = "green";
        message = "Amazing Job!";
      }
      if (round - score == 2 || round - score == 3) {
        color = "yellow";
        message = "Decent Job";
      }
      if (round - score > 3) {
        color = "red";
        message = "Better luck next time -_-";
      }
    }
    if (round == 6) {
      next.style.display = "none";
      verify.style.display = "none";
      question.innerHTML = message;
      document.getElementById("formDiv").innerHTML = "";
      // Start the final animations
      startCountDown();
      setTimeout(startAnimation, 4000);
    }
  };

  /**
   * The on click event handler for the next question button
   * This function sets the inner html to the propper
   * question, shows the submit answer button, hides the next
   * question button, displays the appropriate form, and updates the round.
   */
  next.onclick = function() {
    next.style.display = "none";
    verify.style.display = "block";
    var question = document.getElementById("question");
    question.innerHTML = `${questions[round]}`;
    document.getElementById("formDiv").innerHTML = forms[round];
    document.getElementById("score").innerHTML = `Round ${round}`;
  };

  /**
   * The radius of the circle
   * @type Number
   */
  var radius = 50;
  /**
   * The x & y coordinates of the circle
   * @type Number
   */
  var x = 0,
    y = 50; // location
  /**
   * holds the id of the timer
   * @type Function
   */
  var timerId;
  /**
   * unused color values
   * @type Number
   */
  var color1 = 0;
  /**
   * unused color values
   * @type Number
   */
  var color2 = 0;
  /**
   * unused color values
   * @type Number
   */
  var color3 = 0;
  /**
   * holds the id of the countdown
   * @type Function
   */
  var countDown;
  /**
   * The counter for the countdown
   * @type Number
   */
  var counter = 3;

  /**
   * The function that starts the count down timer to self destruct
   */
  function startCountDown() {
    countDown = setInterval(updateCountdown, 1000);
  }

  /**
   * The function that updates the display of the countdown timer called every second
   */
  function updateCountdown() {
    if (counter >= 1) {
      document.getElementById(
        "score"
      ).innerHTML = `Warning Self Destructing in: ${counter}`;
      counter--;
    } else {
      document.getElementById("score").innerHTML = `AHHHHHHHHHHH`;
    }
  }

  /**
   * starts the animation
   * */
  function startAnimation() {
    timerId = setInterval(updateAnimation, 10);
  }

  /**
   * stops the animation
   */
  function stopAnimation() {
    clearTimeout(timerId);
  }

  /**
   * This method starts the explosion animations and is called every 10 miliseconds
   */
  function updateAnimation() {
    // Update the animation variables for ball 1
    x1 = Math.floor(Math.random() * 1000 + 1);
    y1 = Math.floor(Math.random() * 1000 + 1);
    radius1 = Math.floor(Math.random() * 150 + 50);
    // vv would be used for randomly generated colors
    // color11 = Math.floor(Math.random() * 256);
    // color21 = Math.floor(Math.random() * 256);
    // color31 = Math.floor(Math.random() * 256);

    // Change some CSS properties
    var e = document.getElementById("movingBall1");
    e.style.left = x1 + "px";
    e.style.top = y1 + "px";
    e.style.width = radius1 * 2 + "px";
    e.style.height = radius1 * 2 + "px";
    e.style.backgroundColor = "rgb(255,128,0)";

    // Update the animation variables for ball 2
    x2 = Math.floor(Math.random() * 1000 + 1);
    y2 = Math.floor(Math.random() * 1000 + 1);
    radius2 = Math.floor(Math.random() * 150 + 50);
    // vv would be used for randomly generated colors
    // color12 = Math.floor(Math.random() * 256);
    // color22 = Math.floor(Math.random() * 256);
    // color32 = Math.floor(Math.random() * 256);

    // 2. Change some CSS properties for ball 2
    var f = document.getElementById("movingBall2");
    f.style.left = x2 + "px";
    f.style.top = y2 + "px";
    f.style.width = radius2 * 2 + "px";
    f.style.height = radius2 * 2 + "px";
    f.style.backgroundColor = "rgb(255,0,0)";

    // 1. Update the animation variables for ball 3
    x3 = Math.floor(Math.random() * 1000 + 1);
    y3 = Math.floor(Math.random() * 1000 + 1);
    radius3 = Math.floor(Math.random() * 150 + 50);
    // vv would be used for randomly generated colors
    // color13 = Math.floor(Math.random() * 256);
    // color23 = Math.floor(Math.random() * 256);
    // color33 = Math.floor(Math.random() * 256);

    // 2. Change some CSS properties for ball 3
    var g = document.getElementById("movingBall3");
    g.style.left = x3 + "px";
    g.style.top = y3 + "px";
    g.style.width = radius3 * 2 + "px";
    g.style.height = radius3 * 2 + "px";
    g.style.backgroundColor = "rgb(255,255,0)";
  }
});
