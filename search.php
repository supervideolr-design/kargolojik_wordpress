<?php
/**
 * Search Results - Şube Arama Sayfası - Birebir Aynı
 */
get_header();

$search = get_search_query();
$company_filter = isset($_GET['company']) ? sanitize_text_field($_GET['company']) : '';
$paged = get_query_var('paged') ? get_query_var('paged') : 1;

$companies = array(
    array('name' => 'Aras Kargo', 'slug' => 'aras', 'color' => '#e74c3c'),
    array('name' => 'Bilinmiyor', 'slug' => 'bilinmiyor', 'color' => '#1e88e5'),
    array('name' => 'DHL Kargo', 'slug' => 'dhl', 'color' => '#e67e22'),
    array('name' => 'PTT Kargo', 'slug' => 'ptt', 'color' => '#f1c40f'),
    array('name' => 'Sürat Kargo', 'slug' => 'surat', 'color' => '#3498db'),
    array('name' => 'Yurtiçi Kargo', 'slug' => 'yurtici', 'color' => '#2ecc71'),
    array('name' => 'MNG Kargo', 'slug' => 'mng', 'color' => '#1e88e5'),
    array('name' => 'Inter Global', 'slug' => 'inter-global', 'color' => '#9b59b6'),
);
?>

<div class="search-page">
    <!-- Header -->
    <div class="search-page-header">
        <h1>Şube Arama</h1>
    </div>
    
    <!-- Search Box -->
    <div class="search-container">
        <form class="search-box" method="get" action="<?php echo home_url(); ?>">
            <div class="search-input-wrapper">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input type="text" name="s" class="search-input" placeholder="Şube, şehir veya ilçe ara..." value="<?php echo esc_attr($search); ?>">
            </div>
            <button type="submit" class="search-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </button>
        </form>
    </div>
    
    <!-- Company Filters -->
    <div class="filter-section">
        <div class="filter-container">
            <a href="<?php echo home_url('/?s=' . urlencode($search)); ?>" class="filter-pill <?php echo !$company_filter ? 'active' : ''; ?>">Tümü</a>
            <?php foreach ($companies as $company): ?>
            <a href="<?php echo home_url('/?s=' . urlencode($search) . '&company=' . $company['slug']); ?>" 
               class="filter-pill <?php echo $company_filter === $company['slug'] ? 'active' : ''; ?>">
                <span class="company-dot" style="background-color: <?php echo $company['color']; ?>;"></span>
                <?php echo str_replace(' Kargo', '', $company['name']); ?>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
    
    <?php
    // Build query
    $search_terms = $search;
    if ($company_filter) {
        foreach ($companies as $c) {
            if ($c['slug'] === $company_filter) {
                $search_terms = str_replace(' Kargo', '', $c['name']) . ' ' . $search;
                break;
            }
        }
    }
    
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 30,
        'paged' => $paged,
        's' => $search_terms,
    );
    
    $branches = new WP_Query($args);
    ?>
    
    <!-- Results Header -->
    <div class="results-header">
        <span class="results-count"><?php echo number_format($branches->found_posts, 0, ',', '.'); ?> şube bulundu</span>
        <?php if ($search || $company_filter): ?>
        <a href="<?php echo home_url('/?s='); ?>" class="clear-filters">Temizle</a>
        <?php endif; ?>
    </div>
    
    <!-- Banner Ad -->
    <div class="banner-ad">
        <div class="banner-ad-inner">
            <span class="banner-ad-text">Reklam Alanı</span>
        </div>
    </div>
    
    <!-- Branch List -->
    <div class="branches-list">
        <?php if ($branches->have_posts()): ?>
            <?php while ($branches->have_posts()): $branches->the_post();
                $title = get_the_title();
                $company_name = kargolojik_get_company_from_title($title);
                $city = kargolojik_get_city_from_title($title);
                $district = '';
                // Extract district from title if exists
                preg_match('/([A-Za-zığüşöçİĞÜŞÖÇ]+)\s+[Şş]ubesi/u', $title, $matches);
                if (isset($matches[1]) && $matches[1] !== $city) {
                    $district = $matches[1];
                }
                $color = kargolojik_get_company_color($company_name);
            ?>
            <a href="<?php the_permalink(); ?>" class="branch-card">
                <div class="branch-header">
                    <?php if ($company_name): ?>
                    <span class="company-badge" style="background-color: <?php echo $color; ?>20; color: <?php echo $color; ?>;">
                        <?php echo esc_html($company_name); ?>
                    </span>
                    <?php endif; ?>
                    <span class="chevron">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </span>
                </div>
                <h3 class="branch-name"><?php the_title(); ?></h3>
                <?php if ($city): ?>
                <div class="branch-location">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    <?php echo esc_html($city); ?><?php echo $district ? ' / ' . esc_html($district) : ''; ?>
                </div>
                <?php endif; ?>
            </a>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="empty-state">
                <div class="empty-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </div>
                <h3 class="empty-title">Sonuç Yok</h3>
                <p class="empty-subtitle">Farklı bir arama deneyin</p>
            </div>
        <?php endif; ?>
    </div>
    
    <?php if ($branches->max_num_pages > 1): ?>
    <div class="pagination">
        <?php
        echo paginate_links(array(
            'total' => $branches->max_num_pages,
            'current' => $paged,
            'prev_text' => '&laquo;',
            'next_text' => '&raquo;',
            'add_args' => array('company' => $company_filter),
        ));
        ?>
    </div>
    <?php endif; ?>
    
    <?php wp_reset_postdata(); ?>
</div>

<?php get_footer(); ?>
