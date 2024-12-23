
<?php
header("Content-Type: application/json");
$conn = new mysqli("localhost", "root", "", "event_management");

if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed"]));
}

$method = $_SERVER["REQUEST_METHOD"];

if ($method === "GET") {
    $event_id = $_GET["event_id"];
    $stmt = $conn->prepare("SELECT * FROM tasks WHERE event_id = ?");
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $tasks = [];
    while ($row = $result->fetch_assoc()) {
        $tasks[] = $row;
    }
    echo json_encode($tasks);
} elseif ($method === "POST") {
    $event_id = $_POST["event_id"];
    $name = $_POST["name"];
    $deadline = $_POST["deadline"];
    $status = $_POST["status"];

    $stmt = $conn->prepare("INSERT INTO tasks (event_id, name, deadline, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $event_id, $name, $deadline, $status);
    $stmt->execute();

    echo json_encode(["success" => true]);
} elseif ($method === "PUT") {
    parse_str(file_get_contents("php://input"), $_PUT);
    $id = $_PUT["id"];
    $status = $_PUT["status"];

    $stmt = $conn->prepare("UPDATE tasks SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();

    echo json_encode(["success" => true]);
} else {
    echo json_encode(["error" => "Invalid request method"]);
}

$conn->close();
?>
