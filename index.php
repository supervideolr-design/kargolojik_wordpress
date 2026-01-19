<?php
/**
 * Ana Sayfa - Birebir Aynı Tasarım
 */
get_header();
$stats = kargolojik_get_stats();
?>

<!-- Banner Reklam -->
<div class="banner-ad">
    <div class="banner-ad-inner">
        <span class="banner-ad-text">Reklam Alanı</span>
    </div>
</div>

<!-- Hero Section -->
<section class="hero-section">
    <h1 class="hero-title">Kargo Sorunlarınıza</h1>
    <h2 class="hero-subtitle">Çözüm Rehberi</h2>
    <p class="hero-description">Türkiye'deki kargo sorunları için profesyonel çözümler ve şube bilgileri</p>
</section>

<!-- Search Box -->
<section class="search-container">
    <form class="search-box" action="<?php echo home_url(); ?>" method="get">
        <div class="search-input-wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            <input type="text" name="s" class="search-input" placeholder="Şube adı veya şehir ara...">
        </div>
        <button type="submit" class="search-btn">Ara</button>
    </form>
</section>

<!-- Wizard Button -->
<section class="wizard-section">
    <a href="<?php echo home_url('/cozum-robotu'); ?>" class="wizard-btn">
        <div class="wizard-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
        </div>
        <div class="wizard-text">
            <div class="wizard-title">Çözüm Robotu</div>
            <div class="wizard-subtitle">Adım adım sorununuzu çözün</div>
        </div>
        <span class="wizard-arrow">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </span>
    </a>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="stats-container">
        <div class="stat-item">
            <div class="stat-number"><?php echo number_format($stats['branches']); ?>+</div>
            <div class="stat-label">Şube</div>
        </div>
        <div class="stat-divider"></div>
        <div class="stat-item">
            <div class="stat-number"><?php echo $stats['cities']; ?></div>
            <div class="stat-label">Şehir</div>
        </div>
        <div class="stat-divider"></div>
        <div class="stat-item">
            <div class="stat-number">12</div>
            <div class="stat-label">Rehber</div>
        </div>
    </div>
</section>

<!-- Help Topics Section -->
<section class="help-section">
    <div class="section-header">
        <h3 class="section-title">Popüler Yardım Konuları</h3>
        <a href="<?php echo home_url('/yardim'); ?>" class="see-all">Tümünü Gör</a>
    </div>
    
    <div class="topics-grid">
        <a href="<?php echo home_url('/yardim/kargo-sirketleri'); ?>" class="topic-card">
            <div class="topic-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
            </div>
            <div class="topic-title">Kargo Şirketlerinin Çalışma Modeli ve ...</div>
        </a>
        
        <a href="<?php echo home_url('/yardim/hasar-tutanak'); ?>" class="topic-card">
            <div class="topic-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
            </div>
            <div class="topic-title">Hasar ve Tutanak Prosedürü</div>
        </a>
        
        <a href="<?php echo home_url('/yardim/hasarli-kargo'); ?>" class="topic-card">
            <div class="topic-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
            </div>
            <div class="topic-title">Hasarlı Kargo</div>
        </a>
        
        <a href="<?php echo home_url('/yardim/kayip-kargo'); ?>" class="topic-card">
            <div class="topic-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
            </div>
            <div class="topic-title">Kayıp Kargo</div>
        </a>
    </div>
</section>

<?php get_footer(); ?>
