<head>
		<link rel="stylesheet" href="styles.css"/>
		<title>Northampton News - Home</title>
	</head>
	<body>
		<header>
			<section>
				<h1>Northampton News</h1>
			</section>
		</header>
		<nav>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="allArticle.php">Latest Articles</a></li>
				<li><a href="#">Select Category</a>

								<?php
					$stmt = $pdo->prepare('SELECT * FROM category');
					$stmt->execute();
					?>

					<a class="articleLink" href="#"><?php 	


											echo '<ul>';
											foreach ($stmt as $row) {
												echo '<li>';
												echo '<a href = "categorySearch.php?categoryId=' . $row['categoryId'] . '"> ' . $row['name'] . '</a>';
												
												echo '</li>';
											}
											echo '</ul>';

											?>
																	
						 </a></li>
						
						<li><a href="login.php">Login</a></li>
						<?php
						 if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
						 echo '<li><a href="logout.php">Log off</a></li>'; 
						}
						if (isset($_SESSION['adminloggedin']) && $_SESSION['adminloggedin'] == true) {
							echo '<li><a href="logout.php">Log off</a></li>'; 
						   }
						
						?>
						
						<li><a href="adminLogin.php">Administration</a></li>
					</ul>
		


			

		
		</nav>