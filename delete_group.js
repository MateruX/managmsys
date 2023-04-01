$(document).on("click", ".delete-group-btn", function() {
    var groupId = $(this).data("group-id");
    
    if (confirm("Are you sure that ID " + groupId + " group will be deleted?")) {
        $.ajax({
            url: "delete_group.php",
            type: "POST",
            data: { id: groupId },
            dataType: "json",
            success: function(response) {
            if (response.success) {
                alert("Group successfully deleted");
                window.location.reload();
            } else {
                alert("Failed to delete group");
                console.log(groupId);
            }
            },
            error: function() {
                alert("Failed to delete group");
            }
        });
    }
});