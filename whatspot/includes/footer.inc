			</div> <!-- end of main div  -->

			<div id="footer">

				<ul>

					<!-- footer, like navbar - dynamically generated depending on login status of user -->

					<li><a href="index.php">Home</a></li>
					<li><a href="search.php" onclick="getLocation();">Search</a></li>
					<li><a href="review.php">Review</a></li>					
					<?php echo $regLink; ?>
					<?php echo $logLink; ?>

				</ul>

				<!-- display date that page was served -->

				<p>Page Served on: <?php echo date("D M d, Y G:i a"); ?></p>	

			</div> <!-- end of footer div  -->

		</div> <!-- end of wrapper div  -->

	</body>

</html>