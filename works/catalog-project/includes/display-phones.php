<div class="post-container">
	<?php while ($row = $sql_result->fetch_assoc()):?>			
		<?php extract($row); ?>
		<div class="post-wrapper">
			<a href="<?php echo BASE_URL."detail.php?phone_id=".$phone_id; ?>" class="view-details">
				<div class="img-wrapper">
					<img src="<?php echo BASE_URL."img/thumbnails/".$phone_img; ?>" alt="">
				</div>
				<h3><?php echo $phone_name; ?></h3>
			</a>
			<?php if ($_SESSION['user_id'] == $u_id): ?>
				<div class="admin-links-container">
					<a href="<?php echo BASE_URL."admin/admin?id=". $phone_id;?>" class="logged-user-button">Edit</a>
					<?php if ($deleted_yn == 'N'): ?>
						<a href="<?php echo BASE_URL."admin/delete-post?id=". $phone_id;?>" class="logged-user-button" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
					<?php else: ?>
						<p>DELETED</p>
					<?php endif ?>
				</div>
			<?php endif ?>
		</div>
	<?php endwhile ?>
</div>