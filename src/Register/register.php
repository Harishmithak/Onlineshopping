<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<body>
    <h2>User Registration</h2>
    <form action="insert_user.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <label for="usertype">User Type:</label>
        <select id="usertype" name="usertype">
            <option value="Admin">Admin</option>
            <option value="User">User</option>
        </select><br><br>
        
        <input type="submit" value="Register">
    </form>
</body>
</html>
