<?php get_header(); ?>

<div class="scam-alert-archive">
    <h1>آرشیو هشدارهای کلاهبرداری</h1>

    <?php if ( have_posts() ) : ?>
        <ul>
            <?php while ( have_posts() ) : the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    <p><?php the_excerpt(); ?></p>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else : ?>
        <p>هیچ هشداری یافت نشد.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
