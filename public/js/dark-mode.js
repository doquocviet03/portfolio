
/* =========================================
   PORTFOLIO THEME + ANIMATION
   FIX DARK / LIGHT MODE
========================================= */

(function () {
    'use strict';

    const STORAGE_KEY = 'portfolio-theme';

    function getSavedTheme() {
        try {
            return localStorage.getItem(STORAGE_KEY);
        } catch (error) {
            return null;
        }
    }

    function saveTheme(theme) {
        try {
            localStorage.setItem(STORAGE_KEY, theme);
        } catch (error) {
            // Không thể lưu chế độ giao diện.
        }
    }

    function getCurrentTheme() {
        return document.documentElement.getAttribute('data-theme') === 'dark'
            ? 'dark'
            : 'light';
    }

    function applyTheme(theme) {
        const selectedTheme = theme === 'dark' ? 'dark' : 'light';

        // Đồng bộ giao diện tùy chỉnh và Bootstrap 5.3
        document.documentElement.setAttribute('data-theme', selectedTheme);
        document.documentElement.setAttribute('data-bs-theme', selectedTheme);

        document.body.classList.toggle(
            'dark-mode',
            selectedTheme === 'dark'
        );

        document.body.classList.toggle(
            'light-mode',
            selectedTheme === 'light'
        );

        updateButton();
    }

    function updateButton() {
        const button = document.getElementById('themeToggle');

        if (!button) return;

        const dark = getCurrentTheme() === 'dark';

        button.innerHTML = dark
            ? '<i class="bi bi-sun-fill"></i>'
            : '<i class="bi bi-moon-stars-fill"></i>';

        button.setAttribute(
            'aria-label',
            dark ? 'Chuyển sang chế độ sáng' : 'Chuyển sang chế độ tối'
        );

        button.setAttribute(
            'title',
            dark ? 'Chuyển sang chế độ sáng' : 'Chuyển sang chế độ tối'
        );

        button.setAttribute('aria-pressed', String(dark));
    }

    function initTheme() {
        const saved = getSavedTheme();

        const preferredDark = window.matchMedia(
            '(prefers-color-scheme: dark)'
        ).matches;

        const theme = saved === 'dark' || saved === 'light'
            ? saved
            : (preferredDark ? 'dark' : 'light');

        applyTheme(theme);

        const button = document.getElementById('themeToggle');

        if (button) {
            button.addEventListener('click', function () {
                const next = getCurrentTheme() === 'dark'
                    ? 'light'
                    : 'dark';

                applyTheme(next);
                saveTheme(next);
            });
        }
    }

    function initAnimations() {
        const reduceMotion = window.matchMedia(
            '(prefers-reduced-motion: reduce)'
        ).matches;

        if (reduceMotion || !('IntersectionObserver' in window)) {
            return;
        }

        const elements = document.querySelectorAll(
            '.custom-card, .skill-card, .experience-card, .project-card'
        );

        if (!elements.length) return;

        const observer = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            },
            {
                threshold: 0.08,
                rootMargin: '0px 0px 40px 0px'
            }
        );

        elements.forEach(function (element) {
            element.classList.add('reveal-on-scroll');
            observer.observe(element);
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        initTheme();
        initAnimations();
    });
})();
