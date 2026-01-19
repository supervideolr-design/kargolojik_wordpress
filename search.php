<?php
/**
 * Search Results Template - Şube Arama
 */

get_header();

$search = get_search_query();
$paged = get_query_var('paged') ? get_query_var('paged') : 1;

// Company filters from URL
$company_filter = isset($_GET['company']) ? sanitize_text_field($_GET['company']) : '';

// Available companies
$companies = array(
    'Aras Kargo',
    'PTT Kargo',
    'DHL Kargo',
    'Sürat Kargo',
    'Inter Global Kargo',
    'Yurtiçi Kargo',
    'TNT Kargo',
    'UPS Kargo',
    'MNG Kargo',
);
?>

<!-- Search Box -->
<section class="search-container" style="margin-top: 24px;">
    <form class="search-box" method="get" action="<?php echo home_url(); ?>">
        <div class="search-input-wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            <input type="text" name="s" class="search-input" placeholder="Şube, şehir veya ilçe ara..." value="<?php echo esc_attr($search); ?>">
        </div>
        <button type="submit" class="search-btn">Ara</button>
    </form>
</section>

<!-- Company Filters -->
<section class="filter-section">
    <div class="filter-container">
        <a href="<?php echo home_url('/?s=' . urlencode($search)); ?>" 
           class="filter-pill <?php echo !$company_filter ? 'active' : ''; ?>">
            Tümü
        </a>
        <?php foreach ($companies as $company): 
            $color = kargolojik_get_company_color($company);
            $company_slug = sanitize_title($company);
            $is_active = ($company_filter === $company_slug);
        ?>
        <a href="<?php echo home_url('/?s=' . urlencode($search) . '&company=' . $company_slug); ?>" 
           class="filter-pill <?php echo $is_active ? 'active' : ''; ?>">
            <span class="company-dot" style="background-color: <?php echo $color; ?>;"></span>
            <?php echo str_replace(' Kargo', '', $company); ?>
        </a>
        <?php endforeach; ?>
    </div>
</section>

<!-- Branches List -->
<section class="branches-section">
    <?php
    // Build search query
    $search_terms = $search;
    if ($company_filter) {
        // Add company name to search
        $company_name = '';
        foreach ($companies as $c) {
            if (sanitize_title($c) === $company_filter) {
                $company_name = $c;
                break;
            }
        }
        if ($company_name) {
            $search_terms = $company_name . ' ' . $search;
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
    
    <div class="results-header">
        <span class="results-count">
            <?php echo number_format($branches->found_posts, 0, ',', '.'); ?> şube bulundu
            <?php if ($search): ?>
                - "<?php echo esc_html($search); ?>" için
            <?php endif; ?>
        </span>
        <?php if ($search || $company_filter): ?>
        <a href="<?php echo home_url(); ?>" class="clear-filters">Temizle</a>
        <?php endif; ?>
    </div>
    
    <div class="branches-grid">
        <?php if ($branches->have_posts()): ?>
            <?php while ($branches->have_posts()): $branches->the_post();
                $title = get_the_title();
                $company_name = kargolojik_get_company_from_title($title);
                $city = kargolojik_get_city_from_title($title);
                $color = kargolojik_get_company_color($company_name);
            ?>
            <a href="<?php the_permalink(); ?>" class="branch-card">
                <div class="branch-header">
                    <?php if ($company_name): ?>
                    <span class="company-badge" style="background-color: <?php echo $color; ?>20; color: <?php echo $color; ?>;">
                        <?php echo esc_html($company_name); ?>
                    </span>
                    <?php endif; ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
                <h3 class="branch-name"><?php the_title(); ?></h3>
                <?php if ($city): ?>
                <div class="branch-location">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    <?php echo esc_html($city); ?>
                </div>
                <?php endif; ?>
            </a>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="empty-state" style="grid-column: 1 / -1;">
                <div class="empty-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </div>
                <h3 class="empty-title">Sonuç Bulunamadı</h3>
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
            'prev_text' => '&laquo; Önceki',
            'next_text' => 'Sonraki &raquo;',
            'add_args' => array('company' => $company_filter),
        ));
        ?>
    </div>
    <?php endif; ?>
    
    <?php wp_reset_postdata(); ?>
</section>

<?php
get_footer();
