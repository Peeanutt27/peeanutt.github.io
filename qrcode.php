<!DOCTYPE html>
<html>
<head>
    <title>QR Code</title>
    <style>
         @import url('https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap');
         body {
  padding-left: 0px;
  padding-right: 0px;
  margin: auto;
  background-color: gray;
  overflow: hidden;
  
}
        
.navbar {
    width: 100%;
    background-color: #A9A9A9;
    height: 75px;
    display: flex;
    align-items: center;
  }

  .navbar img {
    height: auto; 
    width: 150px; 
    margin-right: 2px; 
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
        .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 100vh;
            padding: 0 20px; /* Added padding for better spacing */
        }
        .form-container {
            width: 30%;
            background-color: #31473A;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-right: 0px; /* Adjusted margin to create space */
            margin-left: 200px;
            height: 50%;
        }
        .form-container h2{
            display: flex;
            align-items: center;
            justify-content: center;
        } 
        .form-container input {
            width: calc(100% - 20px);
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        .button1,
        .button2,
        .button3 {
            display: flex;
            justify-content: center;
            margin-top: 40px;
        }
        .button1 button,
        .button3 button {
            font-family: Prata;
            font-weight: 600;
            font-size: 20px;
            color: white;
            background-color: black;
            padding: 10px 70px;
            border: none;
            box-shadow: none;
            border-radius: 50px;
            transition: 786ms;
            transform: translateY(0);
            display: flex;
            flex-direction: row;
            align-items: center;
            cursor: pointer;
            text-transform: uppercase;
            text-decoration:none;
        }
        .button2 button{
            font-family: Prata;
            font-weight: 600;
            font-size: 20px;
            color: white;
            background-color: black;
            padding: 10px 95px;
            border: none;
            box-shadow: none;
            border-radius: 50px;
            transition: 786ms;
            transform: translateY(0);
            display: flex;
            flex-direction: row;
            align-items: center;
            cursor: pointer;
            text-transform: uppercase;
            text-decoration:none;
        }
        .button1 button:hover,
        .button3 button:hover {
            padding: 10px 60px;
            transform: translateY(-0px);
            background-color: gray;
            color: black;
            border: none;
        }
        .button2 button:hover{
            padding: 10px 85px;
            transform: translateY(-0px);
            background-color: gray;
            color: black;
            border: none;
        }
        .box {
            width: 25%;
            height: 50%;
            background-color: #31473A;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-left: 40px;
            margin-right:200px ;
        }
        .box h2{
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 5px;
        }
        .box div{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .box img {
            max-width: 100%;
            height: auto;
            margin-left: 15px;
            margin-top: -10px;
        }
        .box img.no-display {
            display: none;
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
    <div class="container">
        <div class="form-container">
            <h2>User Information</h2>
            <input type="email" id="email" placeholder="Enter your Email" required>
            <div class="button1">
                <button onclick="generateQRCode()">Generate</button>          
            </div>
            <div class="button2">
                <button onclick="clearFields()">Clear</button> 
            </div>
            <div class="button3">
                <button onclick="downloadQRCode()">Download</button>
            </div>
        </div>
        <div class="box">
            <h2>QR CODE</h2>
            <div id="details-output"></div>
            <img id="qr-code-image" class="no-display" alt="QR code">
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
    <script>
       function generateQRCode() {
    const email = document.getElementById('email').value;
    
    if (!validateEmail(email)) {
        alert('Please enter a valid email address.');
        return;
    }
    //if valid email 
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../users/qrcode_process.php?email=' + email, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                const detailsOutput = document.getElementById('details-output');
                const details = "Name: ".concat(response.firstname, " ", response.lastname, "\n")
                    .concat("Email: ", response.email, "\n")
                    .concat("Password: ", response.passwd);

                detailsOutput.innerHTML = ''; 
                const options = {
                    value: details,
                    size: 350,
                    level: 'H'
                };
                const qrCode = new QRious(options);
                const qrCodeImage = qrCode.toDataURL();
                document.getElementById('qr-code-image').src = qrCodeImage;
                document.getElementById('qr-code-image').classList.remove('no-display'); 
            } else {
                alert('Email not found in the database.');
            }
        }
    };
    xhr.send();
}

        // sa clear fields
        function clearFields() {
            document.getElementById('email').value = '';
            document.getElementById('details-output').innerHTML = '';
            document.getElementById('qr-code-image').src = '';
            document.getElementById('qr-code-image').classList.add('no-display'); // Hide the QR code image
        }
        //download qr
        function downloadQRCode() {
            const qrCodeImage = document.getElementById('qr-code-image');
            const url = qrCodeImage.src.replace('data:application/octet-stream');
            const anchor = document.createElement('a');
            anchor.href = url;
            anchor.download = 'qr_code.png';
            anchor.click();
        }
        //validation if no extra character sa email
        function validateEmail(email) {
            const re = /\S+@\S+\.\S+/;
            return re.test(email);
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
