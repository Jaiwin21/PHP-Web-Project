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
                                
                                // If the title of the article is in the URL it will match it with the database information and print out all the attributes listed below.
                                // This is the only thing printed to the page. So you can have a closer look at the articles.
                                if(isset($_GET['title'])){
                                
                                $stmt = $pdo->prepare('SELECT * FROM article WHERE title = :title');
                
                                $values = [
                                'title' => $_GET['title']
                                ];
                        
                                $stmt->execute($values);
                        
                                $user = $stmt->fetch();
                        
                        
                                        ?>

                                <!-- One article a page -->
                                <h1><?php echo $user['title']; ?></h1>
                                <em><?php echo $user['publishDate']; ?></em>
                                <p></p>
                                <article><?php echo $user['content']; ?> </article>
                                <p></p>
                                <a href="index.php">Home</a>
                
            
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
