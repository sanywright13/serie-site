<?php
if ( ! function_exists( 'theme_comment_form' ) ) :
	/**
	 * Documentation for function.
	 */
	function theme_comment_form( $order ) {
		if ( true === $order || strtolower( $order ) === strtolower( get_option( 'comment_order', 'asc' ) ) ) {
$args=array(
'class_submit'=>'btn  btn-info',
'comment_field' =>
				'<div class="form-group"><p><label for="comment">' . _x( 'Comment', 'noun' ) . '</label> <span class="required">*</span><textarea id="comment" class="form-control" name="comment" rows="4" required="required"></textarea></p></div>','logged_in_as' => null,
					'title_reply'  => null


);
			comment_form(
				$args);
		}
	}
endif;
function theme_get_icon_svg( $icon, $size = 24 ) {
	return Theme_SVG_Icons::get_svg( 'ui', $icon, $size );
}


/**
 * Changes comment form default fields.
 */
function theme_comment_form_defaults( $defaults ) {
	$comment_field = $defaults['comment_field'];

	// Adjust height of comment form.
	$defaults['comment_field'] = preg_replace( '/rows="\d+"/', 'rows="5"', $comment_field );

	return $defaults;
}
add_filter( 'comment_form_defaults', 'theme_comment_form_defaults' );

/**
 * Returns true if comment is by author of the post.
 *
 * @see get_comment_class()
 */
function theme_is_comment_by_post_author( $comment = null ) {
	if ( is_object( $comment ) && $comment->user_id > 0 ) {
		$user = get_userdata( $comment->user_id );
		$post = get_post( $comment->comment_post_ID );
		if ( ! empty( $user ) && ! empty( $post ) ) {
			return $comment->user_id === $post->post_author;
		}
	}
	return false;
}

/**
 * Returns information about the current post's discussion, with cache support.
 */
function theme_get_discussion_data() {
	static $discussion, $post_id;

	$current_post_id = get_the_ID();
	if ( $current_post_id === $post_id ) {
		return $discussion; /* If we have discussion information for post ID, return cached object */
	} else {
		$post_id = $current_post_id;
	}

	$comments = get_comments(
		array(
			'post_id' => $current_post_id,
			'orderby' => 'comment_date_gmt',
			'order'   => get_option( 'comment_order', 'asc' ), /* Respect comment order from Settings » Discussion. */
			'status'  => 'approve',
			'number'  => 20, /* Only retrieve the last 20 comments, as the end goal is just 6 unique authors */
		)
	);

	$authors = array();
	foreach ( $comments as $comment ) {
		$authors[] = ( (int) $comment->user_id > 0 ) ? (int) $comment->user_id : $comment->comment_author_email;
	}

	$authors    = array_unique( $authors );
	$discussion = (object) array(
		'authors'   => array_slice( $authors, 0, 6 ),           /* Six unique authors commenting on the post. */
		'responses' => get_comments_number( $current_post_id ), /* Number of responses. */
	);

	return $discussion;
}
function theme_get_avatar_size() {
	return 60;
}
 function theme_discussion_avatars_list( $comment_authors ) {
    if ( empty( $comment_authors ) ) {
      return;
    }
    echo '<ol class="discussion-avatar-list">', "\n";
    foreach ( $comment_authors as $id_or_email ) {
      printf(
        "<li>%s</li>\n",
        theme_get_user_avatar_markup( $id_or_email )
      );
    }
    echo '</ol><!-- .discussion-avatar-list -->', "\n";
  }
    function theme_get_user_avatar_markup( $id_or_email = null ) {

    if ( ! isset( $id_or_email ) ) {
      $id_or_email = get_current_user_id();
    }

    return sprintf( '<div class="comment-user-avatar comment-author vcard">%s</div>', get_avatar( $id_or_email, theme_get_avatar_size() ) );
  }
 