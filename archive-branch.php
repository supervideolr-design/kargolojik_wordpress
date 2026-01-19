<?php
/**
 * Archive Branch Template (Search/List Page)
 */

get_header();

$search = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
$company_filter = isset($_GET['company']) ? sanitize_text_field($_GET['company']) : '';
$paged = get_query_var('paged') ? get_query_var('paged') : 1;

// Get all companies for filter
$companies = get_terms(array(
    'taxonomy' => 'company',
    'hide_empty' => true,
));
?>

<!-- Search Box -->
<section class="search-container" style="margin-top: 24px;">
    <form class="search-box" method="get" action="<?php echo get_post_type_archive_link('branch'); ?>">
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
        <a href="<?php echo get_post_type_archive_link('branch'); ?>" 
           class="filter-pill <?php echo !$company_filter ? 'active' : ''; ?>">
            Tümü
        </a>
        <?php foreach ($companies as $company): 
            $color = kargolojik_get_company_color($company->name);
        ?>
        <a href="<?php echo add_query_arg('company', $company->slug, get_post_type_archive_link('branch')); ?>" 
           class="filter-pill <?php echo $company_filter === $company->slug ? 'active' : ''; ?>">
            <span class="company-dot" style="background-color: <?php echo $color; ?>;"></span>
            <?php echo str_replace(' Kargo', '', $company->name); ?>
        </a>
        <?php endforeach; ?>
    </div>
</section>

<!-- Branches List -->
<section class="branches-section">
    <?php
    $args = array(
        'post_type' => 'branch',
        'posts_per_page' => 30,
        'paged' => $paged,
        's' => $search,
    );
    
    if ($company_filter) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'company',
                'field' => 'slug',
                'terms' => $company_filter,
            ),
        );
    }
    
    $branches = new WP_Query($args);
    ?>
    
    <div class="results-header">
        <span class="results-count">
            <?php echo number_format($branches->found_posts, 0, ',', '.'); ?> şube bulundu
        </span>
        <?php if ($search || $company_filter): ?>
        <a href="<?php echo get_post_type_archive_link('branch'); ?>" class="clear-filters">Temizle</a>
        <?php endif; ?>
    </div>
    
    <div class="branches-grid">
        <?php if ($branches->have_posts()): ?>
            <?php while ($branches->have_posts()): $branches->the_post();
                $post_companies = get_the_terms(get_the_ID(), 'company');
                $post_cities = get_the_terms(get_the_ID(), 'city');
                $post_company_name = $post_companies ? $post_companies[0]->name : '';
                $post_city_name = $post_cities ? $post_cities[0]->name : '';
                $post_district = get_post_meta(get_the_ID(), '_branch_district', true);
                $color = kargolojik_get_company_color($post_company_name);
            ?>
            <a href="<?php the_permalink(); ?>" class="branch-card">
                <div class="branch-header">
                    <span class="company-badge" style="background-color: <?php echo $color; ?>20; color: <?php echo $color; ?>;">
                        <?php echo esc_html($post_company_name); ?>
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
                <h3 class="branch-name"><?php the_title(); ?></h3>
                <div class="branch-location">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    <?php echo esc_html($post_city_name); ?> / <?php echo esc_html($post_district); ?>
                </div>
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
        ));
        ?>
    </div>
    <?php endif; ?>
    
    <?php wp_reset_postdata(); ?>
</section>

<?php
get_footer();
