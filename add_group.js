$(document).ready(function() {
    $("#show-group-form-btn").click(function() {
        $("#add-group-form").show();
    });
  
    $("#cancel-group-form-btn").click(function() {
        $("#add-group-form").hide();
    });
  
    $("#add-group-form").submit(function(event) {
        event.preventDefault();
  
        $.ajax({
            url: "add_group.php",
            method: "POST",
            data: $("#add-group-form").serialize(),
            success: function() {
                alert("Group successfully added");
                $("#add-group-form").hide();
                location.reload();
            },
            error: function(xhr, status, error) {
            console.log(xhr.responseText);
            alert("An error occurred while processing your request.");
            }
        });
    });
});