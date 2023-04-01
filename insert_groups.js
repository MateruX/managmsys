$(document).ready(function() {
    $.ajax({
        url: "get_groups.php",
        type: "GET",
        dataType: "json",
        success: function(groups) {
            var groupsTable = $("#groups-list tbody");
            $.each(groups.groups, function(index, group) {
                var row = "<tr>" +
                    "<td>" + group.name + "</td>" +
                    "<td>" + group.members + "</td>" +
                    "<td><button class='edit-group-btn' data-group-id='" + group.id + "'>Edit</button></td>" +
                    "<td><button class='delete-group-btn' data-group-id='" + group.id + "'>Delete</button></td>" +
                "</tr>";
                groupsTable.append(row);
            });
        },
        error: function() {
            alert("Nie udało się pobrać listy grup.");
        }
    });
});