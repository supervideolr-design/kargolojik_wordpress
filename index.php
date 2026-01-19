<?php
/**
 * Main Index Template
 */

get_header();
?>

<!-- Hero Section -->
<section class="hero-section">
    <h2 class="hero-title">Kargo Sorunlarınıza</h2>
    <h2 class="hero-subtitle">Çözüm Rehberi</h2>
    <p class="hero-description">Türkiye'deki kargo sorunları için profesyonel çözümler ve şube bilgileri</p>
</section>

<!-- Search Box -->
<section class="search-container">
    <form class="search-box" action="<?php echo home_url('/sube'); ?>" method="get">
        <div class="search-input-wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            <input type="text" name="s" class="search-input" placeholder="Şube adı veya şehir ara...">
        </div>
        <button type="submit" class="search-btn">Ara</button>
    </form>
</section>

<!-- Wizard Button -->
<section class="wizard-button">
    <a href="<?php echo home_url('/cozum-robotu'); ?>" class="wizard-btn">
        <div class="wizard-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
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
    <?php $stats = kargolojik_get_stats(); ?>
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
            <div class="stat-number"><?php echo $stats['companies']; ?></div>
            <div class="stat-label">Şirket</div>
        </div>
    </div>
</section>

<!-- Help Topics Section -->
<section class="help-section">
    <div class="section-title-header">
        <h2 class="section-title">Popüler Yardım Konuları</h2>
        <a href="<?php echo home_url('/yardim'); ?>" class="see-all">Tümünü Gör</a>
    </div>
    
    <div class="topics-grid">
        <?php
        $help_topics = array(
            array('icon' => 'package', 'title' => 'Hasarlı Kargo', 'slug' => 'hasarli-kargo'),
            array('icon' => 'eye-off', 'title' => 'Kayıp Kargo', 'slug' => 'kayip-kargo'),
            array('icon' => 'clock', 'title' => 'Geciken Teslimat', 'slug' => 'geciken-teslimat'),
            array('icon' => 'dollar-sign', 'title' => 'Tazminat Hakları', 'slug' => 'tazminat-haklari'),
        );
        
        foreach ($help_topics as $topic):
        ?>
        <a href="<?php echo home_url('/yardim/' . $topic['slug']); ?>" class="topic-card">
            <div class="topic-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <?php if ($topic['icon'] === 'package'): ?>
                        <line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line>
                    <?php elseif ($topic['icon'] === 'eye-off'): ?>
                        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>
                    <?php elseif ($topic['icon'] === 'clock'): ?>
                        <circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline>
                    <?php elseif ($topic['icon'] === 'dollar-sign'): ?>
                        <line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    <?php endif; ?>
                </svg>
            </div>
            <div class="topic-title"><?php echo $topic['title']; ?></div>
        </a>
        <?php endforeach; ?>
    </div>
</section>

<!-- Recent Branches -->
<section class="branches-section">
    <div class="section-title-header">
        <h2 class="section-title">Son Eklenen Şubeler</h2>
        <a href="<?php echo home_url('/sube'); ?>" class="see-all">Tümünü Gör</a>
    </div>
    
    <div class="branches-grid">
        <?php
        $branches = new WP_Query(array(
            'post_type' => 'branch',
            'posts_per_page' => 6,
            'orderby' => 'date',
            'order' => 'DESC',
        ));
        
        if ($branches->have_posts()):
            while ($branches->have_posts()): $branches->the_post();
                $companies = get_the_terms(get_the_ID(), 'company');
                $cities = get_the_terms(get_the_ID(), 'city');
                $company_name = $companies ? $companies[0]->name : '';
                $city_name = $cities ? $cities[0]->name : '';
                $district = get_post_meta(get_the_ID(), '_branch_district', true);
                $color = kargolojik_get_company_color($company_name);
        ?>
        <a href="<?php the_permalink(); ?>" class="branch-card">
            <div class="branch-header">
                <span class="company-badge" style="background-color: <?php echo $color; ?>20; color: <?php echo $color; ?>;">
                    <?php echo esc_html($company_name); ?>
                </span>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </div>
            <h3 class="branch-name"><?php the_title(); ?></h3>
            <div class="branch-location">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                <?php echo esc_html($city_name); ?> / <?php echo esc_html($district); ?>
            </div>
        </a>
        <?php
            endwhile;
            wp_reset_postdata();
        else:
        ?>
        <div class="empty-state">
            <div class="empty-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </div>
            <h3 class="empty-title">Henüz Şube Yok</h3>
            <p class="empty-subtitle">Şube verilerini CSV ile içe aktarın</p>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php
get_footer();
