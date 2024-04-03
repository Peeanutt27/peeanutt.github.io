<?php
session_start(); // Start the session

// Check if login success session variable is set to true and display the login success alert
if (isset($_SESSION['login_success']) && $_SESSION['login_success'] === true) {
    echo "<script>alert('Login successful!');</script>";

    // Unset the session variable to prevent showing the alert again on page reload
    unset($_SESSION['login_success']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="speak_style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <title>Offline Text To Speech</title>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@350;400&display=swap");
    
    @import url('https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap');

:root {
  --body-font-size: 18px;
  --body-font-weight: 300;
  --header-font-weight: 500;

  --main-lateral-padding: 17px;

  --footer-color: #bbbbbb;
  --link-color: #248ef1;
  --link-underline-color: #248ef1e5;

  --small-link-color: #3f3f3f;
}


* {
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
}

body {
  padding-left: 0px;
  padding-right: 0px;
  margin: auto;
  background-color: gray;
  
}

.main {
  margin: auto;
  width: 100%;
}

.navbar {
    width: 100%;
    background-color: #A9A9A9;
    height: 75px;
    display: flex;
    align-items: center;
  }

  .navbar img {
    height: auto; /* Set the height of the image to 100% of the navbar's height */
    width: 150px; /* Allow the width to adjust proportionally */
    margin-right: 2px; /* Optional: Add spacing between logo and navigation links */
  }

  .nav {
    display: flex;
    align-items: center;
    justify-content: space-evenly;
    padding-left: 60%;
  }

  .nav a {
    color: white;
    text-decoration: none;
    margin-right: 35px; 
  }

  div.navbar div.nav a {
    list-style: none;
    text-decoration: none;
    color: #31473A;
    font-size: larger;
    font-family: "Roboto Slab", serif;
    font-optical-sizing: auto;
    font-weight: 800;
    margin-top: 3px;
    font-style: normal;
    position: relative;
    overflow: hidden; 
  }

  div.navbar div.nav a::after {
    content: "";
    position: absolute;
    width: 0; /* Initially, the line is hidden */
    height: 3px;
    bottom: 0px;
    left: 0;
    background-color: #31473A; /* Color of the line */
    transition: width 0.3s ease; /* Transition effect for width change */
  }

  div.navbar div.nav a:hover::after {
    width: 100%; /* Expand the width to 100% on hover */
  }

.padding {
  padding: 12px;
}

.padding-semi-large {
  padding: 14px 0px;
}

h2 {
  font-size: 34px;
  font-weight: var(--header-font-weight);
  text-align: left;
  line-height: 125%;
  margin: auto;
}

p {
  font-size: 18px;
  line-height: 160%;
  margin: auto;
  font-weight: var(--body-font-weight);
}

#indicators {
  display: flex;
  flex-direction: row;
  padding-top: 20px;
  align-items: center;
}

#repo-links {
  display: flex;
  flex-direction: row;
  align-items: center;
}

.indicator-separator {
  padding-left: 7px;
  padding-right: 7px;
}

.indicator {
  font-size: 16px;
  color: #00000059;
  font-weight: 400;
  
}


#indicators a {
  text-underline-offset: 1px;
  transition: 0.2s;
}

#indicators a:hover {
  color: var(--small-link-color);
}

.icon-link {
  width: 16px;
  padding-left: 7px;
}

.icon-link-small {
  width: 14px;
  padding-left: 7px;
}

.link {
  color: var(--link-color);
  text-decoration: none;
  padding-bottom: 3px;

  background: linear-gradient(to right, transparent, transparent), linear-gradient(to right, var(--link-underline-color), var(--link-underline-color));
  background-size: 100% 3px, 0 3px;
  background-position: 100% 100%, 0 100%;
  background-repeat: no-repeat;
  transition: background-size 500ms;
}

.link:hover {
  background-size: 0 3px, 100% 3px;
}

.button-standard {
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;

  padding: 10px;
  padding-left: 11px;
  padding-right: 11px;
  background-color:#31473A;

  border-color: rgba(0, 0, 0, 0.14);
  border-width: 1px;
  border-style: solid;
  border-radius: 6px;
  text-decoration: none;
  color: white;

  box-sizing: border-box;
  box-shadow: 0px 3px 11px rgba(0, 0, 0, 0.07);
  font-size: 16px;
  font-weight: var(--header-font-weight);

  transition: all 0.15s ease;
}

.button-standard:visited {
  color: inherit;
}

.button-standard:hover {
  transform: scale(1.08);
  background-color: rgba(255, 255, 255, 0.7);
  color:#31473A;
}

#section-1 {
  padding-top: 50px;
}

#app-store-buttons {
  display: flex;
  flex-direction: row;
  justify-content: center;
}

