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
			
			<a href="index.php">Home</a>
			<p></p>
			<?php
		
		
				// Simply used to print out all the articles stored in the database.
				$stmt = $pdo->prepare('SELECT * FROM article');
				$stmt->execute();


						echo '<ul>';
						foreach ($stmt as $row) {
						
							echo '<li>';
							echo $row['title'] . ' by ' . $row['articleauthor'] . ' published on ' . $row['publishDate'] .
							'</br>' . $row['content'];

								
							echo '</li>';
						} 
						echo '</ul>';

				
			?>

    
		</main>

		<?php
		// Since the footer is a reoccurence on each page. It has been moved to its own file so it can be called when prompted via a simple require statement.
		// This reduces repetition on each page.
		require 'footer.php';
		?>

	</body>
</html>