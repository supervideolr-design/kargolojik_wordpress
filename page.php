<?php
/**
 * Sayfa Şablonu - Yardım Konusu Detay
 */
get_header();

$color = '#1e88e5'; // Varsayılan mavi
?>

<!-- Header -->
<div class="detail-header" style="background-color: <?php echo $color; ?>;">
    <div class="logo-box">
        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="<?php echo $color; ?>" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
    </div>
    <div class="detail-company">Yardım Rehberi</div>
</div>

<!-- Başlık Kartı -->
<div class="detail-card">
    <h1 class="detail-title"><?php the_title(); ?></h1>
</div>

<!-- İçerik -->
<div class="detail-section">
    <div class="detail-section-header">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
        <span>İçerik</span>
    </div>
    <div class="detail-content">
        <?php the_content(); ?>
    </div>
</div>

<!-- Geri Dön -->
<a href="<?php echo home_url('/yardim-konulari'); ?>" class="back-link">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
    Tüm Yardım Konuları
</a>

<?php get_footer(); ?>
