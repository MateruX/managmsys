<?php
if (!isset($_POST['id'])) {
    // Zwrócenie komunikatu o błędzie
    $data = array('success' => false, 'message' => 'Nieprawidłowe żądanie.');
    echo json_encode($data);
    exit();
}

$id = $_POST['id'];

$conn = mysqli_connect('localhost', 'root', '', 'usermanag');
$query = "SELECT * FROM user WHERE id = $id";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == 0) {
    $data = array('success' => false, 'message' => 'Nie znaleziono użytkownika o podanym identyfikatorze.');
    echo json_encode($data);
    mysqli_close($conn);
    exit();
}

$username = $_POST['username'];
$password = $_POST['password'];
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$dateOfBirth = $_POST['date_of_birth'];
$groups = $_POST['groups'];

$query = "UPDATE user SET username = '$username', password = '$password', first_name = '$firstName', last_name = '$lastName', date_of_birth = '$dateOfBirth' WHERE id = $id";
$result = mysqli_query($conn, $query);

$query = "DELETE FROM user_group_membership WHERE user_id = $id";
$result = mysqli_query($conn, $query);

$groupIds = explode(',', $groups);
foreach ($groupIds as $groupId) {
    $query = "INSERT INTO user_group_membership (user_id, group_id) VALUES ($id, $groupId)";
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
