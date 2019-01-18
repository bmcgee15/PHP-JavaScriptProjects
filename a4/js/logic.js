/*
 * Script for the index.html
 * the logic behind the dice game
 *
 * Bret McGee - November 21st 2018
 *
 * I, Bret McGee, 000207475 certify that this material is my original work.
 * No other person's work has been used without due acknowledgement.
 */

/**
 * Scores - The players scores
 * @type Number
 * roundScore - The players current round score
 * @type Number
 * activePlayer - The current active player (0 or 1)
 * @type Number
 * gamePlaying - The state of the game
 * @type Boolean
 * winningScore - The number a player must reach to win
 * @type Number
 */
var scores, roundScore, activePlayer, gamePlaying, winningScore;

// call the initializer function
init();

/**
 * The roll dice button click event handler
 * @param {click} {function} Click event triggers annonamous function
 */
document.querySelector(".btn-roll").addEventListener("click", function() {
  // if the gamePlaying state is true
  if (gamePlaying) {
    // calculates the random dice rolls and stores them in the dice variables
    var dice1 = Math.floor(Math.random() * 6) + 1;
    var dice2 = Math.floor(Math.random() * 6) + 1;

    // setsup the appropriate dice pictures based on what was rolled
    document.getElementById("dice-1").style.display = "block";
    document.getElementById("dice-2").style.display = "block";
    document.getElementById("dice-1").src = "dice-" + dice1 + ".png";
    document.getElementById("dice-2").src = "dice-" + dice2 + ".png";

    // if the two dice add up to the players current round number enter if block
    if (dice1 + dice2 == scores[activePlayer]) {
      // Calculate the current round score
      roundScore = dice1 + dice2;
      // Disable the roll dice button to enforce user to click next turn button (this allowed current roll score and dice images to be shown before the next players turn)
      document.querySelector(".btn-roll").disabled = true;
      // Update the current round score in the UI
      document.querySelector(
        "#current-" + activePlayer
      ).textContent = roundScore;
      // increment the players current round
      scores[activePlayer]++;

      // Update the UI for the incremented player current round
      document.querySelector("#score-" + activePlayer).textContent =
        scores[activePlayer];

      // enable the roll dice button
      document.querySelector(".btn-roll").disabled = true;

      // Check if player won the game
      if (scores[activePlayer] == winningScore) {
        // set the name in the UI to Winner!
        document.querySelector("#name-" + activePlayer).textContent = "Winner!";
        // remove dice 1 from the UI
        document.getElementById("dice-1").style.display = "none";
        // remove dice 2 from the UI
        document.getElementById("dice-2").style.display = "none";
        // change the player style to winner
        document
          .querySelector(".player-" + activePlayer + "-panel")
          .classList.add("winner");
        // remove the active styleing from the winner
        document
          .querySelector(".player-" + activePlayer + "-panel")
          .classList.remove("active");
        // turn the game playing boolean flag to false
        gamePlaying = false;
      }
      // if roll did not equal the current players round
    } else {
      // add both dice to the current round score for the player
      roundScore = dice1 + dice2;
      // disable the roll dice button to enforce user to click next turn
      document.querySelector(".btn-roll").disabled = true;
      // update the UI of the current round score
      document.querySelector(
        "#current-" + activePlayer
      ).textContent = roundScore;
    }
    // add both dice to the round score
    roundScore = dice1 + dice2;
  }
});

/**
 * The next turn button click event handler
 * @param {click} {function} Click event triggers annonamous function
 */
document.querySelector(".btn-next").addEventListener("click", function() {
  if (gamePlaying) {
    // enable the roll dice button
    document.querySelector(".btn-roll").disabled = false;
    // call next player method
    nextPlayer();
  }
});

/**
 * switches the active player
 */
function nextPlayer() {
  // switches the active users
  activePlayer === 0 ? (activePlayer = 1) : (activePlayer = 0);
  // clears the round score
  roundScore = 0;

  // resets the current scores
  document.getElementById("current-0").textContent = "0";
  document.getElementById("current-1").textContent = "0";

  // toggles the active user
  document.querySelector(".player-0-panel").classList.toggle("active");
  document.querySelector(".player-1-panel").classList.toggle("active");

  // clear the dice
  document.getElementById("dice-1").style.display = "none";
  document.getElementById("dice-2").style.display = "none";
}

/**
 * The new game button click event handler
 * @param {click} {function} Click event triggers init function
 */
document.querySelector(".btn-new").addEventListener("click", init);

/**
 * The initializer function used when first starting game or by clicking new game button
 */
function init() {
  // initialize scores
  scores = [2, 2];
  // initialize active player
  activePlayer = 0;
  // initialize round score
  roundScore = 0;
  // initialize game playing boolean flag
  gamePlaying = true;
  // initialize winning score
  winningScore = 7;

  // clear the dice
  document.getElementById("dice-1").style.display = "none";
  document.getElementById("dice-2").style.display = "none";

  // update the GUI for score, current, name, and player panels
  document.getElementById("score-0").textContent = "2";
  document.getElementById("score-1").textContent = "2";
  document.getElementById("current-0").textContent = "0";
  document.getElementById("current-1").textContent = "0";
  document.getElementById("name-0").textContent = "Player 1";
  document.getElementById("name-1").textContent = "Player 2";
  document.querySelector(".player-0-panel").classList.remove("winner");
  document.querySelector(".player-1-panel").classList.remove("winner");
  document.querySelector(".player-0-panel").classList.remove("active");
  document.querySelector(".player-1-panel").classList.remove("active");
  document.querySelector(".player-0-panel").classList.add("active");
}
