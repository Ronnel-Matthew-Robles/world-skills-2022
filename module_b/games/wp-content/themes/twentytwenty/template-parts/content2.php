<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

    <div class="card-article">
        <div class="card-article-image">
            <?php the_post_thumbnail(); ?>
        </div>
        <div class="card-article-content">
            <h2 class="card-article-title"><a href="#"><?php the_title(); ?></a></h2>
            <div class="card-article-excerpt">
                <p><?php the_excerpt(); ?></p>
            </div>
            <div class="card-article-meta">
                <span class="card-article-date"><?php the_date(); ?></span>
            </div>
        </div>
    </div>

</article><!-- .post -->