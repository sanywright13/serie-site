<?php
if ( post_password_required() ) {
	return;
}

$discussion = theme_get_discussion_data();
?>

<div id="comments" class="<?php echo comments_open() ? 'comments-area' : 'comments-area comments-closed'; ?>">
	<div class="<?php echo $discussion->responses > 0 ? 'comments-title-wrap' : 'comments-title-wrap no-responses'; ?>">
		<div class="comments-title">
		<?php
		if ( comments_open() ) {
			if ( have_comments() ) {
				_e( '', 'BootSTheme' );
			} else {
				_e( '','BootSTheme');
			}
		} else {
			if ( '1' == $discussion->responses ) {
				/* translators: %s: post title */
				printf( _x( 'une réponse sur &ldquo;%s&rdquo;', 'comments title', 'BootSTheme' ), get_the_title() );
			} else {
				printf(
					/* translators: 1: number of comments, 2: post title */
					_nx(
						'%1$s répondre à &ldquo;%2$s&rdquo;',
						'%1$s répondre à &ldquo;%2$s&rdquo;',
						$discussion->responses,
						'comments title',
						'BootSTheme'
					),
					number_format_i18n( $discussion->responses ),
					get_the_title()
				);
			}
		}
		?>
		</div><!-- .comments-title -->
		<?php
			// Only show discussion meta information when comments are open and available.
		if ( have_comments() && comments_open() ) {
			get_template_part( '/discussion', 'meta' );
		}
		?>
	</div><!-- .comments-title-flex -->
	<?php
	if ( have_comments() ) :

		// Show comment form at top if showing newest comments at the top.
		if ( comments_open() ) {
			theme_comment_form( 'desc' );
		}

		?>
		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'walker'      => new Theme_Walker_Comment(),
					'avatar_size' => theme_get_avatar_size(),
					'short_ping'  => true,
					'style'       => 'ol',
				)
			);
			?>

		</ol><!-- .comment-list -->
		<?php

		// Show comment navigation
		if ( have_comments() ) :
			$prev_icon     = theme_get_icon_svg( 'chevron_left', 22 );
			$next_icon     = theme_get_icon_svg( 'chevron_right', 22 );
			$comments_text = __( 'Comments', 'BootSTheme' );
			the_comments_navigation(
				array(
					'prev_text' => sprintf( '%s <span class="nav-prev-text"><span class="primary-text">%s</span> <span class="secondary-text">%s</span></span>', $prev_icon, __( 'Previous', 'BootSTheme' ), __( 'Comments', 'BootSTheme' ) ),
					'next_text' => sprintf( '<span class="nav-next-text"><span class="primary-text">%s</span> <span class="secondary-text">%s</span></span> %s', __( 'Next', 'BootSTheme' ), __( 'Comments', 'BootSTheme' ), $next_icon ),
				)
			);
		endif;

		// Show comment form at bottom if showing newest comments at the bottom.
		if ( comments_open() && 'asc' === strtolower( get_option( 'comment_order', 'asc' ) ) ) :
			?>
			<div class="comment-form-flex">
				<?php theme_comment_form( 'asc' ); ?>
				<h2 class="comments-title" aria-hidden="true"><?php  /* _e( 'Laisser Un Commentaire', 'BootSTheme' ); */
				?></h2>
			</div>
			<?php
		endif;

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments">
				<?php _e( 'Les commentaires sont fermés.', 'BootSTheme' ); ?>
			</p>
			<?php
		endif;

	else :

		// Show comment form.
		theme_comment_form( true );

	endif; // if have_comments();
	?>
</div><!-- #comments -->
