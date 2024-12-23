
<?php
session_start();
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "event_management");
if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed"]));
}

$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $username = $data['username'];
    $password = $data['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            echo json_encode(["success" => true, "message" => "Login successful"]);
        } else {
            echo json_encode(["error" => "Invalid password"]);
        }
    } else {
        echo json_encode(["error" => "Invalid username"]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "Invalid request method"]);
}

$conn->close();
?>
