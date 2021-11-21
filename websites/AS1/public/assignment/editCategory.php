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


            // If submit is pressed the new data will be inserted as an update into the table and attributes listed below.  
            // Code for editing categories all found from the lecture slides https://nile.northampton.ac.uk/ 
            // Topic 9 Lecture slides and exercise solutions {games.zip file}.    
            if (isset($_POST['submit'])) {
                $stmt = $pdo->prepare('UPDATE category
                                    SET name = :name
                                        WHERE categoryId = :categoryId');

                $values = [
                    'name' => $_POST['name'],
                    'categoryId' => $_POST['categoryId']
                ]; 


                    $stmt->execute($values);
                    echo 'Category has been altered!';
                    echo '</br>';
                    echo '<a href="adminArticles.php">Click here to edit more!';

                }

                            // If the submit is not pressed then simply print out the prefilled form with the data that may need updating.
                            else if (isset($_GET['categoryId'])) {

                                $stmt = $pdo->prepare('SELECT * FROM category WHERE categoryId = :categoryId');
                            
                                $values = [
                                    'categoryId' => $_GET['categoryId']
                                ];
                            
                                $stmt->execute($values);
                            
                                $user = $stmt->fetch();


                ?>

                <!-- The form that will contain prefilled data from the database which can be altered on the website and updated in the system. -->
                <form action="editCategory.php" method="POST">
                <label>Category ID:</label>
                <input type="hidden" name="categoryId" value="<?php echo $user['categoryId']; ?>" />  
                <label>Category name:</label>
                <input type="text" name="name" value="<?php echo $user['name']; ?>" />                
    
                <input type="submit" name="submit" value=submit />
                
                </form>


                <?php 
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
