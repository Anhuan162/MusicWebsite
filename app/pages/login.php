<?php


	if($_SERVER['REQUEST_METHOD'] == "POST"){

		$errors = [];

		$values = [];
		$values['email'] = trim($_POST['email']);
		$query = "select * from users where email = :email limit 1";
		$row = db_query_one($query, $values);


		if(!empty($row)){
			message($row['password']);
			message($row['email']);
			message($row['role']);
			message($_POST['password']);
			if(password_verify($_POST['password'], $row['password'])){

				authenticate($row);
				message("login successful");
				redirect('admin');
			}

		}
		message("wrong email or password");
		
	}

?>



<?php require page('includes/header')?>

	<section class="content">
		
		<div class="login-holder">
			<?php if(message()):?>
				<div class="alert"><?=message('',true)?></div>
			<?php endif;?>

			<form method="post">
				<center><img src="assets/images/logo.jpg" style="width: 150px; border-radius: 50%; border: solid thin $ccc;">  </center>
				<h1>Login</h1>
				<input  value="<?=set_value('email')?>" class="my-1 form-control" type="email" name="email" placeholder="Email">
				<input  value="<?=set_value('password')?>" class="my-1 form-control" type="password" name="password" placeholder="Password">
				<button class="my-1 btn bg-blue">Login</button>
			</form>
		</div>
		
	</section>


<?php require page('includes/footer')?>
