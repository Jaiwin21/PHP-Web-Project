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
												echo '<a href = "categorySearch.php?categoryId=' . $row['name'] . '"> ' . $row['name'] . '</a>';
												// echo $row['categoryname'];
												
												echo '</li>';
											}
											echo '</ul>';

											?>
																	
						 </a></li>
						
						
						
					</ul>
		


			<a href="login.php">Login</a>
	
			<a href="logout.php">Log off</a>

		
		</nav>