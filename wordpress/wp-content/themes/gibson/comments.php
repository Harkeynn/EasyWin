<?php if (post_password_required()) { return; } ?>
<div id="comments" class="col-md-10 col-md-offset-1">
	<?php if (have_comments()) : ?>
		<h4><?php _e('Comments', 'gibson'); ?></h4>		
		<ol class="comment-list">
			<?php wp_list_comments(array('callback' => 'gibson_comment')); ?>
		</ol>
		<?php paginate_comments_links(); ?>
		<?php if (!comments_open()) : ?>
			<p class="no-comments"><?php _e('Comments are closed.', 'gibson'); ?></p>
		<?php endif; ?>
	<?php endif; ?>
	<?php 
		$fields = array(	
			'comment_notes_before' => '<p class="comment-notes">' . __('Your email address will not be published / Required fields are marked *', 'gibson') . '</p>',		
			'fields' => apply_filters('comment_form_default_fields', array(		
				'author' => '<p><label for="author">'. __('Author', 'gibson') .'</label><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" /></p>',			
				'email' => '<p><label for="email">'. __('Email', 'gibson') .'</label><input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" /></p>',
				'url' => '<p><label for="url">'. __('Website', 'gibson') .'</label><input id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url'] ) . '" /></p>')
			),
		);	
		comment_form($fields); 
	?>
</div>