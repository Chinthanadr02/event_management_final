
<?php
header("Content-Type: application/json");
$conn = new mysqli("localhost", "root", "", "event_management");

if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed"]));
}

$method = $_SERVER["REQUEST_METHOD"];

if ($method === "GET") {
    $result = $conn->query("SELECT * FROM attendees");
    $attendees = [];
    while ($row = $result->fetch_assoc()) {
        $attendees[] = $row;
    }
    echo json_encode($attendees);
} elseif ($method === "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];

    $stmt = $conn->prepare("INSERT INTO attendees (name, email) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $email);
    $stmt->execute();

    echo json_encode(["success" => true]);
} elseif ($method === "DELETE") {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $id = $_DELETE["id"];

    $stmt = $conn->prepare("DELETE FROM attendees WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo json_encode(["success" => true]);
} else {
    echo json_encode(["error" => "Invalid request method"]);
}

$conn->close();
?>
