<?php
/* ------------------------------------------------------------------------------------------------------------
	
	Comments Template
	
------------------------------------------------------------------------------------------------------------ */
?>
	
	<div id="comments">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'jwlocalize' ); ?></p>
	</div><!-- #comments -->
	<?php
			/* Stop the rest of comments.php from being processed,
			 * but don't kill the script entirely -- we still have
			 * to fully load the template.
			 */
			return;
		endif;
	?>

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		
		<h3 id="comments-heading" class="align-center">
			<?php
				printf( _n( 'One Comment', '%1$s Comments', get_comments_number(), 'jwlocalize' ), number_format_i18n( get_comments_number() ), get_the_title() );
			?>
		</h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'jwlocalize' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'jwlocalize' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'jwlocalize' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<ol class="commentlist">
			<?php
				wp_list_comments( array( 'callback' => 'jw_comment_layout' ) );
			?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'jwlocalize' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'jwlocalize' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'jwlocalize' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

	<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'jwlocalize' ); ?></p>
	<?php else: ?>
		<h3 class="align-center margin-none"><?php _e( 'There are no comments yet.', 'jwlocalize' ); ?></h3>
	<?php endif; ?>
	
	<?php
		
		$jw_comment_form_fields = array(
			'author' => '<p class="comment-form-author">' .
				'<span class="comment-form-field-label"><label for="author">' . __( 'Name', 'jwlocalize' ) . '</label> ' .
				( $req ? '<span class="required">*</span></span>' : '' ) .
				'<input id="author" name="author" type="text" value="' .
				esc_attr( $commenter['comment_author'] ) . '" size="30" tabindex="1" />' .
				'</p><!-- #form-section-author .form-section -->',
			'email'  => '<p class="comment-form-email">' .
				'<span class="comment-form-field-label"><label for="email">' . __( 'Email', 'jwlocalize' ) . '</label> ' .
				( $req ? '<span class="required">*</span></span>' : '' ) .
				'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" tabindex="2" />' .
				'</p><!-- #form-section-email .form-section -->',
			'url'    => '<p class="comment-form-url">' .
				'<span class="comment-form-field-label"><label for="url">' . __( 'Website', 'jwlocalize' ) . '</label></span>' .
				'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" tabindex="3" />' .
				'</p><!-- #form-section-url .form-section -->'
		);
		
		$jw_comment_form = array(
			'fields' => apply_filters('comment_form_default_fields', $jw_comment_form_fields),
			'title_reply' => 'Leave a Comment',
			'title_reply_to' => 'Leave a Comment to %s', 
			'comment_field' => '<p class="comment-form-comment">' .
                '<textarea id="comment" name="comment" tabindex="4" aria-required="true"></textarea>' .
                '</p><!-- #form-section-comment .form-section -->',
		);
		
	?>

</div><!-- #comments -->

<div class="separator big"></div>

<div id="leave-comment">

	<?php comment_form($jw_comment_form); ?>
	
</div>
