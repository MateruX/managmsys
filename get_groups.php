<?php
$conn = mysqli_connect('localhost', 'root', '', 'usermanag');

$query = "SELECT user_group.id, user_group.name, GROUP_CONCAT(user.username SEPARATOR ', ') AS members FROM user_group
LEFT JOIN user_group_membership ON user_group.id = user_group_membership.group_id
LEFT JOIN user ON user_group_membership.user_id = user.id
GROUP BY user_group.id";
$result = mysqli_query($conn, $query);
$groups = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_close($conn);

$data = array('groups' => $groups);
echo json_encode($data);
?>
