	<?php include './includes/header.php'; ?>

	<?php
    
		if(isset($_POST['action'])){

			$email = null;
			$password = null;


			// email field validation
			if(isset($_POST['email']) && !empty($_POST['email'])){
				if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
 					$email = htmlspecialchars($_POST['email']);
				}else{
					$email_error = 'Please provide a valid email.';
				}
			}else{
				$email_error = 'Please fill the field.';
			}


			// password validation
			if(isset($_POST['password']) && !empty($_POST['password'])){
				$password = $_POST['password'];
			}else{
				$password_error = 'Please fill the field.';
			}


			if(!empty($email) && !empty($password)){

				$check_user = "SELECT * FROM users WHERE email = '$email'";
				$check_user = mysqli_query($conn, $check_user);
				if(mysqli_num_rows($check_user) == 1){
					$user = mysqli_fetch_assoc($check_user);
					if(password_verify($password, $user['password'])){
						$_SESSION['user'] = $user;
						header("Location: dashboard.php");
					}else{
						$email_error = 'Credentials are invalid.';
					}
				}else{
					$email_error = 'Email is not found in our server.';
				}


			}



		}// main if ends here

	?>


	<!-- signup form -->
	<div class="container mt-5">
		<div class="row">
			<div class="col s6 offset-s3">
				<div class="card">
					<div class="card-content">
						<span class="card-title center-align">Signin</span>
						<form action="" method="post">
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
        					<button class="btn waves-effect waves-light #26a69a teal lighten-1" type="submit" name="action">	
        						Signin
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- signup form ends here -->

<?php include './includes/footer.php'; ?>