<?php
/**
 * Single Post - Şube Detay - Birebir Aynı
 */
get_header();

$title = get_the_title();
$content = get_the_content();
$company_name = kargolojik_get_company_from_title($title);
$city = kargolojik_get_city_from_title($title);
$color = kargolojik_get_company_color($company_name);
$logo = kargolojik_get_company_logo($company_name);
?>

<!-- Branch Detail Header -->
<div class="branch-detail-header" style="background-color: <?php echo $color; ?>;">
    <div class="company-logo-box">
        <?php if ($logo): ?>
            <img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr($company_name); ?>">
        <?php else: ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="<?php echo $color; ?>" stroke-width="2"><line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
        <?php endif; ?>
    </div>
    <div class="company-name-header"><?php echo esc_html($company_name); ?></div>
</div>

<!-- Branch Info Card -->
<div class="branch-info-card">
    <h1 class="branch-detail-name"><?php the_title(); ?></h1>
    <?php if ($city): ?>
    <div class="location-badge" style="color: <?php echo $color; ?>;">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
        <?php echo esc_html($city); ?>
    </div>
    <?php endif; ?>
</div>

<!-- Content Section -->
<div class="detail-section">
    <div class="detail-section-header">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
        <span>Şube Bilgileri</span>
    </div>
    <div class="detail-content">
        <?php the_content(); ?>
    </div>
</div>

<!-- Action Buttons -->
<div class="action-buttons">
    <a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($title); ?>" target="_blank" class="action-btn maps" style="background-color: <?php echo $color; ?>;">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="3 11 22 2 13 21 11 13 3 11"></polygon></svg>
        Yol Tarifi Al
    </a>
    
    <button class="action-btn share" onclick="shareBranch()">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line></svg>
        Paylaş
    </button>
</div>

<!-- Back Link -->
<a href="<?php echo home_url('/?s='); ?>" class="back-link">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
    Tüm Şubelere Dön
</a>

<!-- Info Footer -->
<div class="info-footer">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
    <p>Şube bilgileri düzenli olarak güncellenmektedir. Güncel bilgi için şubeyi arayınız.</p>
</div>

<script>
function shareBranch() {
    const title = '<?php echo esc_js($title); ?>';
    const url = '<?php echo esc_url(get_permalink()); ?>';
    
    if (navigator.share) {
        navigator.share({ title, url });
    } else {
        navigator.clipboard.writeText(title + '\n' + url).then(() => {
            alert('Şube bilgileri kopyalandı!');
        });
    }
}
</script>

<?php get_footer(); ?>
