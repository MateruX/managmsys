$(document).on("click", ".delete-user-btn", function() {
    var userId = $(this).data("user-id");
    
    if (confirm("Do you really want to delete ID " + userId + " user?")) {
        $.ajax({
            url: "delete_user.php",
            type: "POST",
            data: { id: userId },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                alert("User successfully deleted");
                window.location.reload();
                } else {
                    alert("Failed to delete user");
                }
            },
            error: function() {
                alert("Failed to delete user");
            }
        });
    }
});