<?php
$username = $_POST['username'];
$password = $_POST['password'];

$con = new mysqli("sql201.epizy.com", "epiz_33500965", "eEEUyD4vlXJZ9d", "epiz_33500965_ezhomecare");
if ($con->connect_error) {
    die("Failed to connect: " . $con->connect_error);
} else {
    $stmt = $con->prepare("SELECT * from register where username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt_result = $stmt->get_result();
    if ($stmt_result->num_rows > 0) {
        $data = $stmt_result->fetch_assoc();
        if ($data['password'] === $password) {
            header('Location: /EZHOMECARE-LATEST-BUILD-FEB-2/Home.html');
        } else {
            echo "<h2>Invalid Email or password. click the back button</h2>";
        }
    } else {
        echo "<h2>Invalid Email or password.click the back button</h2>";
    }
}
?>