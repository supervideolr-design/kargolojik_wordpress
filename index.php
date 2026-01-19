<?php
/**
 * Ana Sayfa - Mobil Uygulama ile Birebir Aynı
 */
get_header();
$stats = kargolojik_get_stats();
?>

<!-- Banner Reklam -->
<div class="banner-ad">
    <div class="banner-ad-box">Reklam Alanı</div>
</div>

<!-- Hero -->
<section class="hero">
    <h1 class="hero-title">Kargo Sorunlarınıza</h1>
    <h2 class="hero-subtitle">Çözüm Rehberi</h2>
    <p class="hero-desc">Türkiye'deki kargo sorunları için profesyonel çözümler ve şube bilgileri</p>
</section>

<!-- Arama Kutusu -->
<section class="search-section">
    <form class="search-form" action="<?php echo home_url(); ?>" method="get">
        <div class="search-wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" name="s" placeholder="Şube adı veya şehir ara...">
        </div>
        <button type="submit" class="search-btn">Ara</button>
    </form>
</section>

<!-- Çözüm Robotu -->
<section class="wizard-section">
    <a href="<?php echo home_url('/cozum-robotu'); ?>" class="wizard-btn">
        <div class="wizard-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="4" width="16" height="16" rx="2"/><rect x="9" y="9" width="6" height="6"/><line x1="9" y1="1" x2="9" y2="4"/><line x1="15" y1="1" x2="15" y2="4"/><line x1="9" y1="20" x2="9" y2="23"/><line x1="15" y1="20" x2="15" y2="23"/><line x1="20" y1="9" x2="23" y2="9"/><line x1="20" y1="14" x2="23" y2="14"/><line x1="1" y1="9" x2="4" y2="9"/><line x1="1" y1="14" x2="4" y2="14"/></svg>
        </div>
        <div class="wizard-text">
            <strong>Çözüm Robotu</strong>
            <span>Adım adım sorununuzu çözün</span>
        </div>
        <span class="wizard-arrow">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
        </span>
    </a>
</section>

<!-- İstatistikler -->
<section class="stats-section">
    <div class="stats-box">
        <div class="stat">
            <div class="stat-num"><?php echo number_format($stats['branches']); ?>+</div>
            <div class="stat-label">Şube</div>
        </div>
        <div class="stat-divider"></div>
        <div class="stat">
            <div class="stat-num"><?php echo $stats['cities']; ?></div>
            <div class="stat-label">Şehir</div>
        </div>
        <div class="stat-divider"></div>
        <div class="stat">
            <div class="stat-num">12</div>
            <div class="stat-label">Rehber</div>
        </div>
    </div>
</section>

<!-- Popüler Yardım Konuları -->
<section class="help-section">
    <div class="section-header">
        <h3 class="section-title">Popüler Yardım Konuları</h3>
        <a href="<?php echo home_url('/yardim-konulari'); ?>" class="see-all">Tümünü Gör</a>
    </div>
    
    <div class="topics-grid">
        <?php
        // Son 4 yardım sayfasını getir
        $help_pages = get_pages(array(
            'sort_column' => 'menu_order',
            'number' => 4,
            'parent' => 0,
            'exclude' => array(get_option('page_on_front')),
        ));
        
        $icons = array(
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>',
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>',
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="16.5" y1="9.4" x2="7.5" y2="4.21"/><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>',
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>',
        );
        
        if ($help_pages) {
            $i = 0;
            foreach ($help_pages as $page) {
                $icon = isset($icons[$i]) ? $icons[$i] : $icons[0];
                ?>
                <a href="<?php echo get_permalink($page->ID); ?>" class="topic-card">
                    <div class="topic-icon"><?php echo $icon; ?></div>
                    <div class="topic-title"><?php echo esc_html($page->post_title); ?></div>
                </a>
                <?php
                $i++;
            }
        } else {
            // Varsayılan konular
            $default_topics = array(
                array('title' => 'Kargo Şirketlerinin Çalışma Modeli ve ...', 'icon' => $icons[0]),
                array('title' => 'Hasar ve Tutanak Prosedürü', 'icon' => $icons[1]),
                array('title' => 'Hasarlı Kargo', 'icon' => $icons[2]),
                array('title' => 'Kayıp Kargo', 'icon' => $icons[3]),
            );
            foreach ($default_topics as $topic) {
                ?>
                <a href="#" class="topic-card">
                    <div class="topic-icon"><?php echo $topic['icon']; ?></div>
                    <div class="topic-title"><?php echo $topic['title']; ?></div>
                </a>
                <?php
            }
        }
        ?>
    </div>
</section>

<?php get_footer(); ?>
