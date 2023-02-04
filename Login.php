<?php
$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$gender = $_POST['gender'];

if (!empty($name) || !empty($username) || !empty($email) || !empty($phone) || !empty($password) || !empty($gender)) {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
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

            header('Location: /EZHOMECARE-LATEST-BUILD-FEB-2/index.html');
        } else {
            header('Location: /EZHOMECARE-LATEST-BUILD-FEB-2/index.html');
        }
        $stmt->close();
        $conn->close();
    }
} else {
    echo "All fields are required";
    die();
}
?>