<hr>
<form action="item.php" method="POST">
	<h2>Submit a Review</h2>
	<textarea rows="4" cols="75" maxlength="140" name="review" placeholder="Write your review here, 140 Character Limit." required></textarea>
	<br>
	<h3>Rating:
	<select name="rate">
		<option value="5">5</option>
		<option value="4">4</option>
		<option value="3">3</option>
		<option value="2">2</option>
		<option value="1">1</option>
	</select></h3>
	<?php
	// Grab the location this review is for
	if (isset($_POST['location'])) {
      $id = (int)$_POST['location'];
    } else {
      $id = (int)$_GET['id'];
    }
		echo "<input name=\"location\" type=\"hidden\" value=\"" . $id . "\">";
	?>
	<input type="submit" class="button">
</form>