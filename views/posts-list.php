<section class="post-list-section">
	<div class="post-list">
		<h1 class="post-list-header">
			<?php
				if ($posts_query->have_posts()) {
			?>
			Latest
			<?php
				echo $posts_query->post_count;
				}
			?>
			posts
		</h1>
		<div class="post-list-items">
			<?php
				if ($posts_query->have_posts()) {
					while ($posts_query->have_posts()) {
						$posts_query->the_post();
                        $postId = get_the_ID();
                        $postThumbnail = get_the_post_thumbnail_url($postId, 'thumbnail');

			?>
			<div class="post-list-item-wrapper">
				<div class="post-list-item">
                    <?php
                        if ($postThumbnail) {
                    ?>
                        <img
                            class="post-item-image"
                            src="<?php echo $postThumbnail ?>"
                            alt="hh"
                        />
                    <?php } ?>
                    <a href="<?php echo esc_url(get_permalink($postId)) ?>">
                        <h4><?php echo get_the_title() ?></h4>
                    </a>

					<p><?php echo get_the_content() ?></p>
                    <div class="post-items-footer">
                        <p class="post-item-date">
                            <?php echo get_the_date('Y-m-d') ?>
                        </p>
                        <p class="dashicons dashicons-admin-comments"></p>
                        <a href="<?php echo esc_url(get_comments_link($postId)) ?>">
                            <?php echo get_comments_number($postId) ?>
                        </a>
                    </div>

				</div>
			</div>
			<?php
					}
				}
			?>
		</div>
	</div>
	<?php if (!$posts_query->have_posts()) { ?>
        <h1 class="post-list-header">>No posts found. Want to
            <a href="http://localhost/wp-admin/post-new.php">add</a>
            some?
        </h1>
	<?php } ?>

</section>
