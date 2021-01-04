<!-- navbar -->
<nav class="#26a69a teal lighten-1">
    <div class="container">
    	<div class="nav-wrapper">
	      <a href="#" class="brand-logo">SimpleBlog</a>
	      <ul id="nav-mobile" class="right hide-on-med-and-down">
	        <li><a href="index.php">Home</a></li>
	        <?php if(isset($_SESSION['user']) && !empty($_SESSION['user'])): ?>
	        	<li><a href="#"><?= $_SESSION['user']['name'] ?></a></li>
	        	<li><a href="logout.php">Logout</a></li>
	        	<?php else: ?>
	        <li><a href="signin.php">Signin</a></li>
	        <li><a href="signup.php">Signup</a></li>
	        <?php endif; ?>
	      </ul>
	    </div>
    </div>
</nav>
<!-- navbar ends here-->