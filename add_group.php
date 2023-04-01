<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = new mysqli("localhost", "root", "", "usermanag");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $group_name = $_POST["group_name"];
    $members = $_POST["members"];

    $errors = array();

    if (empty($group_name)) {
        $errors[] = "Group Name is required";
    }

    if (count($errors) == 0) {
        echo json_encode(array('success' => true));
        $sql = "INSERT INTO `user_group` (`name`) VALUES ('$group_name')";
        if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
        exit();
    }

    $group_id = $conn->insert_id;

    foreach ($members as $user_id) {
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
