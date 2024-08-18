<?php
//spam section
//

function enqueue_admin_scam_alert_styles($hook) {
    if ('post.php' !== $hook && 'post-new.php' !== $hook) {
        return;
    }
    
    global $post;
    if ($post->post_type === 'scam_alert') {
        wp_enqueue_style('scam-alert-admin-style', get_template_directory_uri() . '/includes/style.css');
    }
}
add_action('admin_enqueue_scripts', 'enqueue_admin_scam_alert_styles');


function create_scam_alert_post_type() {
    $labels = array(
        'name'                  => 'هشدار کلاهبرداری',
        'singular_name'         => 'هشدار کلاهبرداری',
        'menu_name'             => 'هشدارهای کلاهبرداری',
        'name_admin_bar'        => 'هشدار کلاهبرداری',
        'add_new'               => 'افزودن جدید',
        'add_new_item'          => 'افزودن هشدار کلاهبرداری جدید',
        'new_item'              => 'هشدار کلاهبرداری جدید',
        'edit_item'             => 'ویرایش هشدار کلاهبرداری',
        'view_item'             => 'مشاهده هشدار کلاهبرداری',
        'all_items'             => 'همه هشدارهای کلاهبرداری',
        'search_items'          => 'جستجوی هشدارهای کلاهبرداری',
        'not_found'             => 'هشداری یافت نشد',
        'not_found_in_trash'    => 'هشداری در زباله‌دان یافت نشد',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'scam-alert' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-warning', 
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'comments' ),
    );

    register_post_type( 'scam_alert', $args );
}

add_action( 'init', 'create_scam_alert_post_type' );


function scam_alert_add_meta_boxes() {
    add_meta_box(
		'scam_alert_details',    
		'جزئیات هشدار کلاهبرداری', 
		'scam_alert_meta_box_callback', 
		'scam_alert',             
		'normal',                  
		'high'                   
	);
}
add_action( 'add_meta_boxes', 'scam_alert_add_meta_boxes' );

function scam_alert_meta_box_callback( $post ) {
    
    wp_nonce_field( 'save_scam_alert_meta_box_data', 'scam_alert_nonce' );

    
    $project_name = get_post_meta( $post->ID, '_project_name', true );
    $alert_level = get_post_meta( $post->ID, '_alert_level', true );
    $alert_status = get_post_meta( $post->ID, '_alert_status', true );
    $activity_type = get_post_meta( $post->ID, '_activity_type', true );
    $activity_platform = get_post_meta( $post->ID, '_activity_platform', true );
    $activity_domain = get_post_meta( $post->ID, '_activity_domain', true );
    $websites = get_post_meta( $post->ID, '_websites', true );
    $social_media = get_post_meta( $post->ID, '_social_media', true );
    $capital_estimation = get_post_meta( $post->ID, '_capital_estimation', true );
    $resources = get_post_meta( $post->ID, '_resources', true );

    echo '<div class="scam-alert-fields">';

    echo '<div>';
    echo '<label for="project_name">نام پروژه:</label>';
    echo '<input type="text" id="project_name" name="project_name" value="' . esc_attr( $project_name ) . '" />';
    echo '</div>';

	echo '<div>';
    echo '<label for="alert_status">وضعیت هشدار:</label>';
    echo '<select id="alert_status" name="alert_status">
            <option value="در جریان" ' . selected( $alert_status, 'فعال', false ) . '>در جریان</option>
            <option value="اتمام" ' . selected( $alert_status, 'غیرفعال', false ) . '>اتمام</option>
          </select>';
    echo '</div>';

    echo '<div>';
    echo '<label for="alert_level">سطح هشدار:</label>';
    echo '<select id="alert_level" name="alert_level">
			<option value="هشدار" ' . selected( $alert_level, 'هشدار', false ) . '>هشدار</option>
            <option value="هشدار کلاهبرداری" ' . selected( $alert_level, 'هشدار کلاهبرداری', false ) . '>هشدار کلاهبرداری</option>
            <option value="هشدار شرکت هرمی" ' . selected( $alert_level, 'هشدار شرکت هرمی', false ) . '>هشدار شرکت هرمی</option>
          </select>';
    echo '</div>';

    

    echo '<div>';
    echo '<label for="activity_type">نوع فعالیت:</label>';
    echo '<input type="text" id="activity_type" name="activity_type" value="' . esc_attr( $activity_type ) . '" />';
    echo '</div>';

    echo '<div>';
    echo '<label for="activity_platform">بستر فعالیت:</label>';
    echo '<input type="text" id="activity_platform" name="activity_platform" value="' . esc_attr( $activity_platform ) . '" />';
    echo '</div>';

    echo '<div>';
    echo '<label for="activity_domain">حوزه فعالیت:</label>';
    echo '<input type="text" id="activity_domain" name="activity_domain" value="' . esc_attr( $activity_domain ) . '" />';
    echo '</div>';

    echo '<div>';
    echo '<label for="websites">سایت‌ها:</label>';
    echo '<input type="text" id="websites" name="websites" value="' . esc_attr( $websites ) . '" />';
    echo '</div>';

    echo '<div>';
    echo '<label for="social_media">شبکه‌های اجتماعی:</label>';
    echo '<input type="text" id="social_media" name="social_media" value="' . esc_attr( $social_media ) . '" />';
    echo '</div>';

    echo '<div>';
    echo '<label for="capital_estimation">برآورد سرمایه در گردش:</label>';
    echo '<input type="text" id="capital_estimation" name="capital_estimation" value="' . esc_attr( $capital_estimation ) . '" />';
    echo '</div>';

    echo '<div>';

    echo '<label for="resources">منابع:</label>';
    echo '<input type="text" id="resources" name="resources" value="' . esc_attr( $resources ) . '" />';
    echo '</div>';

    echo '</div>'; 
}

