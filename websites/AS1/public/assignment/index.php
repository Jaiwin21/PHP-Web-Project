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
				<!-- A little welcome message upon landing on the page. -->
				<h2>Welcome</h2>
				<p>Here to see what is going on in your area?</p>


					<?php
							// Statement below selects everything from the articles table from the database.
							$stmt = $pdo->prepare('SELECT * FROM article');
							$stmt->execute();

							// The data selected above is then printed out row by row onto the site.
							echo '<ul>';
							foreach ($stmt as $row) {
								echo '<li>';
								echo $row['title'] . '</br>' . ' ' . '</br>'  .  $row['publishDate'];
								echo '</li>';
							}
							echo '</ul>';

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
