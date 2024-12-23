
<?php
header("Content-Type: application/json");
$conn = new mysqli("localhost", "root", "", "event_management");

if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed"]));
}

$method = $_SERVER["REQUEST_METHOD"];

if ($method === "GET") {
    $result = $conn->query("SELECT * FROM events");
    $events = [];
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
    echo json_encode($events);
} elseif ($method === "POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $location = $_POST["location"];
    $date = $_POST["date"];

    $stmt = $conn->prepare("INSERT INTO events (name, description, location, date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $description, $location, $date);
    $stmt->execute();

    echo json_encode(["success" => true]);
} elseif ($method === "DELETE") {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $id = $_DELETE["id"];

    $stmt = $conn->prepare("DELETE FROM events WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo json_encode(["success" => true]);
} else {
    echo json_encode(["error" => "Invalid request method"]);
}

$conn->close();
?>
