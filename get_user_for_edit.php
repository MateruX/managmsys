<?php
$userId = $_GET["id"];
$conn = new mysqli("localhost", "root", "", "usermanag");

if ($conn->connect_error) {
  die("Nie udało się połączyć z bazą danych: " . $conn->connect_error);
}

$query = "SELECT user.id, user.username, user.first_name, user.last_name, user.date_of_birth, GROUP_CONCAT(user_group.name SEPARATOR ', ') AS groups FROM user 
LEFT JOIN user_group_membership ON user.id = user_group_membership.user_id
LEFT JOIN user_group ON user_group_membership.group_id = user_group.id
WHERE user.id = $userId";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_object($result);

mysqli_close($conn);

$data = json_encode($user);
echo $data;
?> 