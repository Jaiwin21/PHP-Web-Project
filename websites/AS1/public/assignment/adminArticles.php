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
		
				// If submit is pressed the data will be selected from the table listed below.
				$stmt = $pdo->prepare('SELECT * FROM article');
				$stmt->execute();

						// The data selected above is then printed out row by row onto the site.
						echo '<ul>';
						foreach ($stmt as $row) {
						
							echo '<li>';
							echo 'Article ID = ' . $row['article_id'] .'. ' . $row['title'] . ' by ' . $row['articleauthor'] . ' published on ' . $row['publishDate'] .
							'</br>' . $row['content'];

							// Links to carry out delete and edit functions.
							echo '</br>';
							echo '<a href = "editArticle.php?article_id=' . $row['article_id'] . '">Edit</a>';
							echo '</br>';
							echo '<a href = "deleteArticle.php?article_id=' . $row['article_id'] . '">Delete</a>';
								
							echo '</li>';
						} 
						echo '</ul>';

						// Links to go to pages where you can either add articles or manage the existing categories on the site.
						echo '<a href = "addArticle.php">Add articles!</a>';
						echo '</br>';
						echo '<a href = "adminCategories.php">Manage categories!</a>';

			
			
			
				
				
				
			
			?>





		
    
		</main>

		<?php
		// Since the footer is a reoccurence on each page. It has been moved to its own file so it can be called when prompted via a simple require statement.
		// This reduces repetition on each page.
		require 'footer.php';
			?>

	</body>
</html>
