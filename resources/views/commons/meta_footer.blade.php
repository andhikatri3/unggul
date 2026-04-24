@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile Menu Toggle
        var mobileMenuBtn = document.getElementById('mobile-menu-btn');
        var mobileMenuBtnSticky = document.getElementById('mobile-menu-btn-sticky');
        var mobileMenu = document.getElementById('mobile-menu');
        var mobileMenuBackdrop = document.getElementById('mobile-menu-backdrop');
        var closeMenuBtn = document.getElementById('close-menu-btn');

        function openMobileMenu() {
            if (mobileMenu) mobileMenu.classList.add('active');
            if (mobileMenuBackdrop) mobileMenuBackdrop.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        function closeMobileMenu() {
            if (mobileMenu) mobileMenu.classList.remove('active');
            if (mobileMenuBackdrop) mobileMenuBackdrop.classList.add('hidden');
            document.body.style.overflow = '';
        }

        if (mobileMenuBtn) mobileMenuBtn.addEventListener('click', openMobileMenu);
        if (mobileMenuBtnSticky) mobileMenuBtnSticky.addEventListener('click', openMobileMenu);
        if (closeMenuBtn) closeMenuBtn.addEventListener('click', closeMobileMenu);
        if (mobileMenuBackdrop) mobileMenuBackdrop.addEventListener('click', closeMobileMenu);

        // Hero Slider
        if (document.querySelector('.hero-swiper')) {
            new Swiper('.hero-swiper', {
                loop: true,
                autoplay: { delay: 5000, disableOnInteraction: false },
                pagination: { el: '.hero-swiper .swiper-pagination', clickable: true },
                navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
                effect: 'fade',
                fadeEffect: { crossFade: true }
            });
        }

        // Officials Slider
        if (document.querySelector('.officials-swiper')) {
            new Swiper('.officials-swiper', {
                loop: true,
                autoplay: { delay: 3000, disableOnInteraction: false },
                pagination: { el: '.officials-swiper .swiper-pagination', clickable: true },
                slidesPerView: 1,
                spaceBetween: 20
            });
        }

        // Scroll to top
        var scrollBtn = document.getElementById('scrollToTop');
        window.addEventListener('scroll', function() {
            if (scrollBtn) {
                if (window.scrollY > 300) {
                    scrollBtn.classList.remove('hidden');
                    scrollBtn.classList.add('flex');
                } else {
                    scrollBtn.classList.add('hidden');
                    scrollBtn.classList.remove('flex');
                }
            }
        });
        if (scrollBtn) {
            scrollBtn.addEventListener('click', function(e) {
                e.preventDefault();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }
    });

    // Toggle submenu in mobile
    function toggleSubmenu(submenuId, trigger) {
        var submenu = document.getElementById(submenuId);
        if (submenu) {
            submenu.classList.toggle('hidden');
            if (trigger) {
                var chevron = trigger.querySelector('.fa-chevron-down');
                if (chevron) chevron.classList.toggle('rotate-180');
            }
        }
    }
</script>

<script>
    $.extend($.fn.dataTable.defaults, {
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "Semua"]
        ],
        pageLength: 10,
        language: {
            url: "{{ asset('bootstrap/js/dataTables.indonesian.lang') }}",
        }
    });
</script>

@if (!setting('inspect_element'))
    <script src="{{ asset('js/disabled.min.js') }}"></script>
@endif
