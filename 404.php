<?php
/**
 * 404 Template
 */

get_header();
?>

<div style="text-align: center; padding: 80px 16px;">
    <div style="font-size: 120px; color: var(--border-color); margin-bottom: 24px;">404</div>
    <h1 style="font-size: 28px; margin-bottom: 12px;">Sayfa Bulunamadı</h1>
    <p style="color: var(--text-secondary); margin-bottom: 32px;">Aradığınız sayfa mevcut değil veya taşınmış olabilir.</p>
    <a href="<?php echo home_url(); ?>" style="display: inline-block; background: var(--primary-color); color: #fff; padding: 14px 32px; border-radius: 10px; font-weight: 600;">Ana Sayfaya Dön</a>
</div>

<?php
get_footer();
