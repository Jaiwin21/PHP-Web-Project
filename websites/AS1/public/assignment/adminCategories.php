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
		<main>
		

		<?php
					// Link to add new categories
					echo '<a href = "addCategory.php">Add Categories!</a>';
					// If logged in, all the data will be selected from the table listed below.
					$stmt = $pdo->prepare('SELECT * FROM category');
					$stmt->execute();


					// Logincheck to see if it is an admin account.
					if (isset($_SESSION['adminloggedin']) && $_SESSION['adminloggedin'] == true ) {
					
					// The data selected above is then printed out row by row onto the site.
					echo '<ul>';
					foreach ($stmt as $row) {

					echo '<li>';
					echo  $row['name'];

					// Links to edit or delete.
					echo '</br>';
					echo '<a href = "editCategory.php?categoryId=' . $row['categoryId'] . '">Edit</a>';
					echo '</br>';
					echo '<a href = "deleteCategory.php?categoryId=' . $row['categoryId'] . '">Delete</a>';

					echo '</li>';
			 
						
						echo '</ul>';

			
					}
				} else {
			
						echo '<h1>You are not authorized to view this page.</h1>';
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
