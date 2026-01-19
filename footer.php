<?php
/**
 * Footer - Mobil Uygulama ile Birebir Aynı (Alt Tab Bar)
 */
?>
</main>

<!-- Alt Tab Bar -->
<nav class="bottom-tabs">
    <div class="tabs-inner">
        <a href="<?php echo home_url(); ?>" class="tab-item <?php echo is_front_page() ? 'active' : ''; ?>">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        </a>
        <a href="<?php echo home_url('/yardim-konulari'); ?>" class="tab-item <?php echo is_page('yardim-konulari') || is_page() && !is_front_page() && !is_search() ? 'active' : ''; ?>">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
        </a>
        <a href="<?php echo home_url('/?s='); ?>" class="tab-item <?php echo is_search() ? 'active' : ''; ?>">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        </a>
    </div>
</nav>

<?php wp_footer(); ?>
</body>
</html>
