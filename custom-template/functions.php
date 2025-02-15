<!-- register nav-menu to allow using it in our website -->
<?php
register_nav_menus(
    array(
        'primary-menu' => 'Top- Menu'
    )
);

// allow featured images in site
add_theme_support('post-thumbnails');

// allow custom logo in header
add_theme_support('custom-header');

// register_taxonomy_for_object_type('post_tag', 'post');

?>


<!-- support custom css for header -->
<?php
class WP_Bootstrap_Navwalker extends Walker_Nav_Menu
{
    function start_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        
        // Add "nav-item" while keeping existing WordPress classes
        $li_classes = array_merge($classes, ['nav-item']); 

        if (in_array('menu-item-has-children', $classes)) {
            $li_classes[] = 'dropdown'; // Add dropdown if it has children
        }

        $class_names = join(' ', array_filter($li_classes));
        $output .= '<li class="' . esc_attr($class_names) . '">';

        $atts = array();
        $atts['title']  = !empty($item->title) ? $item->title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '';

        // Preserve existing classes while ensuring "nav-link" is added
        $link_classes = array_merge($classes, ['nav-link']);
        
        if (in_array('menu-item-has-children', $classes)) {
            $link_classes[] = 'dropdown-toggle';
            $atts['id'] = 'navbarDropdown';
            $atts['role'] = 'button';
            $atts['data-bs-toggle'] = 'dropdown';
            $atts['aria-expanded'] = 'false';
        }

        $atts['class'] = join(' ', array_filter($link_classes));

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $attributes .= ' ' . $attr . '="' . esc_attr($value) . '"';
            }
        }

        $output .= '<a' . $attributes . '>';
        $output .= apply_filters('the_title', $item->title, $item->ID);
        $output .= '</a>';
    }

    function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= "</li>\n";
    }
}

?>

<!-- Contact Us Form -->
<?php

// Handle Form Submission in functions.php
function save_contact_us_form() {
    if (isset($_POST['name'], $_POST['email'], $_POST['message'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . "contact_us_form"; 

        $wpdb->insert($table_name, [
            'name'    => sanitize_text_field($_POST['name']),
            'email'   => sanitize_email($_POST['email']),
            'message' => sanitize_textarea_field($_POST['message']),
            'created_at' => current_time('mysql')
        ]);
    }
    // wp_redirect(home_url()); // Redirect after submission
    exit;
}

// add_action('admin_post_save_contact_us_form', 'save_contact_us_form');
// add_action('admin_post_nopriv_save_contact_us_form', 'save_contact_us_form'); // Allow non-logged-in users


//  Create the Database Table
function create_contact_us_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . "contact_us_form"; 

    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        message TEXT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}
// add_action('after_setup_theme', 'create_contact_us_table');

?>