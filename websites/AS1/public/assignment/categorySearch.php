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

                // If the category ID is in the URL it will be then caught via a GET variable to then print all records in the row of that ID.
                if (isset($_GET['categoryId'])) {

                $stmt = $pdo->prepare('SELECT * FROM article WHERE categoryId = :categoryId');

                $values = [
                    'categoryId' => $_GET['categoryId']
                ];

                $stmt->execute($values);
                
                // The data selected above is then printed out row by row onto the site.
                echo '<ul>';
                foreach ($stmt as $row) {
                    echo '<li>'; ?>
                    <?php
                    echo '<a class="articleLink" href="articleDisplay.php?title='.$row['title']. '">'.$row['title']. '</a>'
                        
?>  
                    <?php   
                    echo '</br>';
                    echo $row['publishDate'];
                    
                    echo '</li>';
                    }
                        // Messages at the bottom of the page.
                        echo '</ul>';
                        echo 'These are all the articles related to ';
                        echo $_GET['categoryId'];
                        echo '</br>';

                        echo '<a href="index.php"> Return home!</a>';
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