function save_scam_alert_meta_box_data( $post_id ) {
    if ( ! isset( $_POST['scam_alert_nonce'] ) ) {
        return;
    }
    if ( ! wp_verify_nonce( $_POST['scam_alert_nonce'], 'save_scam_alert_meta_box_data' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['project_name'] ) ) {
        update_post_meta( $post_id, '_project_name', sanitize_text_field( $_POST['project_name'] ) );
    }

    if ( isset( $_POST['alert_level'] ) ) {
        update_post_meta( $post_id, '_alert_level', sanitize_text_field( $_POST['alert_level'] ) );
    }

    if ( isset( $_POST['alert_status'] ) ) {
        update_post_meta( $post_id, '_alert_status', sanitize_text_field( $_POST['alert_status'] ) );
    }

    if ( isset( $_POST['activity_type'] ) ) {
        update_post_meta( $post_id, '_activity_type', sanitize_text_field( $_POST['activity_type'] ) );
    }

    if ( isset( $_POST['activity_platform'] ) ) {
        update_post_meta( $post_id, '_activity_platform', sanitize_text_field( $_POST['activity_platform'] ) );
    }

    if ( isset( $_POST['activity_domain'] ) ) {
        update_post_meta( $post_id, '_activity_domain', sanitize_text_field( $_POST['activity_domain'] ) );
    }

    if ( isset( $_POST['websites'] ) ) {
        update_post_meta( $post_id, '_websites', sanitize_text_field( $_POST['websites'] ) );
    }

    if ( isset( $_POST['social_media'] ) ) {
        update_post_meta( $post_id, '_social_media', sanitize_text_field( $_POST['social_media'] ) );
    }

    if ( isset( $_POST['capital_estimation'] ) ) {
        update_post_meta( $post_id, '_capital_estimation', sanitize_text_field( $_POST['capital_estimation'] ) );
    }

    if ( isset( $_POST['resources'] ) ) {
        update_post_meta( $post_id, '_resources', sanitize_text_field( $_POST['resources'] ) );
    }
}
add_action( 'save_post', 'save_scam_alert_meta_box_data' );




function remove_default_post_type_support() {
    remove_post_type_support( 'scam_alert', 'excerpt' );
	
}
add_action( 'init', 'remove_default_post_type_support' );

//end spam
