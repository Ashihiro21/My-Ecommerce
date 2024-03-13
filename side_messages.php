<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>

        #chat-container {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 300px;
            height: 400px;
            border: 1px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
            background-color: #fff;
        }

        #chat-header {
            color: #fff;
            padding: 10px;
            text-align: center;
            font-weight: bold;
        }

        #chat-messages {
            padding: 10px;
            height: 300px;
            overflow-y: auto;
        }

        #chat-input-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            border-top: 1px solid #ccc;
        }

        #chat-input {
            width: calc(80% - 10px);
            padding: 10px;
            border: none;
            outline: none;
        }

        #chat-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px;
            color: #fff;
            border: none;
            cursor: pointer;
            outline: none;
        }

        #submit-btn {
            margin-left: 10px;
            color: #fff;
            border: none;
            cursor: pointer;
            outline: none;
            position: relative;
        }

        #close-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            padding: 5px;
            background-color: transparent;
            color: #fff;
            border: none;
            cursor: pointer;
            outline: none;
        }
        
    </style>
</head>
<body>


<?php
// Database connection parameters
include "connectiion.php"; // Corrected typo in include statement


// Redirect to the login page if the user is not logged in
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

// Check if the POST form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit-btn"])) {
    // All required fields should be set
    if (empty($_POST["content"])) {
        echo 'Error: All fields are required.';
    } else {
        $content = trim($_POST["content"]);
        $content = htmlspecialchars($content);

        // SQL query with placeholders for both username and content
        $sql = "INSERT INTO `messages` (username, content) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);

        // Failed to prepare the SQL statement
        if ($stmt === false) {
            echo "Error: Cannot prepare statement: " . $conn->error;
        } else {
            // Bind parameters
            $stmt->bind_param('ss', $_SESSION['username'], $content);

            // Execute SQL
            if (!$stmt->execute()) {
                echo "Error: Failed to execute statement: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        }
    }
}

// Select messages where username matches the session username
$sessionUsername = $_SESSION['username'];
$selectSql = "SELECT * FROM `messages` WHERE `username` = ?";
$selectStmt = $conn->prepare($selectSql);

if ($selectStmt === false) {
    echo "Error: Cannot prepare SELECT statement: " . $conn->error;
} else {
    // Bind parameter for SELECT query
    $selectStmt->bind_param('s', $sessionUsername);

    // Execute SELECT query
    if ($selectStmt->execute()) {
        // Fetch results
        $result = $selectStmt->get_result();
        ?>
        <button id="chat-btn" class="btn btn-dark" aria-label="Open Chat">Open Chat</button>

        <form action="" method="post">
            <div id="chat-container" aria-describedby="chat-desc">
                <p id="chat-desc" style="display: none">Chat window for sending messages.</p>
                <button id="close-btn" aria-label="Close">Close</button>
                <div id="chat-header" class="bg-dark">Chat</div>
                <div id="chat-messages" aria-live="polite">
                    <?php
                    // Process each row as needed
                    while ($row = $result->fetch_assoc()) {
                        // Echo the content
                        echo '<div style="background-color: #343a40; color:white; border-radius: 20px; border: solid black 1px; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1); padding: 10px; margin-bottom: 10px; word-wrap: break-word; max-width: 150px;">' . htmlspecialchars($row['content']) . '</div>';


                    }
                    ?>
                </div>
                <div id="chat-input-container">
                    <label for="chat-input" style="display: none">Type your message:</label>
                    <input type="text" id="chat-input" name="content" placeholder="Type your message...">
                    <!-- Added hidden input for username -->
                    <input type="hidden" name="username" value="<?= htmlspecialchars($_SESSION['username']) ?>">
                    <button id="submit-btn" name="submit-btn" class="btn btn-dark" aria-label="Submit Chat Message">Submit</button>
                </div>
            </div>
        </form>
        <?php
    } else {
        echo "Error: Failed to execute SELECT statement: " . $selectStmt->error;
    }

    // Close the SELECT statement
    $selectStmt->close();
}

// Close the database connection
$conn->close();
?>


<script>
const chatButton = document.getElementById('chat-btn');
const chatContainer = document.getElementById('chat-container');
const chatInput = document.getElementById('chat-input');
const closeButton = document.getElementById('close-btn');

chatButton.addEventListener('click', () => {
    chatContainer.style.display = 'block';
    chatButton.setAttribute('aria-expanded', 'true');
    chatInput.focus();
});

closeButton.addEventListener('click', () => {
    chatContainer.style.display = 'none';
    chatButton.setAttribute('aria-expanded', 'false');
    chatButton.focus();
});
</script>

</body>
</html>
