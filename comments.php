
<div class="container">
<h4 class="btitle">
    <?php
        printf( _nx( 'One thought on "%2$s"', '%1$s comments on "%2$s"', get_comments_number(), 'comments title', 'copireland' ),
            number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
    ?>
</h4>
<?php if ( have_comments() ) : ?>
        <?php
        //Get only the approved comments 
        $args = array(
            'status' => 'approve'
        );
         
        // The comment Query
        $comments_query = new WP_Comment_Query;
        $comments = $comments_query->query( $args );
         
        // Comment Loop
        if ( $comments ) {
            foreach ( $comments as $comment ) {
                echo '<p>' . $comment->comment_content . '</p>';
            }
        } else {
            echo 'No comments found.';
        }
        ?>
        <ol class="comment-list">
            <?php
                wp_list_comments( array(
                    'style'       => 'ol',
                    'short_ping'  => true,
                    'avatar_size' => 34,
                ) );
            ?>
        </ol><!-- .comment-list -->
        <div class="pagination">
            <?php paginate_comments_links(); ?>
        </div>
        <?php if ( ! comments_open() && get_comments_number() ) : ?>
        <p class="no-comments"><?php _e( 'Comments are closed.' , 'twentythirteen' ); ?></p>
        <?php endif; ?>
<?php endif; // have_comments() ?>

<?php comment_form(); ?>
</div>