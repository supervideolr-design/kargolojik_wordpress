<?php
/**
 * Single Branch Template
 */

get_header();

$companies = get_the_terms(get_the_ID(), 'company');
$cities = get_the_terms(get_the_ID(), 'city');
$company_name = $companies ? $companies[0]->name : '';
$city_name = $cities ? $cities[0]->name : '';
$district = get_post_meta(get_the_ID(), '_branch_district', true);
$address = get_post_meta(get_the_ID(), '_branch_address', true);
$phone1 = get_post_meta(get_the_ID(), '_branch_phone1', true);
$phone2 = get_post_meta(get_the_ID(), '_branch_phone2', true);
$color = kargolojik_get_company_color($company_name);

// Company logo mapping
$company_logos = array(
    'Aras Kargo' => 'aras-logo.png',
    'PTT Kargo' => 'ptt-logo.png',
    'DHL Kargo' => 'dhl-logo.png',
    'Sürat Kargo' => 'surat-logo.png',
    'Inter Global Kargo' => 'inter-global-logo.png',
    'Yurtiçi Kargo' => 'yurtici-logo.png',
    'TNT Kargo' => 'tnt-logo.png',
    'UPS Kargo' => 'ups-logo.png',
    'MNG Kargo' => 'mng-logo.png',
);
$logo_file = isset($company_logos[$company_name]) ? $company_logos[$company_name] : '';
?>

<!-- Branch Detail Header -->
<div class="branch-detail-header" style="background-color: <?php echo $color; ?>;">
    <div class="company-logo-container">
        <?php if ($logo_file): ?>
            <img src="<?php echo KARGOLOJIK_URI; ?>/assets/images/<?php echo $logo_file; ?>" alt="<?php echo esc_attr($company_name); ?>">
        <?php else: ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="<?php echo $color; ?>" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
        <?php endif; ?>
    </div>
    <div class="company-name-header"><?php echo esc_html($company_name); ?></div>
</div>

<!-- Branch Info Card -->
<div class="branch-info-card">
    <h1 class="branch-detail-name"><?php the_title(); ?></h1>
    <div class="location-badge" style="color: <?php echo $color; ?>;">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
        <?php echo esc_html($city_name); ?> / <?php echo esc_html($district); ?>
    </div>
</div>

<!-- Address Section -->
<div class="detail-section">
    <div class="section-header">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
        <span>Adres</span>
    </div>
    <p class="address-text"><?php echo esc_html($address); ?></p>
    <p style="color: var(--text-secondary); margin-top: 4px;"><?php echo esc_html($district); ?>, <?php echo esc_html($city_name); ?></p>
</div>

<!-- Phone Section -->
<div class="detail-section">
    <div class="section-header">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
        <span>Telefon</span>
    </div>
    
    <?php if ($phone1): ?>
    <a href="tel:<?php echo preg_replace('/\s+/', '', $phone1); ?>" class="phone-row">
        <span class="phone-number"><?php echo esc_html($phone1); ?></span>
        <span class="call-badge" style="background-color: <?php echo $color; ?>;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
        </span>
    </a>
    <?php endif; ?>
    
    <?php if ($phone2): ?>
    <a href="tel:<?php echo preg_replace('/\s+/', '', $phone2); ?>" class="phone-row">
        <span class="phone-number"><?php echo esc_html($phone2); ?></span>
        <span class="call-badge" style="background-color: <?php echo $color; ?>;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
        </span>
    </a>
    <?php endif; ?>
</div>

<!-- Action Buttons -->
<div class="action-buttons">
    <?php if ($phone1): ?>
    <a href="tel:<?php echo preg_replace('/\s+/', '', $phone1); ?>" class="action-btn call" style="background-color: <?php echo $color; ?>;">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
        Şubeyi Ara
    </a>
    <?php endif; ?>
    
    <a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($address . ', ' . $district . ', ' . $city_name); ?>" target="_blank" class="action-btn maps">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="3 11 22 2 13 21 11 13 3 11"></polygon></svg>
        Yol Tarifi Al
    </a>
    
    <button class="action-btn share" onclick="shareBranch()">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line></svg>
        Paylaş
    </button>
</div>

<!-- Info Footer -->
<div style="margin: 24px 16px; padding: 16px; background: #f1f5f9; border-radius: 12px; display: flex; gap: 10px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
    <p style="flex: 1; font-size: 13px; color: #64748b; line-height: 1.5;">
        Şube bilgileri düzenli olarak güncellenmektedir. Güncel bilgi için şubeyi arayınız.
    </p>
</div>

<script>
function shareBranch() {
    const text = `<?php echo esc_js(get_the_title()); ?>\n<?php echo esc_js($address); ?>\n<?php echo esc_js($district); ?>, <?php echo esc_js($city_name); ?>\nTel: <?php echo esc_js($phone1); ?>`;
    
    if (navigator.share) {
        navigator.share({
            title: '<?php echo esc_js(get_the_title()); ?>',
            text: text,
            url: window.location.href
        });
    } else {
        navigator.clipboard.writeText(text).then(() => {
            alert('Şube bilgileri kopyalandı!');
        });
    }
}
</script>

<?php
get_footer();
