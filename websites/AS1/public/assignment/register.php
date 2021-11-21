<?php 
		
	// Starting the session and getting access to the database via require statments.
	session_start ();
	require '../../dbConfig.php';

?>

<!DOCTYPE html>
	<?php
		// Placed everything in the header tag into its own seperate file and requiring it on pages when prompted.
		// Since the layout of the site is the same, this reduces reptition significantly.
		require 'header.php';
	?>

		<img src="images/banners/randombanner.php" />
		<main>
		
<?php

		// If submit is pressed the new data will be inserted into the attributed listed below.
		// Prepared statements are used as a secuity measure and to obviate SQL injection.

		if (isset($_POST['submit'])) {
		$stmt = $pdo->prepare('INSERT INTO person (name, email, password)
									VALUES (:name, :email, :password)
									');


			// Password being hashed in a very safe and secure manner.
			// This way, if there were any data leaks from the database, the hashed passwords cannot be deciphered.
			// This is thanks to PHP's in-built function.
			$hashed_password = $_POST['password'];
			$hash = password_hash($hashed_password, PASSWORD_DEFAULT);


			$values = [
				'name' => $_POST['name'],
				'email' => $_POST['email'],
				'password' => $hash,
			];
					$stmt->execute($values);

					// Once registered you get a little message indicating that your data has been stored and a link to back to the homepage to log in.
					echo '<p>You are now registered!</p>';
					echo '<a href=index.php>Go to homepage!</p>';

					}
						// If the submit button was not pressed then the form is printed. 
						// This is to ensure that there is always something displayed on the site.
							else {
							?> 
							<form action="register.php" method = "POST">
						
							<h1>Registration</h1>
							<p>Please enter your details below</p>
							
							<label for = "name"><strong>Display name: </strong></label>
							<input type = "text" name = "name" required>

							<label for = "email"><strong>Email: </strong></label>
							<input  type = "email" name = "email" required>

							<label for = "password"><strong>Password: </strong></label>
							<input  type = "password" name = "password" required>


					<input type="submit" name = "submit" value = "Submit">




</form>




<?php
}
?> 
		</main>

		<?php
		// Since the footer is a reoccurence on each page. It has been moved to its own file so it can be called when prompted via a simple require statement.
		// This reduces repetition on each page.
		require 'footer.php';
			?>

	</body>
</html>
