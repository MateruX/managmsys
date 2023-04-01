$(document).on("click", ".edit-group-btn", function() {
    var groupId = $(this).data("group-id");
    console.log(groupId);
    $.ajax({
        url: "get_group_for_edit.php",
        type: "GET",
        dataType: "json",
        data: {
            id: groupId
        },
        success: function(group) {
            console.log(group);
            console.log(group.name);
            $("#add-group-form #group-name").val(group.name);
            $("#add-group-form #members").val(group.members);
            
            $("#add-group-form").show();
            
            $("#submit-group-form-btn").off("click").on("click", function() {
                var name = $("#add-group-form #group-name").val();
                var members = $("#add-group-form #members").val().join(",");
                
                $.ajax({
                    url: "edit_group.php",
                    type: "POST",
                    dataType: "json",
                    data: {
                        id: groupId,
                        group_name: name,
                        members: members
                    },
                    success: function(result) {
                        if (result.success) {
                            $("#groups-table tr[data-group-id='" + userId + "'] td.group-name").text(name);
                            $("#groups-table tr[data-group-id='" + userId + "'] td.members").text(members);

                            $("#add-group-form").hide();
                            alert("Dane użytkownika zostały zaktualizowane.");
                        } else {
                        alert("Wystąpił błąd podczas aktualizowania danych użytkownika.");
                        }
                    },
                    error: function() {
                    alert("Wystąpił błąd podczas wysyłania zapytania AJAX.");
                    }
                });
            });
        },
        error: function() {
            alert("Wystąpił błąd podczas pobierania danych użytkownika.");
        }
    });
});