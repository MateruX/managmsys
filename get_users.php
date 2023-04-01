<?php
$conn = mysqli_connect('localhost', 'root', '', 'usermanag');

$query = "SELECT user.id, user.username, user.first_name, user.last_name, user.date_of_birth, GROUP_CONCAT(user_group.name SEPARATOR ', ') AS groups FROM user 
LEFT JOIN user_group_membership ON user.id = user_group_membership.user_id
LEFT JOIN user_group ON user_group_membership.group_id = user_group.id
GROUP BY user.id";
$result = mysqli_query($conn, $query);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_close($conn);

$data = array('users' => $users);
echo json_encode($data);
?>