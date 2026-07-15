        </div>
    </div>

<script>
    const adminToggle = document.getElementById('admin-toggle');
    const adminSidebar = document.getElementById('admin-sidebar');
    const adminOverlay = document.getElementById('admin-overlay');

    if (adminToggle && adminSidebar && adminOverlay) {
        const closeSidebar = () => {
            adminSidebar.classList.remove('open');
            adminOverlay.classList.remove('show');
            adminToggle.setAttribute('aria-expanded', 'false');
        };

        adminToggle.addEventListener('click', () => {
            const isOpen = adminSidebar.classList.toggle('open');
            adminOverlay.classList.toggle('show', isOpen);
            adminToggle.setAttribute('aria-expanded', isOpen);
        });

        adminOverlay.addEventListener('click', closeSidebar);

        window.addEventListener('resize', () => {
            if (window.innerWidth > 991) closeSidebar();
        });
    }
</script>
