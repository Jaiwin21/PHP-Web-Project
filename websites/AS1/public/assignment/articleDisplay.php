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
                               
                                if(isset($_GET['article_id'])){
                                
                                $stmt = $pdo->prepare('SELECT * FROM article WHERE article_id = :article_id');

                        
                                $values = [
                                'article_id' => $_GET['article_id']
                                ];
                        
                                $stmt->execute($values);
                        
                                $user = $stmt->fetch();
                                $title = '?article_id='.$user['article_id'];
                                $id = $_GET['article_id'];
                        
                        
                                        ?>

                                <!-- One article a page -->
                                <h1><?php echo $user['title']; ?></h1>
                                <em><?php echo $user['publishDate']; ?></em>
                                <p></p>
                                <article><?php echo $user['content']; ?> </article>
                                                              
                        <?php
                                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true ) {
                                        echo '</br>';
                                        echo '<b>Add a comment below</b>';
                                        echo '</br>';
                                } else{
                                        echo '</br>';
                                        echo '<b>Log in to add a comment below</b>';
                                        echo '</br>';
                                }
                ?>
                <?php
                    if (isset($_POST['submit'])) {
                    $stmt = $pdo->prepare('INSERT INTO comments (displayname, comment, article_id)
                    VALUES (:displayname, :comment, :article_id)
                    ');
                    $values = [
                    'displayname' => $_SESSION['displayname'],
                    'comment' => $_POST['comment'],
                    'article_id' => $user['article_id']
                    
                    ];
                    $stmt->execute($values);
                    $cmmt = $stmt->fetch();
                }

                $stmt = $pdo->prepare('SELECT displayname, comment FROM comments WHERE article_id ='. $id.'');
                $stmt->execute();
                                 
                           foreach ($stmt as $row) {
                                        
                                        echo '</br>';
                                        echo '<b>'.$row['displayname'].': '. $row['comment']; '</b>';
                                        echo '</br>';
                                       
                                       
                                                     
                                } 
                               
                        
        // If logged in the field to comment will appaear. Making it sure that users must be logged in to comment.
         if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true ) {
        ?>
        <form action="articleDisplay.php<?=$title?>" method = "POST">
        <label>Comment: </label> <input type="textarea" name="comment" />
        <input type="submit" name="submit" value="Add" />

        </form>

        
        <?php 
        }
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
