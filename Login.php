<?php
$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$gender = $_POST['gender'];

if (!empty($name) || !empty($username) || !empty($email) || !empty($phone) || !empty($password) || !empty($gender)) {
    $host = "sql201.epizy.com";
    $dbUsername = "epiz_33500965";
    $dbPassword = "eEEUyD4vlXJZ9d";
    $dbname = "epiz_33500965_ezhomecare";

    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

    if (mysqli_connect_error()) {
        die('Connect Error(' . mysqli_connect_errno() . ')' . mysqli_connect_error());
    } else {
        $SELECT = "SELECT email From register Where email = ? Limit 1";
        $INSERT = "INSERT Into register (name, username, email, phone, password, gender) values (?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if ($rnum == 0) {
            $stmt->close();

            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("sssiss", $name, $username, $email, $phone, $password, $gender);
            $stmt->execute();

            header('Location: /index.html');
        } else {
            header('Location: /index.html');
        }
        $stmt->close();
        $conn->close();
    }
} else {
    echo "All fields are required";
    die();
}
?>