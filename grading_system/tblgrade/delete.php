<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "grading_system";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $gradeid = $_GET['id'];

    $sql = "DELETE FROM tblgrade WHERE GRADEID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $gradeid);
    echo $sql;

    echo '<script>
            var confirmation = confirm("Are you sure you want to delete this?");
            if (confirmation) {
                window.location.href = "delete.php";
            } else {
                window.location.href = "index.php";
            }
          </script>';
}

$conn->close();
?>
