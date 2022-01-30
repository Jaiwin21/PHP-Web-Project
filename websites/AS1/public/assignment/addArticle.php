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
		// Logincheck to see if it is an admin account.
		if (isset($_SESSION['adminloggedin']) && $_SESSION['adminloggedin'] == true) {
			echo '<p>Add an article below!</p>'; 
		   }
		?>
		<?php

					// If submit is pressed the new data will be inserted into the attributed listed below.
					// Prepared statements are used as a secuity measure and to obviate SQL injection.
							if (isset($_POST['submit'])) {
							$stmt = $pdo->prepare('INSERT INTO article (title, articleauthor, publishDate, categoryId, content)
							VALUES (:title, :articleauthor, :publishDate, :categoryId, :content)
							');
							$values = [
							'title' => $_POST['title'],
							'articleauthor' => $_POST['articleauthor'],
							'publishDate' => $_POST['publishDate'],
							'categoryId' => $_POST['categoryId'],
							'content' => $_POST['content'],
							];
							$stmt->execute($values);

							echo '<b>Nice! An article has been added!<b>';
							echo '</br>';
							echo 'Click <a href= "allArticle.php">here</a> to see it!';
							echo '</br>';
							echo 'Click <a href= "addArticle.php">here</a> to add another article!';
							echo '</br>';
							echo 'Click <a href= "adminArticles.php">here</a> to return to admin area!';
							
						}

				
				// If the submit button was not pressed then the form is printed. 
				// This is to ensure that there is always something displayed on the site.
				if (isset($_SESSION['adminloggedin']) && $_SESSION['adminloggedin'] == true ) {
				?>
				<form action="addArticle.php" method = "POST">
				<label>Article Name: </label> <input type="text" name="title" />
				<label>Author: </label> <input type="text" name="articleauthor" />
				<label>Date of publish: </label> <input type="date" name="publishDate" />
				<label>Category</label>
				<select name="categoryId">
         	   <?php
                $stmt = $pdo->prepare('SELECT * FROM category');
                $stmt->execute();

                foreach ($stmt as $row) {
                    echo '<option value="' . $row['categoryId'] . '">' . $row['name'] . '</option>';
                }

          	  ?>

          	  </select>
				<label>Article: </label> <textarea id="content" name="content" rows="10" cols="100"> </textarea>
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
