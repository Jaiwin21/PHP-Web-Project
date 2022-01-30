<?php

// Starting the session and getting access to the database via require statments.
session_start();
require '../../dbConfig.php';
// Unsetting the variable once the logout has been prompted
 unset($_SESSION['loggedin']);
 unset($_SESSION['adminloggedin']);
 

?>

<!DOCTYPE html>
<html>
<?php
	require 'header.php';
	?>
		<img src="images/banners/randombanner.php" />
		<main>
		

            <!-- Logout message including a link back to the homepage -->
            <article>
				<h2>You are now logged out.</h2>
				<p>Please visit anytime!</p>
                <a href="index.php">Click here to go back to the homepage!</a>
                <p> </p>
                <a href="login.php">Login</a>
			</article>
    
		</main>

		<?php

		// Since the footer is a reoccurence on each page. It has been moved to its own file so it can be called when prompted via a simple require statement.
		// This reduces repetition on each page.
		require 'footer.php';
			?>

	</body>
</html>




