(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        var sidebar  = document.getElementById('sidebar');
        var backdrop = document.getElementById('sidebarBackdrop');
        if (!sidebar) return;

        function openSidebar() {
            sidebar.classList.add('show');
            if (backdrop) backdrop.classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            sidebar.classList.remove('show');
            if (backdrop) backdrop.classList.remove('show');
            document.body.style.overflow = '';
        }

        // Toggle buttons (hamburger)
        document.querySelectorAll('[data-sidebar-toggle]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                if (sidebar.classList.contains('show')) closeSidebar(); else openSidebar();
            });
        });

        // Click on dimmed backdrop closes the sidebar
        if (backdrop) backdrop.addEventListener('click', closeSidebar);

        // Escape key closes the sidebar
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeSidebar();
        });

        // Reset when resizing up to desktop
        window.addEventListener('resize', function () {
            if (window.innerWidth >= 992) closeSidebar();
        });

        // Auto-close after navigating on mobile
        sidebar.querySelectorAll('a.menu-link').forEach(function (link) {
            link.addEventListener('click', function () {
                if (window.innerWidth < 992) closeSidebar();
            });
        });
    });
})();
