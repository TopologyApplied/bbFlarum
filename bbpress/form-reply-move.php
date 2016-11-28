<?php

/**
 * Move Reply
 *
 * @package bbPress
 * @subpackage Theme
 */

?>


</div>
<div class="naslov text-center" style="background: <?php echo get_field('color', bbp_get_topic_forum_id()) ?>;">
    <div class="container">
		<span class="tema_status">
		<?php do_action( 'bbp_theme_before_topic_title' ); ?>
		</span>
        <?php printf( __( '<span class="kategorija text-uppercase"><a style="color: %3$s;" href="%1$s">%2$s</a></span>', 'bbpress' ), bbp_get_forum_permalink( bbp_get_topic_forum_id() ), bbp_get_forum_title( bbp_get_topic_forum_id() ), get_field('color', bbp_get_topic_forum_id()) ); ?>
        <h1><?php printf( __( 'Move reply "%s"', 'bbpress' ), bbp_get_reply_title() ); ?></h1>
    </div>
</div>
<div class="container">

    <?php if ( is_user_logged_in() && current_user_can( 'edit_topic', bbp_get_topic_id() ) ) : ?>

        <div id="move-reply-<?php bbp_topic_id(); ?>">

            <form id="move_reply" name="move_reply" method="post" action="<?php the_permalink(); ?>" class="odgovori_forma">

                <div class="alert alert-info">
                    <p><?php _e( 'You can either make this reply a new topic with a new title, or merge it into an existing topic.', 'bbpress' ); ?></p>
                </div>

                <div class="alert alert-warning">
                    <p><?php _e( 'If you choose an existing topic, replies will be ordered by the time and date they were created.', 'bbpress' ); ?></p>
                </div>

                <div class="naslovi"><h3 class="text-uppercase"><?php _e( 'Move Method', 'bbpress' ); ?></h3><hr>
                </div>


                <div class="form-group">
                    <input name="bbp_reply_move_option" id="bbp_reply_move_option_reply" type="radio" checked="checked" value="topic" tabindex="<?php bbp_tab_index(); ?>" />
                    <label for="bbp_reply_move_option_reply"><?php printf( __( 'New topic in <strong>%s</strong> titled:', 'bbpress' ), bbp_get_forum_title( bbp_get_reply_forum_id( bbp_get_reply_id() ) ) ); ?></label>
                    <input class="form-control" type="text" id="bbp_reply_move_destination_title" value="<?php printf( __( 'Moved: %s', 'bbpress' ), bbp_get_reply_title() ); ?>" tabindex="<?php bbp_tab_index(); ?>" size="35" name="bbp_reply_move_destination_title" />
                </div>

                <?php if ( bbp_has_topics( array( 'show_stickies' => false, 'post_parent' => bbp_get_reply_forum_id( bbp_get_reply_id() ), 'post__not_in' => array( bbp_get_reply_topic_id( bbp_get_reply_id() ) ) ) ) ) : ?>

                    <div class="form-group">
                        <input name="bbp_reply_move_option" id="bbp_reply_move_option_existing" type="radio" value="existing" tabindex="<?php bbp_tab_index(); ?>" />
                        <label for="bbp_reply_move_option_existing"><?php _e( 'Use an existing topic in this forum:', 'bbpress' ); ?></label>

                        <?php
                        bbp_dropdown( array(
                            'post_type'   => bbp_get_topic_post_type(),
                            'post_parent' => bbp_get_reply_forum_id( bbp_get_reply_id() ),
                            'selected'    => -1,
                            'exclude'     => bbp_get_reply_topic_id( bbp_get_reply_id() ),
                            'select_id'   => 'bbp_destination_topic'
                        ) );
                        ?>

                    </div>

                <?php endif; ?>


                <div class="alert alert-danger">
                    <p><?php _e( '<strong>WARNING:</strong> This process cannot be undone.', 'bbpress' ); ?></p>
                </div>


                <div class="form-group text-right">
                    <button type="submit" tabindex="<?php bbp_tab_index(); ?>" id="bbp_move_reply_submit" name="bbp_move_reply_submit" class="btn btn-success"><?php _e( 'Submit', 'bbpress' ); ?></button>
                </div>

                <?php bbp_move_reply_form_fields(); ?>

            </form>
        </div>

    <?php else : ?>

        <div id="no-reply-<?php bbp_reply_id(); ?>" class="bbp-no-reply">
            <div class="entry-content"><?php is_user_logged_in() ? _e( 'You do not have the permissions to edit this reply!', 'bbpress' ) : _e( 'You cannot edit this reply.', 'bbpress' ); ?></div>
        </div>

    <?php endif; ?>

</div>
