<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User managment System</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="insert_users.js"></script>
	  <script src="insert_groups.js"></script>
    <script src="add_user.js"></script>
    <script src="add_group.js"></script>
    <script src="delete_user.js"></script>
    <script src="delete_group.js"></script>
    <script src="edit_user.js"></script>
    <script src="edit_group.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="tables">
      <div class="user-table">
        <table id="users-list">
          <thead>
            <tr>
              <th>Username</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Date of Birth</th>
              <th>Groups</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
        <button id="show-user-form-btn">Add User</button>
        <form id="add-user-form" method="post" style="display:none;">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" required>

          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required>

          <label for="first-name">First Name:</label>
          <input type="text" id="first-name" name="first_name" required>

          <label for="last-name">Last Name:</label>
          <input type="text" id="last-name" name="last_name" required>

          <label for="date-of-birth">Date of Birth:</label>
          <input type="date" id="date-of-birth" name="date_of_birth" required>

          <label for="groups">Groups:</label>
          <select id="groups" name="groups[]" multiple>
            <?php
              $conn = new mysqli("localhost", "root", "", "usermanag");
              $groups = $conn->query("SELECT * FROM user_group");

              while ($row = $groups->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['name']}</option>";
              }
            ?>
          </select>
          <div class="buttons">
            <button type="submit" id="submit-user-form-btn">Save</button>
            <button type="button" id="cancel-user-form-btn">Cancel</button>
          </div>
        </form>
      </div>
      <div class="group-table">
        <table id="groups-list">
          <thead>
            <tr>
              <th>Group Name</th>
              <th>Members</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
        <button id="show-group-form-btn">Add Group</button>
        <form id="add-group-form" method="post" style="display:none;">
          <label for="group-name">Group Name:</label>
          <input type="text" id="group-name" name="group_name" required>

          <label for="members">Members:</label>
          <select id="members" name="members[]" multiple>
            <?php
              $conn = new mysqli("localhost", "root", "", "usermanag");
              $groups = $conn->query("SELECT * FROM user");

              while ($row = $groups->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['username']}</option>";
              }
            ?>
          </select>
          <div class="buttons">
            <button type="submit" id="submit-group-form-btn">Save</button>
            <button type="button" id="cancel-group-form-btn">Cancel</button>
          </div>
        </form>
      </div>
    </div>

    
    
  </body>
</html>