#app-store-buttons p {
  font-size: 24px;
  opacity: 0.1;
  line-height: 0%;
  padding: 15px;
}

.section-alignment {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}

#landing-header {
  text-align: center;
  padding-top: 7px;
}

.main {
  max-width: 750px;
}

/* Mobile Only */
@media only screen and (max-width: 425px) {
  body {
    background-size: 1200%;
  }

  h2 {
    font-size: 36px;
  }

  p {
    font-size: 20px;
  }

  #app-store-buttons {
    display: contents;
  }
}

/* Mobile Design - Tablet */
@media only screen and (max-width: 999px) {
  body {
    background-size: 1200%;
  }

  /* Make sure to show the links once we're on a desktop */

  /* Make buttons stack instead */
/**/

  #app-store-buttons p {
    padding: 8px;
    visibility: hidden;
  }
}

/* Desktop Design */
@media only screen and (min-width: 1000px) {
  body {
    background-size: 700%;
  }

  /* Make sure to show the links once we're on a desktop */

  /* Push out the lists for better visibility */
}

textarea {
  padding: 10px;
  border-radius: 10px;
  background-color: white;
  width: 80%;
  font-size: 16px;
  margin-top: 8px;
}

.optionsDiv {
  position: relative;
  /*Don't really need this just for demo styling*/

  float: left;
  min-width: 200px;
  margin-top: 20px;
  margin-left: 10px;
  margin-right: 10px;
}

.optionsDiv:after {
  content: '<>';
  font: 17px "Consolas", monospace;
  color: black;
  -webkit-transform: rotate(90deg);
  -moz-transform: rotate(90deg);
  -ms-transform: rotate(90deg);
  transform: rotate(90deg);
  right: 11px;
  top: 14px;
  padding: 0 0 2px;
  border-bottom: 1px solid #999;
  position: absolute;
  pointer-events: none;
}

.optionsDiv select {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  display: block;
  width: 100%;
  max-width: 320px;
  height: 40px;
  float: right;
  margin: 5px 0px;
  padding: 0px 24px;
  font-size: 16px;
  line-height: 1.75;
  color: white;
  background-color: #31473A;
  background-image: none;
  border: 1px solid #cccccc;
  -ms-word-break: normal;
  word-break: normal;
  border-radius: 6px;
}

#dropdowns {
  margin: 10px;
}

/* This it the input field when it does not have focus */
textarea[type=text] {
  outline: none;
  box-shadow: none;
  border: solid 1px rgb(91, 91, 91);
}

/* This is for the highlighted color when the input field is in focus */
textarea[type=text]:focus {
  outline: none;
  box-shadow: none;
  border: solid 1px rgb(125, 125, 125);
}

/* This it the input field when it does not have focus */
select {
  outline: none;
  box-shadow: none;
  border: solid 1px rgb(91, 91, 91);
}

/* This is for the highlighted color when the input field is in focus */
select:focus {
  outline: none;
  box-shadow: none;
  border: solid 1px rgb(125, 125, 125);
}

::-webkit-scrollbar {
  background-color: rgba(255, 255, 255, 0.4);
  width: 10px !important;
  border-radius: 10px;
}


  </style>
</head>

