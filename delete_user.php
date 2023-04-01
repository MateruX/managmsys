<?php
$userId = $_POST["id"];

$conn = new mysqli("localhost", "root", "", "usermanag");

if ($conn->connect_error) {
    die("Nie udało się połączyć z bazą danych: " . $conn->connect_error);
}

$conn->begin_transaction();

try {
    $sql = "DELETE FROM user_group_membership WHERE user_id = $userId";
    if ($conn->query($sql) !== TRUE) {
        throw new Exception("Błąd podczas usuwania powiązań użytkownika z grupami: " . $conn->error);
    }

    $sql = "DELETE FROM user WHERE id = $userId";
    if ($conn->query($sql) !== TRUE) {
        throw new Exception("Błąd podczas usuwania użytkownika: " . $conn->error);
    }

    $conn->commit();

    $response["success"] = true;
} catch (Exception $e) {
    $conn->rollback();

    $response["success"] = false;
    $response["error"] = $e->getMessage();
}

$conn->close();

echo json_encode($response);
?>