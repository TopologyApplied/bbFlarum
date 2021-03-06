<?php

/**
 * New/Edit Reply
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php if ( bbp_is_reply_edit() ) : ?>
</div>
<?php printf( __( '<div class="naslov text-center" style="background: %3$s;">', 'bbpress' ), bbp_get_forum_permalink( bbp_get_topic_forum_id() ), bbp_get_forum_title( bbp_get_topic_forum_id() ), get_field('color', bbp_get_topic_forum_id()) ); ?>
<div class="container">
		<span class="tema_status">
		<?php do_action( 'bbp_theme_before_topic_title' ); ?>
		</span>
	<?php printf( __( '<span class="kategorija text-uppercase"><a style="color: %3$s;" href="%1$s">%2$s</a></span>', 'bbpress' ), bbp_get_forum_permalink( bbp_get_topic_forum_id() ), bbp_get_forum_title( bbp_get_topic_forum_id() ), get_field('color', bbp_get_topic_forum_id()) ); ?>
	<h1><?php echo bbp_get_reply_title(); ?></h1>
</div>
</div>
<div class="container">
<?php endif; ?>

<?php if ( bbp_current_user_can_access_create_reply_form() ) : ?>

	<?php if ( bbp_is_reply_edit() ) : ?>
		<form name="new-post" method="post" action="<?php the_permalink(); ?>" class="odgovori_forma">
		<?php else: ?>
		<form id="new-post" name="new-post" method="post" action="<?php the_permalink(); ?>"  class="odgovori_forma">
			<div class="row">
				<div class="col-md-12">
					<div class="zatvori pull-right">&times;</div>
				</div>
			</div>
		<?php endif; ?>
			<?php do_action( 'bbp_theme_before_reply_form' ); ?>


				<?php do_action( 'bbp_theme_before_reply_form_notices' ); ?>

				<?php if ( !bbp_is_topic_open() && !bbp_is_reply_edit() ) : ?>

					<div class="alert alert-warning">
						<p><?php _e( 'This topic is marked as closed to new replies, however your posting capabilities still allow you to do so.', 'bbpress' ); ?></p>
					</div>

				<?php endif; ?>

				<?php if ( current_user_can( 'unfiltered_html' ) ) : ?>

					<div class="alert alert-success">
						<p><?php _e( 'Your account has the ability to post unrestricted HTML content.', 'bbpress' ); ?></p>
					</div>

				<?php endif; ?>

				<?php do_action( 'bbp_template_notices' ); ?>

				<div>

					<div class="form-group">
					<?php bbp_get_template_part( 'form', 'anonymous' ); ?>

					<?php do_action( 'bbp_theme_before_reply_form_content' ); ?>

					<?php bbp_the_content( array( 'context' => 'reply' ) ); ?>

					<?php do_action( 'bbp_theme_after_reply_form_content' ); ?>
					</div>

					<?php if ( ! ( bbp_use_wp_editor() || current_user_can( 'unfiltered_html' ) ) ) : ?>

						<p class="form-allowed-tags">
							<label><?php _e( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:','bbpress' ); ?></label><br />
							<code><?php bbp_allowed_tags(); ?></code>
						</p>

					<?php endif; ?>

<!--					--><?php //if ( bbp_allow_topic_tags() && current_user_can( 'assign_topic_tags' ) ) : ?>
<!---->
<!--						--><?php //do_action( 'bbp_theme_before_reply_form_tags' ); ?>
<!---->
<!--						<div class="form-group">-->
<!--							<label for="bbp_topic_tags">--><?php //_e( 'Tags:', 'bbpress' ); ?><!--</label><br />-->
<!--							<input type="text" value="--><?php //bbp_form_topic_tags(); ?><!--" tabindex="--><?php //bbp_tab_index(); ?><!--" size="40" name="bbp_topic_tags" id="bbp_topic_tags" --><?php //disabled( bbp_is_topic_spam() ); ?><!-- class="form-control" />-->
<!--						</div>-->
<!---->
<!--						--><?php //do_action( 'bbp_theme_after_reply_form_tags' ); ?>
<!---->
<!--					--><?php //endif; ?>

					<?php if ( bbp_is_subscriptions_active() && !bbp_is_anonymous() && ( !bbp_is_reply_edit() || ( bbp_is_reply_edit() && !bbp_is_reply_anonymous() ) ) ) : ?>

						<?php do_action( 'bbp_theme_before_reply_form_subscription' ); ?>

						<p>

							<input name="bbp_topic_subscription" id="bbp_topic_subscription" type="checkbox" value="bbp_subscribe"<?php bbp_form_topic_subscribed(); ?> tabindex="<?php bbp_tab_index(); ?>" checked />

							<?php if ( bbp_is_reply_edit() && ( bbp_get_reply_author_id() !== bbp_get_current_user_id() ) ) : ?>

								<?php _e( 'Notify the author of follow-up replies via email', 'bbpress' ); ?>

							<?php else : ?>

								<?php _e( 'Notify me of follow-up replies via email', 'bbpress' ); ?>

							<?php endif; ?>

						</p>

						<?php do_action( 'bbp_theme_after_reply_form_subscription' ); ?>

					<?php endif; ?>

					<?php if ( bbp_allow_revisions() && bbp_is_reply_edit() ) : ?>

						<?php do_action( 'bbp_theme_before_reply_form_revisions' ); ?>

							<div class="form-group">
								<input name="bbp_log_reply_edit" id="bbp_log_reply_edit" type="checkbox" value="1" <?php bbp_form_reply_log_edit(); ?> tabindex="<?php bbp_tab_index(); ?>" />
								<?php _e( 'Keep a log of this edit:', 'bbpress' ); ?>
								<hr>

							</div>
							<div class="form-group">
								<?php printf( __( 'Optional reason for editing:', 'bbpress' ), bbp_get_current_user_name() ); ?><br />
								<input type="text" value="<?php bbp_form_reply_edit_reason(); ?>" tabindex="<?php bbp_tab_index(); ?>" size="40" name="bbp_reply_edit_reason" id="bbp_reply_edit_reason" class="form-control" />
							</div>

						<?php do_action( 'bbp_theme_after_reply_form_revisions' ); ?>

					<?php endif; ?>

					<?php do_action( 'bbp_theme_before_reply_form_submit_wrapper' ); ?>

					<div class="form-group text-right">

						<?php do_action( 'bbp_theme_before_reply_form_submit_button' ); ?>

						<?php bbp_cancel_reply_to_link(); ?>

						<button type="submit" tabindex="<?php bbp_tab_index(); ?>" id="bbp_reply_submit" name="bbp_reply_submit" class="btn btn-success"><?php _e( 'Submit', 'bbpress' ); ?></button>

						<?php do_action( 'bbp_theme_after_reply_form_submit_button' ); ?>

					</div>

					<?php do_action( 'bbp_theme_after_reply_form_submit_wrapper' ); ?>

				</div>

				<?php bbp_reply_form_fields(); ?>


			<?php do_action( 'bbp_theme_after_reply_form' ); ?>

		</form>

<?php elseif ( bbp_is_topic_closed() ) : ?>

	<div id="no-reply-<?php bbp_topic_id(); ?>" class="bbp-no-reply">
		<div class="alert alert-warning text-center">
			<p><?php printf( __( 'The topic &#8216;%s&#8217; is closed to new replies.', 'bbpress' ), bbp_get_topic_title() ); ?></p>
		</div>
	</div>

<?php elseif ( bbp_is_forum_closed( bbp_get_topic_forum_id() ) ) : ?>

	<div id="no-reply-<?php bbp_topic_id(); ?>" class="bbp-no-reply">
		<div class="alert alert-warning">
			<p><?php printf( __( 'The forum &#8216;%s&#8217; is closed to new topics and replies.', 'bbpress' ), bbp_get_forum_title( bbp_get_topic_forum_id() ) ); ?></p>
		</div>
	</div>

<?php else : ?>

	<div id="no-reply-<?php bbp_topic_id(); ?>" class="bbp-no-reply">
		<div class="alert alert-warning">
			<p><?php is_user_logged_in() ? _e( 'You cannot reply to this topic.', 'bbpress' ) : _e( 'You must be logged in to reply to this topic.', 'bbpress' ); ?></p>
		</div>
	</div>

<?php endif; ?>

<?php if ( bbp_is_reply_edit() ) : ?>

<?php endif; ?>
