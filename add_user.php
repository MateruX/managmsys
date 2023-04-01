<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = new mysqli("localhost", "root", "", "usermanag");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_POST["username"];
    $password = $_POST["password"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $date_of_birth = $_POST["date_of_birth"];
    $groups = $_POST["groups"];

    $errors = array();

    if (empty($username)) {
        $errors[] = "Username is required";
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    }

    if (empty($first_name)) {
        $errors[] = "First name is required";
    }

    if (empty($last_name)) {
        $errors[] = "Last name is required";
    }

    if (empty($date_of_birth)) {
        $errors[] = "Date of birth is required";
    }

    if (empty($groups)) {
        $errors[] = "At least one group must be selected";
    }

    if (count($errors) == 0) {
        echo json_encode(array('success' => true));

        $sql = "INSERT INTO `user` (`username`, `password`, `first_name`, `last_name`, `date_of_birth`) VALUES ('$username', '$password', '$first_name', '$last_name', '$date_of_birth')";
        if ($conn->query($sql) === FALSE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        exit();
        }

        $user_id = $conn->insert_id;

        foreach ($groups as $group_id) {
            $sql = "INSERT INTO `user_group_membership` (`user_id`, `group_id`) VALUES ('$user_id', '$group_id')";
            if ($conn->query($sql) === FALSE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
                exit();
            }
        }

        exit();
    }
}
?>
