<?php
/**
 * Kargolojik Theme Functions
 * Şube araması WordPress postları içinde yapılır
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
    
    wp_enqueue_script('kargolojik-main', KARGOLOJIK_URI . '/assets/js/main.js', array('jquery'), KARGOLOJIK_VERSION, true);
    
    wp_localize_script('kargolojik-main', 'kargolojik_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('kargolojik_nonce'),
        'site_url' => home_url()
    ));
}
add_action('wp_enqueue_scripts', 'kargolojik_scripts');

/**
 * Get Company from Post Title
 */
function kargolojik_get_company_from_title($title) {
    $companies = array(
        'Aras Kargo' => 'aras-kargo',
        'PTT Kargo' => 'ptt-kargo',
        'DHL Kargo' => 'dhl-kargo',
        'Sürat Kargo' => 'surat-kargo',
        'Inter Global Kargo' => 'inter-global-kargo',
        'Yurtiçi Kargo' => 'yurtici-kargo',
        'TNT Kargo' => 'tnt-kargo',
        'UPS Kargo' => 'ups-kargo',
        'MNG Kargo' => 'mng-kargo',
    );
    
    $title_lower = mb_strtolower($title, 'UTF-8');
    
    foreach ($companies as $name => $slug) {
        if (strpos($title_lower, mb_strtolower($slug, 'UTF-8')) !== false || 
            strpos($title_lower, mb_strtolower(str_replace('-', ' ', $slug), 'UTF-8')) !== false) {
            return $name;
        }
    }
    
    return '';
}

/**
 * Get City from Post Title
 */
function kargolojik_get_city_from_title($title) {
    $cities = array(
        'adana', 'adıyaman', 'afyon', 'ağrı', 'aksaray', 'amasya', 'ankara', 'antalya', 
        'ardahan', 'artvin', 'aydın', 'balıkesir', 'bartın', 'batman', 'bayburt', 
        'bilecik', 'bingöl', 'bitlis', 'bolu', 'burdur', 'bursa', 'çanakkale', 
        'çankırı', 'çorum', 'denizli', 'diyarbakır', 'düzce', 'edirne', 'elazığ', 
        'erzincan', 'erzurum', 'eskişehir', 'gaziantep', 'giresun', 'gümüşhane', 
        'hakkari', 'hatay', 'ığdır', 'isparta', 'istanbul', 'izmir', 'kahramanmaraş', 
        'karabük', 'karaman', 'kars', 'kastamonu', 'kayseri', 'kilis', 'kırıkkale', 
        'kırklareli', 'kırşehir', 'kocaeli', 'konya', 'kütahya', 'malatya', 'manisa', 
        'mardin', 'mersin', 'muğla', 'muş', 'nevşehir', 'niğde', 'ordu', 'osmaniye', 
        'rize', 'sakarya', 'samsun', 'şanlıurfa', 'siirt', 'sinop', 'sivas', 'şırnak', 
        'tekirdağ', 'tokat', 'trabzon', 'tunceli', 'uşak', 'van', 'yalova', 'yozgat', 
        'zonguldak'
    );
    
    $title_lower = mb_strtolower($title, 'UTF-8');
    
    foreach ($cities as $city) {
        if (strpos($title_lower, $city) !== false) {
            return ucfirst($city);
        }
    }
    
    return '';
}

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
 * Get Company Logo
 */
function kargolojik_get_company_logo($company_name) {
    $logos = array(
        'Aras Kargo' => 'aras-logo.png',
        'PTT Kargo' => 'ptt-logo.png',
        'DHL Kargo' => 'dhl-logo.png',
        'Sürat Kargo' => 'surat-logo.png',
        'Inter Global Kargo' => 'inter-global-logo.png',
        'Yurtiçi Kargo' => 'yurtici-logo.png',
        'TNT Kargo' => 'tnt-logo.png',
        'UPS Kargo' => 'ups-logo.png',
        'MNG Kargo' => 'mng-logo.png',
    );
    
    if (isset($logos[$company_name])) {
        return KARGOLOJIK_URI . '/assets/images/' . $logos[$company_name];
    }
    
    return '';
}

/**
 * Get Stats - Count posts containing branch info
 */
