<?php get_header(); ?>

<div class="scam-alert-single">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <h1><?php the_title(); ?></h1>
        <div class="scam-alert-content">
            <?php the_content(); ?>
        </div>

        <div class="scam-alert-meta">
            <p><strong>نام پروژه:</strong> <?php echo get_post_meta( get_the_ID(), '_project_name', true ); ?></p>
            <p><strong>سطح هشدار:</strong> <?php echo get_post_meta( get_the_ID(), '_alert_level', true ); ?></p>
            <p><strong>وضعیت هشدار:</strong> <?php echo get_post_meta( get_the_ID(), '_alert_status', true ); ?></p>
            <p><strong>نوع فعالیت:</strong> <?php echo get_post_meta( get_the_ID(), '_activity_type', true ); ?></p>
            <p><strong>بستر فعالیت:</strong> <?php echo get_post_meta( get_the_ID(), '_activity_platform', true ); ?></p>
            <p><strong>حوزه فعالیت:</strong> <?php echo get_post_meta( get_the_ID(), '_activity_domain', true ); ?></p>
            <p><strong>سایت‌ها:</strong> <?php echo get_post_meta( get_the_ID(), '_websites', true ); ?></p>
            <p><strong>شبکه‌های اجتماعی:</strong> <?php echo get_post_meta( get_the_ID(), '_social_media', true ); ?></p>
            <p><strong>برآورد سرمایه در گردش:</strong> <?php echo get_post_meta( get_the_ID(), '_capital_estimation', true ); ?></p>
            <p><strong>منابع:</strong> <?php echo get_post_meta( get_the_ID(), '_resources', true ); ?></p>
        </div>

    <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>
