$(document).on("click", ".edit-user-btn", function() {
    var userId = $(this).data("user-id");
    console.log(userId);
    $.ajax({
        url: "get_user_for_edit.php",
        type: "GET",
        dataType: "json",
        data: {
            id: userId
        },
        success: function(user) {
            console.log(user);
            $("#add-user-form #username").val(user.username);
            $("#add-user-form #password").val(user.password);
            $("#add-user-form #first-name").val(user.first_name);
            $("#add-user-form #last-name").val(user.last_name);
            $("#add-user-form #date-of-birth").val(user.date_of_birth);
            $("#add-user-form #groups").val(user.groups);
            
            $("#add-user-form").show();
            
            $("#submit-user-form-btn").off("click").on("click", function() {
                var username = $("#add-user-form #username").val();
                var password = $("#add-user-form #password").val();
                var firstName = $("#add-user-form #first-name").val();
                var lastName = $("#add-user-form #last-name").val();
                var dateOfBirth = $("#add-user-form #date-of-birth").val();
                var groups = $("#add-user-form #groups").val().join(",");
                
                $.ajax({
                    url: "edit_user.php",
                    type: "POST",
                    dataType: "json",
                    data: {
                        id: userId,
                        username: username,
                        password: password,
                        first_name: firstName,
                        last_name: lastName,
                        date_of_birth: dateOfBirth,
                        groups: groups
                    },
                    success: function(result) {
                        if (result.success) {
                            
                            $("#users-table tr[data-user-id='" + userId + "'] td.username").text(username);
                            $("#users-table tr[data-user-id='" + userId + "'] td.password").text(password);
                            $("#users-table tr[data-user-id='" + userId + "'] td.first-name").text(firstName);
                            $("#users-table tr[data-user-id='" + userId + "'] td.last-name").text(lastName);
                            $("#users-table tr[data-user-id='" + userId + "'] td.date-of-birth").text(dateOfBirth);
                            $("#users-table tr[data-user-id='" + userId + "'] td.groups").text(groups);

                            $("#add-user-form").hide();
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
            // Wyświetlenie komunikatu o błędzie
            alert("Wystąpił błąd podczas pobierania danych użytkownika.");
        }
    });
});