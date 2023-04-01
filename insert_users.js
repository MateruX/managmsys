$(document).ready(function() {
    $.ajax({
        url: "get_users.php",
        type: "GET",
        dataType: "json",
        success: function(users) {
            var usersTable = $("#users-list tbody");
            $.each(users.users, function(index, user) {
                var row = "<tr>" +
                    "<td>" + user.username + "</td>" +
                    "<td>" + user.first_name + "</td>" +
                    "<td>" + user.last_name + "</td>" +
                    "<td>" + user.date_of_birth + "</td>" +
                    "<td>" + user.groups + "</td>" +
                    "<td><button class='edit-user-btn' data-user-id='" + user.id + "'>Edit</button></td>" +
                    "<td><button class='delete-user-btn' data-user-id='" + user.id + "'>Delete</button></td>" +
                "</tr>";
                usersTable.append(row);
            });
      },
      error: function() {
            alert("Nie udało się pobrać listy użytkowników.");
      }
    });
});