<body>
  <div class="navbar">
    <img src="..\assets\images\tts.png" alt="Logo">
    <div class="nav">
      <a href="../users/qrcode.php">QR Code</a>
      <a href="../users/view.php">Account</a>
      <a href="../users/tts.php">TTS</a>
      <a href="../users/Login.php" id="logout-link" onclick="confirmLogout()">Log Out</a>

    </div>
  </div>

      <div class="main">

        <!--   Section 1  -->
        <div id="section-1" class="section-alignment">

          <!-- Top content -->
          <h2 id="landing-header">Text To Speech</h2>
          <div class="padding-semi-large"></div>

          <div class="padding"></div>

          <textarea type="text" id="textInput" rows="8" placeholder="Enter text here to speak it"></textarea>

          <div class="padding-semi-large"></div>


          <!-- -------------------------- App store buttons -------------------------- -->
          <div id="app-store-buttons">
            <button id="speakTextButton" class="button-standard" onclick="speakInputText()">Speak Text<img class="icon-link"
                src="../icons/speakIcon.svg"></button>

            <p>|</p>

            <button id="pauseButton" class="button-standard" onclick="pauseSpeech()">Pause<img class="icon-link-small"
                src="../icons/pauseIcon.svg"></button>

            <p>|</p>

            <button class="button-standard" onclick="stopSpeech()">Stop<img class="icon-link-small"
                src="../icons/stopIcon.svg"></button>

          </div>

          <div id="dropdowns">
            <div class="optionsDiv">
              <select name="voiceOptions" id="voiceOptions" onchange="changeVoice(this.value)">
                <option value="voice1">Daniel's voice</option>
                <option value="voice7">Samantha's voice</option>
                <option value="voice3">Alex's voice</option>
                <option value="voice6">Olivia's voice</option>
                <option value="voice2">Raj's voice</option>
                <option value="voice4">Fiona's voice</option>
                <option value="voice5">Fred's voice</option>
                <option value="voice8">Tessa's voice</option>
                <option value="voice9">Victoria's voice</option>
              </select>
            </div>

            <div class="optionsDiv">
              <select name="speedOptions" id="speedOptions" onchange="changeVoiceSpeed(this.value)">
                <option value="speed0.5">0.5x speed</option>
                <option value="speed0.75">0.75x speed</option>
                <option value="speed1" selected>1x speed</option>
                <option value="speed1.25">1.25x speed</option>
                <option value="speed1.5">1.5x speed</option>
                <option value="speed1.75">1.75x speed</option>
                <option value="speed2">2x speed</option>
              </select>
            </div>
          </div>

          <div id="indicators">
              <p>All Right Reserved.</p>
          </div>
        </div>
      
      </div>


  <script>
    // This is so that if speech is still playing from previous session, it stops on page load
    speechSynthesis.cancel();

    var isSpeaking = false;

   // Initialize the speech synthesis
   var speech = new SpeechSynthesisUtterance();
   speech.rate = 1;
   speech.pitch = 1;
   speech.volume = 1;
   speech.voice = speechSynthesis.getVoices()[0];

   function speakInputText() {
    isSpeaking = true;

    speech.text = document.getElementById("textInput").value;
    speechSynthesis.speak(speech);
    }

   function pauseSpeech() {
    if (isSpeaking) {
    isSpeaking = false;
    speechSynthesis.pause();
    document.getElementById(
      "pauseButton"
    ).innerHTML = `Resume<img class="icon-link-small"
    src="../icons/resumeIcon.svg">`;
    } else {
    isSpeaking = true;
    speechSynthesis.resume();
    document.getElementById(
      "pauseButton"
    ).innerHTML = `Pause<img class="icon-link-small"
    src="../icons/pauseIcon.svg">`;
    }
  }

   function stopSpeech() {  
    isSpeaking = false;
    speechSynthesis.cancel();
    }

   function changeVoice(voice) {
    if (voice == "voice1") {
    // console.log((speech.voice = speechSynthesis.getVoices()[8]));
    speech.voice = speechSynthesis.getVoices()[8];
    } else if (voice == "voice2") {
    // console.log((speech.voice = speechSynthesis.getVoices()[0]));
    speech.voice = speechSynthesis.getVoices()[0];
    } else if (voice == "voice3") {
    // console.log((speech.voice = speechSynthesis.getVoices()[1]));
    speech.voice = speechSynthesis.getVoices()[1];
    } else if (voice == "voice4") {
    // console.log((speech.voice = speechSynthesis.getVoices()[11]));
    speech.voice = speechSynthesis.getVoices()[11];
    } else if (voice == "voice5") {
    // console.log((speech.voice = speechSynthesis.getVoices()[12]));
    speech.voice = speechSynthesis.getVoices()[12];
    } else if (voice == "voice6") {
    // console.log((speech.voice = speechSynthesis.getVoices()[18]));
    speech.voice = speechSynthesis.getVoices()[18];
    } else if (voice == "voice7") {
    // console.log((speech.voice = speechSynthesis.getVoices()[33]));
    speech.voice = speechSynthesis.getVoices()[33];
    } else if (voice == "voice8") {
    // console.log((speech.voice = speechSynthesis.getVoices()[37]));
    speech.voice = speechSynthesis.getVoices()[37];
    } else if (voice == "voice9") {
    // console.log((speech.voice = speechSynthesis.getVoices()[41]));
    speech.voice = speechSynthesis.getVoices()[41];
   }
  }

  function changeVoiceSpeed(voiceSpeed) {
    if (voiceSpeed == "speed2") {
      speech.rate = 2;
    } else if (voiceSpeed == "speed1.75") {
      speech.rate = 1.75;
    } else if (voiceSpeed == "speed1.5") {
      speech.rate = 1.5;
    } else if (voiceSpeed == "speed1.25") {
      speech.rate = 1.25;
    } else if (voiceSpeed == "speed1") {
      speech.rate = 1;
    } else if (voiceSpeed == "speed0.75") {
      speech.rate = 0.75;
   } 
  }
  
  function confirmLogout() {
    if (confirm("Are you sure you want to log out?")) {
        // Set the logout success session variable
        <?php $_SESSION['logout_success'] = true; ?>

        // Redirect to the login page after logout
        window.location.href = "../users/Login.php";
    } else {
        // Cancel logout action
        event.preventDefault(); // Prevents the default action of the link
    }
}



  </script>

  
</body>

</html> 

