<?php
/**
 * Template Name: Yardım Konuları
 * Yardım Konuları Sayfası - Mobil Uygulama ile Birebir Aynı
 */
get_header();
?>

<!-- Header -->
<div class="help-page-header">
    <h1>Yardım Konuları</h1>
</div>

<!-- Banner Reklam -->
<div class="banner-ad">
    <div class="banner-ad-box">Reklam Alanı</div>
</div>

<div class="help-page-content">
    <!-- Intro -->
    <div class="help-intro">
        <h2>Kargo Sorunları Rehberi</h2>
        <p>Kargo süreçlerinde karşılaşılan sorunlar ve çözüm yolları hakkında detaylı bilgi edinin.</p>
    </div>
    
    <!-- Yardım Konuları Listesi -->
    <div class="help-list">
        <?php
        $icons = array(
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>',
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>',
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>',
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="16.5" y1="9.4" x2="7.5" y2="4.21"/><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>',
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>',
        );
        
        // Tüm sayfaları getir
        $pages = get_pages(array(
            'sort_column' => 'menu_order',
            'exclude' => array(get_option('page_on_front'), get_the_ID()),
        ));
        
        if ($pages) {
            $i = 1;
            foreach ($pages as $page) {
                $icon = isset($icons[($i-1) % count($icons)]) ? $icons[($i-1) % count($icons)] : $icons[0];
                $excerpt = wp_trim_words($page->post_content, 15, '...');
                ?>
                <a href="<?php echo get_permalink($page->ID); ?>" class="help-item">
                    <div class="help-item-num"><?php echo $i; ?></div>
                    <div class="help-item-icon"><?php echo $icon; ?></div>
                    <div class="help-item-text">
                        <strong><?php echo esc_html($page->post_title); ?></strong>
                        <span><?php echo esc_html($excerpt); ?></span>
                    </div>
                    <span class="help-item-arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                    </span>
                </a>
                <?php
                $i++;
            }
        }
        ?>
    </div>
</div>

<?php get_footer(); ?>
