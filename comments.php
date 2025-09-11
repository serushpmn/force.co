<?php
// ...existing code...

if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _n( 'یک نظر', '%s نظر', get_comments_number(), 'force' ), number_format_i18n( get_comments_number() ) );
			?>
		</h2>

		<ol class="comment-list">
			<?php
			// callback to format each comment
			function force_comment_format( $comment, $args, $depth ) {
				$GLOBALS['comment'] = $comment;
				$rating = get_comment_meta( $comment->comment_ID, 'rating', true );
				?>
				<li id="comment-<?php comment_ID(); ?>" <?php comment_class( 'comment-card' ); ?>>
					<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
						<footer class="comment-meta">
							<div class="comment-author vcard">
								<?php echo get_avatar( $comment, 48 ); ?>
								<b class="fn"><?php comment_author(); ?></b>
								<span class="comment-date"><?php echo get_comment_date( '', $comment ); ?></span>
							</div>
							<?php if ( $rating !== '' && $rating !== false ) : ?>
								<div class="comment-rating-wrap">
									<?php
										if ( function_exists( 'force_get_rating_stars' ) ) {
											echo force_get_rating_stars( $rating );
										} else {
											// fallback
											for ( $i = 1; $i <= 5; $i++ ) {
												echo $i <= intval( $rating ) ? '<span class="star filled">★</span>' : '<span class="star">☆</span>';
											}
										}
									?>
								</div>
							<?php endif; ?>
						</footer>

						<div class="comment-content">
							<?php comment_text(); ?>
						</div>

						<div class="comment-actions">
							<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
						</div>
					</article>
				</li>
				<?php
			}

			wp_list_comments( array(
				'style'      => 'ol',
				'short_ping' => true,
				'avatar_size'=> 48,
				'callback'   => 'force_comment_format',
			) );
			?>
		</ol>

		<?php the_comments_navigation(); ?>

	<?php endif; ?>

	<?php
	// show comment form (rating field is appended via hooks in functions.php)
	comment_form( array(
		'title_reply' => 'ارسال نظر',
		'comment_notes_after' => '',
	) );
	?>

</div><!-- #comments -->

<?php
// ...existing code...