function kargolojik_get_stats() {
    // Count all published posts (branches)
    $branch_count = wp_count_posts('post')->publish;
    
    // Estimate cities (81 cities in Turkey)
    $city_count = 81;
    
    // Company count
    $company_count = 9;
    
    return array(
        'branches' => $branch_count,
        'cities' => $city_count,
        'companies' => $company_count,
    );
}

/**
 * Turkish Character Normalization for Search
 */
function kargolojik_normalize_turkish($text) {
    $turkish = array('ı', 'ğ', 'ü', 'ş', 'ö', 'ç', 'İ', 'Ğ', 'Ü', 'Ş', 'Ö', 'Ç');
    $english = array('i', 'g', 'u', 's', 'o', 'c', 'i', 'g', 'u', 's', 'o', 'c');
    return str_replace($turkish, $english, mb_strtolower($text, 'UTF-8'));
}

/**
 * AJAX Branch Search - Search in Posts
 */
function kargolojik_ajax_search_branches() {
    check_ajax_referer('kargolojik_nonce', 'nonce');
    
    $search = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';
    $company = isset($_POST['company']) ? sanitize_text_field($_POST['company']) : '';
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $per_page = 30;
    
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => $per_page,
        'paged' => $page,
        's' => $search,
    );
    
    // If company filter, search for company name in title
    if ($company) {
        $args['s'] = $company . ' ' . $search;
    }
    
    $query = new WP_Query($args);
    $branches = array();
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $title = get_the_title();
            $company_name = kargolojik_get_company_from_title($title);
            $city = kargolojik_get_city_from_title($title);
            
            $branches[] = array(
                'id' => get_the_ID(),
                'name' => $title,
                'company' => $company_name,
                'city' => $city,
                'url' => get_permalink(),
                'color' => kargolojik_get_company_color($company_name),
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
 * Modify Search Query to improve Turkish search
 */
function kargolojik_modify_search_query($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {
        $query->set('post_type', 'post');
        $query->set('posts_per_page', 30);
    }
    return $query;
}
add_action('pre_get_posts', 'kargolojik_modify_search_query');

/**
 * Help Topics Data
 */
function kargolojik_get_help_topics() {
    return array(
        array('icon' => 'package', 'title' => 'Hasarlı Kargo', 'slug' => 'hasarli-kargo'),
        array('icon' => 'eye-off', 'title' => 'Kayıp Kargo', 'slug' => 'kayip-kargo'),
        array('icon' => 'clock', 'title' => 'Geciken Teslimat', 'slug' => 'geciken-teslimat'),
        array('icon' => 'dollar-sign', 'title' => 'Tazminat Hakları', 'slug' => 'tazminat-haklari'),
    );
}

/**
 * Shortcodes
 */
function kargolojik_search_shortcode($atts) {
    ob_start();
    ?>
    <div class="search-container">
        <form class="search-box" action="<?php echo home_url(); ?>" method="get">
            <div class="search-input-wrapper">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input type="text" name="s" class="search-input" placeholder="Şube adı veya şehir ara...">
            </div>
            <button type="submit" class="search-btn">Ara</button>
        </form>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('kargolojik_search', 'kargolojik_search_shortcode');

/**
 * Admin Menu for Stats
 */
function kargolojik_admin_menu() {
    add_menu_page(
        'Kargolojik',
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
    $stats = kargolojik_get_stats();
    ?>
    <div class="wrap">
        <h1>Kargolojik İstatistikleri</h1>
        
        <div class="card">
            <h2>Şube Bilgileri</h2>
            <ul>
                <li><strong>Toplam Şube (Post):</strong> <?php echo number_format($stats['branches']); ?></li>
                <li><strong>Şehir Sayısı:</strong> <?php echo $stats['cities']; ?></li>
                <li><strong>Kargo Şirketi:</strong> <?php echo $stats['companies']; ?></li>
            </ul>
        </div>
        
        <div class="card" style="margin-top: 20px;">
            <h2>Kullanım</h2>
            <p>Şube araması WordPress postları içinde yapılır.</p>
            <p>Post başlıkları şu formatta olmalı: <code>[Şirket Adı] [Şehir] Şubesi</code></p>
            <p>Örnek: <code>Inter Global Kargo Zonguldak Şubesi</code></p>
        </div>
    </div>
    <?php
}
