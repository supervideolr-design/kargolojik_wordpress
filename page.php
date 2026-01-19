<?php
/**
 * Page Template
 */

get_header();
?>

<div style="max-width: 800px; margin: 0 auto; padding: 24px 16px;">
    <?php while (have_posts()): the_post(); ?>
    <article>
        <h1 style="font-size: 32px; font-weight: 700; margin-bottom: 24px;"><?php the_title(); ?></h1>
        
        <div class="page-content" style="line-height: 1.8; color: var(--text-primary);">
            <?php the_content(); ?>
        </div>
    </article>
    <?php endwhile; ?>
</div>

<?php
get_footer();
