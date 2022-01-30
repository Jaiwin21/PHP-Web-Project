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

        // If submit is pressed the new data will be inserted as an update within the table and attributes listed below.
        // Code for editing articles all found from the lecture slides https://nile.northampton.ac.uk/ 
        // Topic 9 Lecture slides and exercise solutions {games.zip file}.    
        if (isset($_POST['submit'])) {
            $stmt = $pdo->prepare('UPDATE article
                                SET title = :title, articleauthor = :articleauthor, publishDate = :publishDate, categoryId = :categoryId, 
                                content = :content
                                    WHERE article_id = :article_id');

                    $values = [
                        'title' => $_POST['title'],
                        'articleauthor' => $_POST['articleauthor'],
                        'publishDate' => $_POST['publishDate'],
                        'categoryId' => $_POST['categoryId'],
                        'content' => $_POST['content'],
                        'article_id' => $_POST['article_id']
                    ]; 


                                $stmt->execute($values);
                                echo 'Article has been altered!';
                                echo '</br>';
                                echo '<a href="adminArticles.php">Click here to edit more!';

                            }

                    // Logincheck to see if it is an admin account. If so it will print the pre-filled forms.
                    if (isset($_SESSION['adminloggedin']) && $_SESSION['adminloggedin'] == true ) {
                    if (isset($_GET['article_id'])) {

                        $stmt = $pdo->prepare('SELECT * FROM article WHERE article_id = :article_id');
                    
                        $values = [
                            'article_id' => $_GET['article_id']
                        ];
                    
                        $stmt->execute($values);
                    
                        $user = $stmt->fetch();

                ?>
                <!-- The form that will contain prefilled data from the database which can be altered on the website and updated in the system. -->
                <form action="editArticle.php" method="POST">
                <label>Article ID:</label>
                <input type="hidden" name="article_id" value="<?php echo $user['article_id']; ?>" />  
                <label>Article name:</label>
                <input type="text" name="title" value="<?php echo $user['title']; ?>" />
                <label>Author:</label>
                <input type="text" name="articleauthor" value="<?php echo $user['articleauthor']; ?>" />
                <label>Date of publish:</label>
                <input type="text" name="publishDate" value="<?php echo $user['publishDate']; ?>" />
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
            
                <label>Article:</label>
                <textarea id="content" name="content" rows="10" cols="100"><?php echo $user['content']; ?>  </textarea>
                
    
                <input type="submit" name="submit" value=submit />
                
                </form>

                <?php 
                        } 
                    }  
                    
                    else {

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
