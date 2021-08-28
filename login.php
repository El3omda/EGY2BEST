<?php
session_start();
require_once 'config.php';

if (isset($_SESSION['UserEmail'])) {
  header('Location:user-profile.php');
}

@$UserName = $_POST['username'];
@$UserEmail = $_POST['email'];
@$UserPassword = $_POST['password'];
@$UserGender = $_POST['gender'];

// Insert User Data Into USERS Table

$sqlInsert = "INSERT INTO users (UserName,UserEmail,UserPassword,UserGender) VALUES ('$UserName','$UserEmail','$UserPassword','$UserGender')";
$sqlSelect = "SELECT * FROM users WHERE UserEmail = '$UserEmail' AND UserPassword = '$UserPassword'";

if (isset($_POST['signup'])) {
  if (mysqli_query($conn, $sqlInsert)) {
    $insertMSG = 'تم تسجيل الحساب بنجاح';
    $UserName = $UserEmail = $UserGender = $UserPassword = '';
    $conn->close();
  } else {
    $insertMSG = 'الايمال مستخدم بالفعل';
    $conn->close();
  }
}

if (isset($_POST['signin'])) {
  $result = mysqli_query($conn, $sqlSelect);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $insertMSG = 'تم تسجيل الدخول بنجاح';
    $_SESSION['UserName'] = $row['UserName'];
    $_SESSION['UserEmail'] = $row['UserEmail'];
    header('Refresh:2;url=user-profile.php');
  } else {
    $insertMSG = 'خطا في الايمال او كلمة المرور';
  }
}
// Login Sql

// print_r($row);


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>تسجيل الدخول</title>
  <link rel="stylesheet" href="css/signin.css">
</head>

<body>
  <?php include_once 'bottom-nav.php'; ?>
  <div class="content-container">
    <div class="screen"><?php echo @$insertMSG; ?></div>
    <p class="title">تسجيل الدخول</p>
    <div class="navigator">
      <ul>
        <li><a class="active">تسجيل دخول</a></li>
        <li><a>حساب جديد</a></li>
      </ul>
    </div>
    <div class="changable-box">
      <form class="signin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="login">
          <div class="input-field">
            <input type="email" name="email" placeholder="اكتب ايميلك ..." required>
          </div>
          <div class="input-field">
            <input type="password" name="password" placeholder="اكتب كلمة المرور ..." required>
          </div>
          <a class="right" href="">نسيت كلمة المرور</a>
          <input name="signin" type="submit" value="تسجيل الدخول">
          <p class="last">
            ليس لديك حساب
            <a style="cursor: pointer;">سجل حساب مجاني</a>
          </p>
      </form>
    </div>
    <div class="sign-up">
      <form class="sginup" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

        <div class="input-field">
          <input type="text" name="username" placeholder="اكتب اسمك ..." required>
        </div>
        <div class="input-field">
          <input type="email" name="email" placeholder="اكتب ايميالك ..." required>
        </div>
        <div class="input-field">
          <input type="password" name="password" placeholder="اكتب كلمة المرور ..." required>
        </div>
        <div class="input-field" required>
          <select name="gender" id="gender">
            <option value="ذكر">ذكر</option>
            <option value="انثي">انثي</option>
          </select>
        </div>
        <input name="signup" type="submit" value="تسجيل حساب">
      </form>
    </div>
  </div>
  </div>

  <script>
    var signupbtn = document.querySelector('.navigator ul li:last-of-type a'),
      signinbtn = document.querySelector('.navigator ul li:first-of-type a'),
      donthave = document.querySelector('.last a'),
      signin = document.querySelector('.login'),
      signup = document.querySelector('.sign-up');
    signupbtn.onclick = function() {
      if (signinbtn.classList.contains('active')) {
        signinbtn.classList.remove('active');
        signupbtn.classList.add('active');
      }
      signin.style = "display: none;";
      signup.style = "display: block;";
      document.title = 'تسجيل حساب جديد';
    }
    signinbtn.onclick = function() {
      if (signupbtn.classList.contains('active')) {
        signupbtn.classList.remove('active');
        signinbtn.classList.add('active');
      }
      signup.style = "display: none;"
      signin.style = "display: block;";
      document.title = 'تسجيل الدخول';
    }
    donthave.onclick = function() {
      if (signinbtn.classList.contains('active')) {
        signinbtn.classList.remove('active');
        signupbtn.classList.add('active');
      }
      signin.style = "display: none;";
      signup.style = "display: block;";
      document.title = 'تسجيل حساب جديد';
    }
    var formsignin = document.forms[0];
    var formsignup = document.forms[1];
    // formsignin.onsubmit = function() {
    //   location.reload();
    // }
    // $('form')[0].submit(function() {
    //   alert('emad')
    // })
    // $('form')[1].submit(function() {
    //   alert('emad')
    // })
  </script>
</body>

</html>