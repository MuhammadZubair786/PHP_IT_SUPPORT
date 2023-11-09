<?php
SESSION_start();
include 'config.php';

// Check if the user is logged in
if (isset($_SESSION["email"])) {
    $user_email = $_SESSION["email"];
    
    $sel = "SELECT * FROM users";
    $query = mysqli_query($conn, $sel);

    // Loop through the users' data
    while ($result = mysqli_fetch_assoc($query)) {
        if ($result['email'] === $user_email) {
            // Display the name for the matching email
            break; // Exit the loop after finding the matching email
        }
    }
} else {
    // Handle the case where the user is not logged in
    echo "User is not logged in.";
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Chat Application</title>
    <meta name="description" content="Chat Application" />
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div id="wrapper">
        <div id="menu">
            <p class="welcome">Welcome, <b><?php
                            // Display user image or default avatar
                            echo $result['name'];
                            ?></b></p>
<p class="logout"><a id="exit" href="index_chat.php">Exit Chat</a></p>
        </div>
        <div id="chatbox"></div>
        <form name="message" action="send_message.php" method="post"> <!-- Use the "post" method and specify the action attribute -->
    <input name="usermsg" type="text" id="usermsg" />
    <input name="submitmsg" type="submit" id="submitmsg" value="Send" />
</form>

    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>


<script type="text/javascript">
    $(document).ready(function () {
    // Function to fetch and display messages
    function fetchMessages() {
        $.ajax({
            url: 'fetch_messages.php',
            dataType: 'json',
            success: function (data) {
                // Clear the chatbox
                $('#chatbox').empty();

                // Loop through messages and display them
                for (var i = 0; i < data.length; i++) {
                    var message = data[i];
                    $('#chatbox').append('<p><strong>User ' + message.from_user_id + ':</strong> ' + message.chat_message + '</p>');
                }
            }
        });
    }

    // Call the fetchMessages function to initially populate the chatbox
    fetchMessages();

    // Handle form submission to send messages
    $('form[name="message"]').submit(function (e) {
        e.preventDefault();

        // Get the user's message
        var usermsg = $('#usermsg').val();

        // Send the message to the server
        $.ajax({
            type: 'POST',
            url: 'send_message.php',
            data: { usermsg: usermsg },
            success: function () {
                // Clear the input field
                $('#usermsg').val('');

                // Fetch and display messages to update the chatbox
                fetchMessages();
            }
        });
    });
});

success: function (data) {
    console.log(data); // Debugging line
    // Rest of your code to display messages
}

</script>

<style type="text/css">
    

    * {
    margin: 0;
    padding: 0;
  }
  
  body {
    margin: 20px auto;
    font-family: "Lato";
    font-weight: 300;
  }
  
  form {
    padding: 15px 25px;
    display: flex;
    gap: 10px;
    justify-content: center;
  }
  
  form label {
    font-size: 1.5rem;
    font-weight: bold;
  }
  
  input {
    font-family: "Lato";
  }
  
  a {
    color: #0000ff;
    text-decoration: none;
  }
  
  a:hover {
    text-decoration: underline;
  }
  
  #wrapper,
  #loginform {
    margin: 0 auto;
    padding-bottom: 25px;
    background: #eee;
    width: 600px;
    max-width: 100%;
    border: 2px solid #212121;
    border-radius: 4px;
  }
  
  #loginform {
    padding-top: 18px;
    text-align: center;
  }
  
  #loginform p {
    padding: 15px 25px;
    font-size: 1.4rem;
    font-weight: bold;
  }
  
  #chatbox {
    text-align: left;
    margin: 0 auto;
    margin-bottom: 25px;
    padding: 10px;
    background: #fff;
    height: 300px;
    width: 530px;
    border: 1px solid #a7a7a7;
    overflow: auto;
    border-radius: 4px;
    border-bottom: 4px solid #a7a7a7;
  }
  
  #usermsg {
    flex: 1;
    border-radius: 4px;
    border: 1px solid #ff9800;
  }
  
  #name {
    border-radius: 4px;
    border: 1px solid #ff9800;
    padding: 2px 8px;
  }
  
  #submitmsg,
  #enter{
    background: #ff9800;
    border: 2px solid #e65100;
    color: white;
    padding: 4px 10px;
    font-weight: bold;
    border-radius: 4px;
  }
  
  .error {
    color: #ff0000;
  }
  
  #menu {
    padding: 15px 25px;
    display: flex;
  }
  
  #menu p.welcome {
    flex: 1;
  }
  
  a#exit {
    color: white;
    background: #c62828;
    padding: 4px 8px;
    border-radius: 4px;
    font-weight: bold;
  }
  
  .msgln {
    margin: 0 0 5px 0;
  }
  
  .msgln span.left-info {
    color: orangered;
  }
  
  .msgln span.chat-time {
    color: #666;
    font-size: 60%;
    vertical-align: super;
  }
  
  .msgln b.user-name, .msgln b.user-name-left {
    font-weight: bold;
    background: #546e7a;
    color: white;
    padding: 2px 4px;
    font-size: 90%;
    border-radius: 4px;
    margin: 0 5px 0 0;
  }
  
  .msgln b.user-name-left {
    background: orangered;
  }
  



</style>



