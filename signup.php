
  <?php include './includes/header.php'; ?>
<?php
  
  if(isset($_POST['action'])){

    $name = null;
    $email = null;
    $password = null;


    // name field validation
    if(isset($_POST['name']) && !empty($_POST['name'])){
      if(preg_match('/^[A-Za-z\s]+$/', $_POST['name'])){
        $name = htmlspecialchars($_POST['name']);
      }else{
        $name_error = 'Only alphabets are allowed.';
      }
    }else{
      $name_error = 'Please fill the field.';
    }


    // email field validation
    if(isset($_POST['email']) && !empty($_POST['email'])){
      if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $old_email = $_POST['email'];
        $check_email_query = "SELECT * FROM users WHERE email = '$old_email'";
        $check_email = mysqli_query($connection, $check_email_query);
        if(mysqli_num_rows($check_email) <= 0){
          $email = htmlspecialchars($_POST['email']);
        }else{
          $email_error = 'Email is already exists try different one.';
        }
      }else{
        $email_error = 'Please provide a valid email.';
      }
    }else{
      $email_error = 'Please fill the field.';
    }


    // password validation
    if(isset($_POST['password']) && !empty($_POST['password'])){
      if(strlen($_POST['password']) >= 8){
        if($_POST['password'] == $_POST['confirm_password']){
          $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        }else{
          $password_error = 'Confirm password should be match with password.';
        }
      }else{
        $password_error = 'Password should be equal or greater then 8 chars.';
      }
    }else{
      $password_error = 'Please fill the field.';
    }


    if(!empty($name) && !empty($email) && !empty($password)){
      $insert_sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

      if(mysqli_query($conn, $insert_sql)){
        $message = '<div class="card card-content green white-text"><strong>Successfully!</strong> Your account is created successfully.</div>';
      }else{
        $message = '<div class="card card-content red white-text"><strong>Error!</strong> Something went wrong please try again.</div>';
      }

    }


  }// main if ends here



?>



  <!-- signup form -->
  <div class="container mt-5">
    <div class="row">
      <div class="col s8 offset-s2">
        <div class="card shadow">
          <div class="center-align #26a69a teal lighten-1 py-3">
            <h4 class="white-text">SignUp</h4>
          </div>
          <div class="card-content">
            <?php if(isset($message)): ?>
              <?= $message ?>
            <?php endif; ?>
            <form action="" method="post">
              <div class="input-field">
                      <input name="name" id="name" type="text" class="validate <?php if(isset($name_error)) echo 'invalid'; ?>">
                      <label for="name">Name</label>
                      <?php if(isset($name_error)): ?>
                        <span class="helper-text" data-error="<?= $name_error ?>"></span>
                      <?php endif; ?>
                  </div>
                  <div class="input-field">
                      <input name="email" id="email" type="email" class="validate <?php if(isset($email_error)) echo 'invalid'; ?>">
                      <label for="email">Email</label>
                      <?php if(isset($email_error)): ?>
                        <span class="helper-text" data-error="<?= $email_error ?>"></span>
                      <?php endif; ?>
                  </div>
                  <div class="input-field">
                      <input name="password" id="password" type="password" class="validate <?php if(isset($password_error)) echo 'invalid'; ?>">
                      <label for="password">Password</label>
                      <?php if(isset($password_error)): ?>
                        <span class="helper-text" data-error="<?= $password_error ?>"></span>
                      <?php endif; ?>
                  </div>
                  <div class="input-field">
                      <input name="confirm_password" id="confirm_password" type="password" class="validate">
                      <label for="confirm_password">Confirm Password</label>
                  </div>
                  <button class="btn waves-effect waves-light #26a69a teal lighten-1" type="submit" name="action"> 
                    Submit
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- signup form ends here -->

<?php include 'includes/footer.php'; ?>