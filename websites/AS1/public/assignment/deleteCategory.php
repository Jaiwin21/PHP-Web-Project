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
		<?php

					// The category ID is set and can be retrived from the URL via a GET variable and used to identify the row that is going to be deleted
					// from the database and subsequently, the website.
					// Very clever if I say so myself.
                    if (isset($_GET['categoryId'])) {

                    $stmt = $pdo->prepare('DELETE FROM category WHERE categoryId = :categoryId LIMIT 1 ');

                    $values = [
                        'categoryId' => $_GET['categoryId']
                    ];

                    $stmt->execute($values);

                    echo 'The category has been deleted';
                    echo '</br>';
                    echo '<a href="adminArticles.php"> Return to administration area!</a>';
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
