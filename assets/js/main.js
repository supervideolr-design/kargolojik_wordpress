/**
 * Kargolojik Theme - Main JavaScript
 */

(function($) {
    'use strict';

    // Mobile Menu Toggle
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const mainNav = document.querySelector('.main-nav');
    
    if (mobileMenuBtn && mainNav) {
        mobileMenuBtn.addEventListener('click', function() {
            mainNav.classList.toggle('active');
        });
    }

    // Turkish Character Normalization
    function normalizeTurkish(text) {
        const turkish = {
            'ı': 'i', 'ğ': 'g', 'ü': 'u', 'ş': 's', 'ö': 'o', 'ç': 'c',
            'İ': 'i', 'Ğ': 'g', 'Ü': 'u', 'Ş': 's', 'Ö': 'o', 'Ç': 'c'
        };
        return text.toLowerCase().replace(/[\u0131\u011f\u00fc\u015f\u00f6\u00e7\u0130\u011e\u00dc\u015e\u00d6\u00c7]/g, 
            char => turkish[char] || char
        );
    }

    // AJAX Search (if needed for instant search)
    const searchInput = document.querySelector('.search-input');
    let searchTimeout;

    if (searchInput && typeof kargolojik_ajax !== 'undefined') {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const query = this.value.trim();
            
            if (query.length >= 2) {
                searchTimeout = setTimeout(function() {
                    // Could implement instant search here
                    console.log('Searching for:', query);
                }, 300);
            }
        });
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // Company filter pills
    const filterPills = document.querySelectorAll('.filter-pill');
    filterPills.forEach(pill => {
        pill.addEventListener('click', function(e) {
            if (this.dataset.ajax) {
                e.preventDefault();
                filterPills.forEach(p => p.classList.remove('active'));
                this.classList.add('active');
                // Could implement AJAX filtering here
            }
        });
    });

    // Lazy loading for images
    if ('IntersectionObserver' in window) {
        const lazyImages = document.querySelectorAll('img[data-src]');
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    observer.unobserve(img);
                }
            });
        });

        lazyImages.forEach(img => imageObserver.observe(img));
    }

    // Share functionality
    window.sharePage = function(title, text, url) {
        if (navigator.share) {
            navigator.share({ title, text, url });
        } else {
            const tempInput = document.createElement('input');
            document.body.appendChild(tempInput);
            tempInput.value = text + '\n' + url;
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);
            alert('Bilgiler kopyalandı!');
        }
    };

    // Stats counter animation
    const statNumbers = document.querySelectorAll('.stat-number');
    const observerOptions = { threshold: 0.5 };

    const animateNumber = (el) => {
        const target = parseInt(el.textContent.replace(/[^0-9]/g, ''));
        const duration = 1000;
        const start = 0;
        const increment = target / (duration / 16);
        let current = start;

        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                el.textContent = target.toLocaleString('tr-TR') + '+';
                clearInterval(timer);
            } else {
                el.textContent = Math.floor(current).toLocaleString('tr-TR') + '+';
            }
        }, 16);
    };

    if ('IntersectionObserver' in window && statNumbers.length) {
        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateNumber(entry.target);
                    statsObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);

        statNumbers.forEach(el => statsObserver.observe(el));
    }

})(jQuery);
