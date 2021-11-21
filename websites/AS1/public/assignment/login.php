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
				<p>Here to see what is going on in your area?</p>


					<?php

						// If submit is pressed then everything from the person table, where the email is the same as the one in the URL, is executed.
						if (isset($_POST['submit'])) {	
						$stmt = $pdo->prepare('SELECT * FROM person WHERE email = :email');
						$values = [
						'email' => $_POST['email'],
						];
						$stmt->execute($values);
						$user = $stmt->fetch();
						
						// Hashing the password acted as a prerequisite as we are now able to use the password verify function to read the hashed value stored in the database.
						if (password_verify($_POST['password'], $user['password'])) {
						$_SESSION['loggedin'] = true;
						

						// If usertype is equal to admin then it prints out the link to the administration page.
						// This is the only way to access the admin area, only under these stipulations.
						if ($user['person_id'] === '5') {
        
						echo '<p>Welcome back! ';
						echo '<a href="adminArticles.php">Administration area</a>';
						
						// If they do not have a admin usertype then they are directed to a page where they can view articles.
						} 
						else {
					 
                                
								//header('Location: loginCheckUser.php');
								echo '<p>You have logged in! ';
								echo '<a href="allArticle.php">Lets view some articles</a>';
								
							}
						
                            
						}
					}

                

                
            
			// If the submit button was not pressed then the form is printed. 
			// This is to ensure that there is always something displayed on the site.
			else {
				?>
				<form action="login.php" method = "POST">
				<label>Email: </label> <input type="text" name="email" />
				<label>Password: </label> <input type="password" name="password" />
				<input type="submit" name="submit" value="submit" />
				
				</form>
            
				
				
				<?php
				}
				?>

								<!-- A link to the registration page to register if not already registered. -->
								<p>Not registered? Register</p>
								<a href="register.php">here</a>
			</article>

			
		</main>
		

        <?php
		// Since the footer is a reoccurence on each page. It has been moved to its own file so it can be called when prompted via a simple require statement.
		// This reduces repetition on each page.
		require 'footer.php';
			?>


	</body>
</html>
