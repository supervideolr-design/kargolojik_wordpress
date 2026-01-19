<?php
/**
 * Kargolojik Theme Functions
 */

if (!defined('ABSPATH')) exit;

define('KARGOLOJIK_VERSION', '1.0.0');
define('KARGOLOJIK_DIR', get_template_directory());
define('KARGOLOJIK_URI', get_template_directory_uri());

/**
 * Theme Setup
 */
function kargolojik_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('custom-logo', array(
        'height' => 60,
        'width' => 200,
        'flex-height' => true,
        'flex-width' => true,
    ));
    
    register_nav_menus(array(
        'primary' => __('Ana Menü', 'kargolojik'),
        'footer' => __('Footer Menü', 'kargolojik'),
    ));
}
add_action('after_setup_theme', 'kargolojik_setup');

/**
 * Enqueue Scripts & Styles
 */
function kargolojik_scripts() {
    wp_enqueue_style('kargolojik-style', get_stylesheet_uri(), array(), KARGOLOJIK_VERSION);
    wp_enqueue_style('kargolojik-main', KARGOLOJIK_URI . '/assets/css/main.css', array(), KARGOLOJIK_VERSION);
    
    // Feather Icons
    wp_enqueue_style('feather-icons', 'https://unpkg.com/feather-icons/dist/feather.min.css', array(), '4.29.0');
    
    wp_enqueue_script('kargolojik-main', KARGOLOJIK_URI . '/assets/js/main.js', array('jquery'), KARGOLOJIK_VERSION, true);
    
    wp_localize_script('kargolojik-main', 'kargolojik_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('kargolojik_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'kargolojik_scripts');

/**
 * Register Custom Post Type: Branches
 */
function kargolojik_register_branch_cpt() {
    $labels = array(
        'name' => 'Şubeler',
        'singular_name' => 'Şube',
        'menu_name' => 'Şubeler',
        'add_new' => 'Yeni Şube Ekle',
        'add_new_item' => 'Yeni Şube Ekle',
        'edit_item' => 'Şubeyi Düzenle',
        'new_item' => 'Yeni Şube',
        'view_item' => 'Şubeyi Görüntüle',
        'search_items' => 'Şube Ara',
        'not_found' => 'Şube bulunamadı',
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'sube'),
        'supports' => array('title', 'thumbnail'),
        'menu_icon' => 'dashicons-location-alt',
        'show_in_rest' => true,
    );
    
    register_post_type('branch', $args);
}
add_action('init', 'kargolojik_register_branch_cpt');

/**
 * Register Custom Taxonomy: Companies
 */
function kargolojik_register_company_taxonomy() {
    $labels = array(
        'name' => 'Kargo Şirketleri',
        'singular_name' => 'Kargo Şirketi',
        'search_items' => 'Şirket Ara',
        'all_items' => 'Tüm Şirketler',
        'edit_item' => 'Şirketi Düzenle',
        'add_new_item' => 'Yeni Şirket Ekle',
    );
    
    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'kargo-sirketi'),
        'show_in_rest' => true,
    );
    
    register_taxonomy('company', array('branch'), $args);
}
add_action('init', 'kargolojik_register_company_taxonomy');

/**
 * Register Custom Taxonomy: Cities
 */
function kargolojik_register_city_taxonomy() {
    $labels = array(
        'name' => 'Şehirler',
        'singular_name' => 'Şehir',
        'search_items' => 'Şehir Ara',
        'all_items' => 'Tüm Şehirler',
    );
    
    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'sehir'),
        'show_in_rest' => true,
    );
    
    register_taxonomy('city', array('branch'), $args);
}
add_action('init', 'kargolojik_register_city_taxonomy');

/**
 * Register Branch Meta Fields
 */
function kargolojik_register_branch_meta() {
    register_post_meta('branch', '_branch_address', array(
        'type' => 'string',
        'single' => true,
        'show_in_rest' => true,
    ));
    
    register_post_meta('branch', '_branch_district', array(
        'type' => 'string',
        'single' => true,
        'show_in_rest' => true,
    ));
    
    register_post_meta('branch', '_branch_phone1', array(
        'type' => 'string',
        'single' => true,
        'show_in_rest' => true,
    ));
    
    register_post_meta('branch', '_branch_phone2', array(
        'type' => 'string',
        'single' => true,
        'show_in_rest' => true,
    ));
}
add_action('init', 'kargolojik_register_branch_meta');

/**
 * Add Branch Meta Box
 */
