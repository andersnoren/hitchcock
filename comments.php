<?php 
if ( post_password_required() ) 
	return; 

if ( have_comments() || comments_open() ) : ?>

	<div class="comments-container">
		
		<?php if ( have_comments() ) : ?>
	
			<div class="comments-inner">
			
				<a name="comments"></a>
				
				<h3 class="comments-title">
					
					<div class="inner">
				
						<?php 
						$comments_count = count( $wp_query->comments_by_type['comment'] );
						echo $comments_count . ' ' . _n( 'Comment', 'Comments', $comments_count, 'hitchcock' ); ?>
					
					</div>
					
				</h3>
			
				<div class="comments">
			
					<ol class="commentlist">
					    <?php wp_list_comments( array( 'type' => 'comment', 'callback' => 'hitchcock_comment' ) ); ?>
					</ol>
					
					<?php if ( ! empty( $comments_by_type['pings'] ) ) : ?>
					
						<div class="pingbacks">
											
							<h3 class="pingbacks-title">
							
								<?php 
								$pings_count = count( $wp_query->comments_by_type['pings'] );
								echo $pings_count . ' ' . _n( 'Pingback', 'Pingbacks', $pings_count, 'hitchcock' ); ?>
							
							</h3>
						
							<ol class="pingbacklist">
							    <?php wp_list_comments( array( 'type' => 'pings', 'callback' => 'hitchcock_comment' ) ); ?>
							</ol>
								
						</div><!-- .pingbacks -->
					
					<?php endif; ?>
							
					<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
						
						<div class="comments-nav" role="navigation">
						
							<div class="fleft">
												
								<?php previous_comments_link( '&larr; ' . __( 'Older', 'hitchcock' ) ); ?>
							
							</div>
							
							<div class="fright">
							
								<?php next_comments_link( __( 'Newer', 'hitchcock' ) . ' &rarr;' ); ?>
							
							</div>
							
							<div class="clear"></div>
							
						</div><!-- .comment-nav-below -->
						
					<?php endif; ?>
					
				</div><!-- .comments -->
				
			</div><!-- .comments-inner -->
			
		<?php endif; ?>

		<?php $comments_args = array(
			
			'title_reply' =>
				'<div class="inner">' . __( 'Leave a Reply', 'hitchcock' ) . '</div>',
			
			'comment_notes_before' => 
				'',
				
			'comment_notes_after' =>
				'',
		
			'comment_field' => 
				'<p class="comment-form-comment">
					<label for="comment">' . __( 'Comment', 'hitchcock' ) . '</label>
					<textarea id="comment" name="comment" cols="45" rows="6" required></textarea>
				</p>',
		);
		
		comment_form( $comments_args );
		
		?>
		
	</div><!-- .comments-container -->
	
<?php endif; ?>