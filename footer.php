<?php
/**
 * Footer Template
 */
?>
</main>

<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-section">
            <h3>Kargolojik</h3>
            <p>Türkiye'nin en kapsamlı kargo şube arama ve sorun çözüm platformu.</p>
        </div>
        
        <div class="footer-section">
            <h3>Kargo Şirketleri</h3>
            <ul>
                <li><a href="<?php echo home_url('/kargo-sirketi/aras-kargo'); ?>">Aras Kargo</a></li>
                <li><a href="<?php echo home_url('/kargo-sirketi/ptt-kargo'); ?>">PTT Kargo</a></li>
                <li><a href="<?php echo home_url('/kargo-sirketi/yurtici-kargo'); ?>">Yurtiçi Kargo</a></li>
                <li><a href="<?php echo home_url('/kargo-sirketi/mng-kargo'); ?>">MNG Kargo</a></li>
                <li><a href="<?php echo home_url('/kargo-sirketi/surat-kargo'); ?>">Sürat Kargo</a></li>
            </ul>
        </div>
        
        <div class="footer-section">
            <h3>Yardım</h3>
            <ul>
                <li><a href="<?php echo home_url('/yardim/hasarli-kargo'); ?>">Hasarlı Kargo</a></li>
                <li><a href="<?php echo home_url('/yardim/kayip-kargo'); ?>">Kayıp Kargo</a></li>
                <li><a href="<?php echo home_url('/yardim/geciken-kargo'); ?>">Geciken Kargo</a></li>
                <li><a href="<?php echo home_url('/yardim/tazminat'); ?>">Tazminat Hakları</a></li>
            </ul>
        </div>
        
        <div class="footer-section">
            <h3>İletişim</h3>
            <ul>
                <li><a href="<?php echo home_url('/iletisim'); ?>">İletişim Formu</a></li>
                <li><a href="<?php echo home_url('/hakkimizda'); ?>">Hakkımızda</a></li>
                <li><a href="<?php echo home_url('/gizlilik-politikasi'); ?>">Gizlilik Politikası</a></li>
            </ul>
        </div>
    </div>
    
    <div class="footer-bottom">
        <p>Kargolojik © <?php echo date('Y'); ?> - Tüm hakları saklıdır.</p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