function kargolojik_add_branch_meta_box() {
    add_meta_box(
        'branch_details',
        'Şube Bilgileri',
        'kargolojik_branch_meta_box_callback',
        'branch',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'kargolojik_add_branch_meta_box');

function kargolojik_branch_meta_box_callback($post) {
    wp_nonce_field('kargolojik_branch_meta', 'kargolojik_branch_nonce');
    
    $address = get_post_meta($post->ID, '_branch_address', true);
    $district = get_post_meta($post->ID, '_branch_district', true);
    $phone1 = get_post_meta($post->ID, '_branch_phone1', true);
    $phone2 = get_post_meta($post->ID, '_branch_phone2', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="branch_address">Adres</label></th>
            <td><textarea id="branch_address" name="branch_address" rows="3" class="large-text"><?php echo esc_textarea($address); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="branch_district">İlçe</label></th>
            <td><input type="text" id="branch_district" name="branch_district" value="<?php echo esc_attr($district); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="branch_phone1">Telefon 1</label></th>
            <td><input type="text" id="branch_phone1" name="branch_phone1" value="<?php echo esc_attr($phone1); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="branch_phone2">Telefon 2</label></th>
            <td><input type="text" id="branch_phone2" name="branch_phone2" value="<?php echo esc_attr($phone2); ?>" class="regular-text"></td>
        </tr>
    </table>
    <?php
}

function kargolojik_save_branch_meta($post_id) {
    if (!isset($_POST['kargolojik_branch_nonce']) || 
        !wp_verify_nonce($_POST['kargolojik_branch_nonce'], 'kargolojik_branch_meta')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    
    $fields = array('branch_address', 'branch_district', 'branch_phone1', 'branch_phone2');
    
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post_branch', 'kargolojik_save_branch_meta');

/**
 * AJAX Branch Search
 */
function kargolojik_ajax_search_branches() {
    check_ajax_referer('kargolojik_nonce', 'nonce');
    
    $search = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';
    $company = isset($_POST['company']) ? sanitize_text_field($_POST['company']) : '';
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $per_page = 30;
    
    $args = array(
        'post_type' => 'branch',
        'posts_per_page' => $per_page,
        'paged' => $page,
        's' => $search,
    );
    
    if ($company) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'company',
                'field' => 'slug',
                'terms' => $company,
            ),
        );
    }
    
    $query = new WP_Query($args);
    $branches = array();
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $companies = get_the_terms(get_the_ID(), 'company');
            $cities = get_the_terms(get_the_ID(), 'city');
            
            $branches[] = array(
                'id' => get_the_ID(),
                'name' => get_the_title(),
                'company' => $companies ? $companies[0]->name : '',
                'city' => $cities ? $cities[0]->name : '',
                'district' => get_post_meta(get_the_ID(), '_branch_district', true),
                'address' => get_post_meta(get_the_ID(), '_branch_address', true),
                'phone1' => get_post_meta(get_the_ID(), '_branch_phone1', true),
                'phone2' => get_post_meta(get_the_ID(), '_branch_phone2', true),
                'url' => get_permalink(),
            );
        }
    }
    wp_reset_postdata();
    
    wp_send_json_success(array(
        'branches' => $branches,
        'total' => $query->found_posts,
        'pages' => $query->max_num_pages,
    ));
}
add_action('wp_ajax_search_branches', 'kargolojik_ajax_search_branches');
add_action('wp_ajax_nopriv_search_branches', 'kargolojik_ajax_search_branches');

/**
 * Get Company Color
 */
function kargolojik_get_company_color($company_name) {
    $colors = array(
        'Aras Kargo' => '#e74c3c',
        'PTT Kargo' => '#f1c40f',
        'DHL Kargo' => '#e67e22',
        'Sürat Kargo' => '#3498db',
        'Inter Global Kargo' => '#9b59b6',
        'Yurtiçi Kargo' => '#2ecc71',
        'TNT Kargo' => '#ff6b00',
        'UPS Kargo' => '#6d1a36',
        'MNG Kargo' => '#1e88e5',
    );
    
    return isset($colors[$company_name]) ? $colors[$company_name] : '#1e88e5';
}

/**
 * Get Stats
 */
function kargolojik_get_stats() {
    $branch_count = wp_count_posts('branch')->publish;
    $city_count = wp_count_terms('city');
    $company_count = wp_count_terms('company');
    
    return array(
        'branches' => $branch_count,
        'cities' => $city_count,
        'companies' => $company_count,
    );
}

/**
 * Turkish Character Normalization
 */
