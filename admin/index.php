<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Login</title>
</head>
<body>
  <h2>Login Page</h2>
  <form action="login.php" method="post">
    <div>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>
    </div>
    <div>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>
    </div>
    <input type="submit" value="Login">
  </form>
</body>
</html>