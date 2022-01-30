<?php 

	// Starting the session and getting access to the database via require statments.
	session_start ();
	require '../../dbConfig.php';

?>


<!DOCTYPE html>
<html>
<?php

		// Placed everything in the header tag into its own seperate file and requiring it on pages when prompted.
		// Since the layout of the site is the same, this reduces reptition significantly.
		require 'header.php';
?>
		<img src="images/banners/randombanner.php" />
		<main>
	

			<article>
				<h2>Welcome</h2>

					<?php

						// If submit is pressed then everything from the person table, where the email is the same as the one in the URL, is executed.
						if (isset($_POST['submit'])) {	
						$stmt = $pdo->prepare('SELECT * FROM admins WHERE email = :email');
						$values = [
						'email' => $_POST['email'],
						];
						$stmt->execute($values);
						$admin = $stmt->fetch();
						
						// Hashing the password acted as a prerequisite as we are now able to use the password verify function to read the hashed value stored in the database.
						if (password_verify($_POST['password'], $admin['password'])) {
						$_SESSION['adminloggedin'] = true;
						

								echo '<p>You have logged in! ';
								echo '<a href="adminArticles.php">View articles</a>';
								
							}
                            else{
                                echo '<p>You credentials are incorrect</p>';
                                echo '<p><a href="adminLogin.php">Try again</p>';
                            }
						
                            
						}
						// Logincheck to see if it is an admin account. If so, it will print the links.
						if (isset($_SESSION['adminloggedin']) && $_SESSION['adminloggedin'] == true ) {
							 echo '<p><a href="adminArticles.php">Manage articles</p>';
							 echo '<p><a href="adminCategories.php">Manage Categories</p>';
							 
					

                
						}
                
            
			// If the submit button was not pressed then the form is printed. 
			// This is to ensure that there is always something displayed on the site.
			else {
				?>
				<form action="adminLogin.php" method = "POST">
				<label>Email: </label> <input type="text" name="email" />
				<label>Password: </label> <input type="password" name="password" />
				<input type="submit" name="submit" value="submit" />
				
				</form>
            
				
				
				<?php

				}
				?>

			
			</article>

			
		</main>
		

        <?php
		// Since the footer is a reoccurence on each page. It has been moved to its own file so it can be called when prompted via a simple require statement.
		// This reduces repetition on each page.
		require 'footer.php';
			?>


	</body>
</html>
