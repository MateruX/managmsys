$(document).ready(function() {
    $("#show-user-form-btn").click(function() {
        $("#add-user-form").show();
    });
  
    $("#cancel-user-form-btn").click(function() {
        $("#add-user-form").hide();
    });
  
    $("#add-user-form").submit(function(event) {
        event.preventDefault();
  
        $.ajax({
            url: "add_user.php",
            method: "POST",
            data: $("#add-user-form").serialize(),
            success: function() {
                alert("User sucessfully added");
                $("#add-user-form").hide();
                location.reload();
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                alert("An error occurred while processing your request.");
            }
        });
    });
});