function kargolojik_normalize_turkish($text) {
    $turkish = array('ı', 'ğ', 'ü', 'ş', 'ö', 'ç', 'İ', 'Ğ', 'Ü', 'Ş', 'Ö', 'Ç');
    $english = array('i', 'g', 'u', 's', 'o', 'c', 'i', 'g', 'u', 's', 'o', 'c');
    return str_replace($turkish, $english, strtolower($text));
}

/**
 * Import CSV Function (Admin)
 */
function kargolojik_import_csv() {
    if (!current_user_can('manage_options')) return;
    
    if (isset($_POST['kargolojik_import_csv']) && isset($_FILES['csv_file'])) {
        $file = $_FILES['csv_file']['tmp_name'];
        
        if (($handle = fopen($file, 'r')) !== false) {
            $header = fgetcsv($handle, 0, ';');
            $imported = 0;
            
            while (($data = fgetcsv($handle, 0, ';')) !== false) {
                $branch_data = array_combine($header, $data);
                
                // Create branch post
                $post_id = wp_insert_post(array(
                    'post_title' => $branch_data['Sube_Adi'],
                    'post_type' => 'branch',
                    'post_status' => 'publish',
                ));
                
                if ($post_id) {
                    // Set meta
                    update_post_meta($post_id, '_branch_address', $branch_data['Adres']);
                    update_post_meta($post_id, '_branch_district', $branch_data['Ilce']);
                    update_post_meta($post_id, '_branch_phone1', $branch_data['Telefon_1']);
                    update_post_meta($post_id, '_branch_phone2', $branch_data['Telefon_2'] ?? '');
                    
                    // Set company taxonomy
                    wp_set_object_terms($post_id, $branch_data['Sirket_Adi'], 'company');
                    
                    // Set city taxonomy
                    wp_set_object_terms($post_id, $branch_data['Sehir'], 'city');
                    
                    $imported++;
                }
            }
            fclose($handle);
            
            add_settings_error('kargolojik', 'import_success', $imported . ' şube başarıyla içe aktarıldı.', 'success');
        }
    }
}
add_action('admin_init', 'kargolojik_import_csv');

/**
 * Admin Menu
 */
function kargolojik_admin_menu() {
    add_menu_page(
        'Kargolojik Ayarları',
        'Kargolojik',
        'manage_options',
        'kargolojik-settings',
        'kargolojik_settings_page',
        'dashicons-location-alt',
        30
    );
}
add_action('admin_menu', 'kargolojik_admin_menu');

function kargolojik_settings_page() {
    ?>
    <div class="wrap">
        <h1>Kargolojik Ayarları</h1>
        
        <?php settings_errors('kargolojik'); ?>
        
        <div class="card">
            <h2>CSV İçe Aktarma</h2>
            <p>Şube verilerini CSV dosyasından içe aktarın. CSV formatı: Sirket_Adi;Sube_Adi;Sehir;Ilce;Adres;Telefon_1;Telefon_2</p>
            
            <form method="post" enctype="multipart/form-data">
                <input type="file" name="csv_file" accept=".csv" required>
                <button type="submit" name="kargolojik_import_csv" class="button button-primary">İçe Aktar</button>
            </form>
        </div>
        
        <div class="card" style="margin-top: 20px;">
            <h2>İstatistikler</h2>
            <?php $stats = kargolojik_get_stats(); ?>
            <ul>
                <li><strong>Toplam Şube:</strong> <?php echo $stats['branches']; ?></li>
                <li><strong>Toplam Şehir:</strong> <?php echo $stats['cities']; ?></li>
                <li><strong>Kargo Şirketi:</strong> <?php echo $stats['companies']; ?></li>
            </ul>
        </div>
    </div>
    <?php
}

/**
 * Shortcodes
 */
function kargolojik_search_shortcode($atts) {
    ob_start();
    get_template_part('template-parts/search', 'box');
    return ob_get_clean();
}
add_shortcode('kargolojik_search', 'kargolojik_search_shortcode');

function kargolojik_branches_shortcode($atts) {
    ob_start();
    get_template_part('template-parts/branches', 'list');
    return ob_get_clean();
}
add_shortcode('kargolojik_branches', 'kargolojik_branches_shortcode');

/**
 * Help Topics Post Type
 */
function kargolojik_register_help_cpt() {
    register_post_type('help_topic', array(
        'labels' => array(
            'name' => 'Yardım Konuları',
            'singular_name' => 'Yardım Konusu',
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'yardim'),
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-editor-help',
        'show_in_rest' => true,
    ));
}
add_action('init', 'kargolojik_register_help_cpt');
