<?php
require("connectiion.php");

$query = "SELECT email, message FROM chat_messages ORDER BY timestamp DESC LIMIT 20";
$result = $conn->query($query);

$messages = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = ['email' => $row['email'], 'message' => $row['message']];
    }
}

echo json_encode(['status' => 'success', 'messages' => $messages]);

$result->free_result();
$conn->close();
?>
