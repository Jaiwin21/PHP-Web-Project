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
            

                    <?php
                    
                    // If submit is pressed the new data will be inserted into the table and attribute listed below.
                    if (isset($_POST['submit'])) {
                    $stmt = $pdo->prepare('INSERT INTO category (name)
                    VALUES (:name)
                    ');
                    $values = [
                    'name' => $_POST['name'],
                    
                    ];
                    $stmt->execute($values);

                    // Confirmation message notifying the catgeory has been added.
                    // Links to go back to the admin area or to add another category.
                    echo 'Nice! A category has been added! ';
                    echo '</br>';
                    echo '<a href="addCategory.php">Add another category</a>';
                    echo '</br>';
                    echo '<a href="adminArticles.php"> Return to administration area!</a>';
                   
                    
                }

                // Logincheck to see if it is an admin account.
                if (isset($_SESSION['adminloggedin']) && $_SESSION['adminloggedin'] == true ) {
                ?>
                <form action="addCategory.php" method = "POST">
                <label>New Category: </label> <input type="text" name="name" />
                <input type="submit" name="submit" value="submit" />

                </form>


                <?php
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
