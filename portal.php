<html lang="en">
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<style>
.form-select {
    background-color: #fff0;
  }
  form {
  margin-top: 160px;
  margin-bottom: 100px;
  margin-right: 550px;
  margin-left: 550px;
}
form {text-align: center;}
footer {text-align: center;
    bottom: 0;
    width: 100%;
    height: 60px;
    line-height: 60px;
    background-color: #212529;}
input[type="text"]
{
    background: transparent;
}
input[type="password"]
{
    background: transparent;
}
body {
    background-image: url(pics.jpg);
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
}
</style>
<title>Portal</title>
</head>
<body style="background-color:white">
<?php if (isset($_POST['submitted'])){
//this code is executed when the data is submitted
$username = 'root';
$password = '';
try {
$conn = new PDO("mysql:host=localhost;dbname=school", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
echo "Connection failed: " . $e->getMessage();
}
$user_id = $_POST['user_id'];
$password = sha1($_POST['password']);
$typ = $_POST['typ'];
$query_1 = $conn->query('use school');
$query_2 = $conn->prepare("SELECT user_id, pass FROM LOGINS");
$query_2->execute();
$result_2 = $query_2->fetchall(PDO::FETCH_ASSOC);

foreach ($result_2 as $key => $value) {
if(($user_id == $value['user_id']) and ($password == $value['pass']))
  if($typ == 'student')
{
  session_start();
  $_SESSION['roll_no'] = $user_id;
  header('Location: shome.php');
  break;

}
elseif($typ == 'teacher')
{
  session_start();
  $_SESSION['teacher_id'] = $user_id;
  header('Location: thome.php');
  break;
}
elseif($typ == 'admin')
{
  header('Location: ahome.php');
  break;
}
}

?>
<div class="alert alert-danger" role="alert">
Invalid Credentials <a href="/portal.php" class="alert-link">click</a> to go back to the portal.
</div>
<?php }
else { ?>
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Welcome to ypur school portal!!</strong> Here you can login to your profile.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<form action="portal.php" method="POST">
<h2>Portal Login</h2>
<div class="mb-3">
<div class="form-floating">
<input type="text" class="form-control" name="user_id" id="floatingInput" placeholder="User Id:">
<label for="floatingInput">User Id:</label>
</div>
<div class="form-floating">
<input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password:">
<label for="floatingPassword">Password:</label>
</div>
<div class="form-floating">
<select class="form-select" aria-label="--select who you are--" name="typ" id="floatingselect" placeholder="--select who you are--">
  <option value="student">Student</option>
  <option value="teacher">Teacher</option>
  <option value="admin">Admin</option>
</select>
<label for="floatingselect">--select who you are--</label>
</div>
<label><input type="checkbox" value="remember-me"> Remember me </label>
<input type="hidden" name="submitted" value="1" />
<input class="w-100 btn btn-lg btn-primary" type="submit" value="Submit">
<p class="mt-5 mb-3 text-muted">© zaz 2021</p>
</div>
</form>
<?php } ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>