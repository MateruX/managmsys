<?php
$groupId = $_GET["id"];

$conn = new mysqli("localhost", "root", "", "usermanag");

if ($conn->connect_error) {
    die("Nie udało się połączyć z bazą danych: " . $conn->connect_error);
}

$query = "SELECT user_group.id, user_group.name, GROUP_CONCAT(user.username SEPARATOR ', ') AS members FROM user_group
LEFT JOIN user_group_membership ON user_group.id = user_group_membership.group_id
LEFT JOIN user ON user_group_membership.user_id = user.id
WHERE user_group.id = $groupId";
$result = mysqli_query($conn, $query);
$group = mysqli_fetch_object($result);

mysqli_close($conn);
$data = json_encode($group);
echo $data;
?> 