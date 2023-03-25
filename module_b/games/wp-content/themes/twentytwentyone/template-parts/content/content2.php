<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="card-article">
        <div class="card-article-image">
            <?php echo the_post_thumbnail(); ?>
        </div>
        <div class="card-article-content">
            <div class="card-article-title">
                <h2><?php echo the_title(); ?></h2>
            </div>
            <div class="card-article-excerpt">
                <p><?php echo the_excerpt(); ?></p>
            </div>
            <div class="card-article-meta">
                <span class="card-article-date">
                    <?php echo the_date(); ?>
                </span>
            </div>
        </div>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->