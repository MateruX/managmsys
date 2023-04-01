<?php
if (!isset($_POST['id'])) {
    // Zwrócenie komunikatu o błędzie
    $data = array('success' => false, 'message' => 'Nieprawidłowe żądanie.');
    echo json_encode($data);
    exit();
}

$id = $_POST['id'];

$conn = mysqli_connect('localhost', 'root', '', 'usermanag');
$query = "SELECT * FROM user_group WHERE id = $id";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == 0) {
    $data = array('success' => false, 'message' => 'Nie znaleziono użytkownika o podanym identyfikatorze.');
    echo json_encode($data);
    mysqli_close($conn);
    exit();
}

$name = $_POST['group_name'];
$members = $_POST['members'];

$query = "UPDATE user_group SET name = '$name' WHERE id = $id";
$result = mysqli_query($conn, $query);

$query = "DELETE FROM user_group_membership WHERE group_id = $id";
$result = mysqli_query($conn, $query);

$userIds = explode(',', $members);
foreach ($userIds as $userId) {
    $query = "INSERT INTO user_group_membership (group_id, user_id) VALUES ($id, $userId)";
    $result = mysqli_query($conn, $query);
}

if ($result) {
    $data = array('success' => true);
    echo json_encode($data);
} else {
    $data = array('success' => false, 'message' => 'Wystąpił błąd podczas aktualizowania danych użytkownika.');
    echo json_encode($data);
}

mysqli_close($conn);
?>
