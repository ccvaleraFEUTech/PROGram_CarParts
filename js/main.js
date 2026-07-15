document.addEventListener('DOMContentLoaded', () => {
    const header = document.querySelector('.webhead');

    const toggleHead = () => {
        const scrollpos = window.scrollY || document.documentElement.scrollTop;

        if (scrollpos > 10) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    };

    window.addEventListener('scroll', toggleHead);
    toggleHead();
});

const buttonToggle = document.getElementById('ham-toggle');
const nav = document.getElementById('main-menu');
if (buttonToggle && nav) {
    const closeMenu = () => {
        nav.classList.remove('open');
        buttonToggle.classList.remove('active');
        buttonToggle.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('menu-open');
    };

    buttonToggle.addEventListener('click', () => {
        const isOpen = nav.classList.toggle('open');
        buttonToggle.classList.toggle('active', isOpen);
        buttonToggle.setAttribute('aria-expanded', isOpen);
        document.body.classList.toggle('menu-open', isOpen);
    });

    nav.querySelectorAll('a, button').forEach((el) => {
        el.addEventListener('click', closeMenu);
    });

    document.addEventListener('click', (e) => {
        if (nav.classList.contains('open') && !nav.contains(e.target) && !buttonToggle.contains(e.target)) {
            closeMenu();
        }
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth > 991) closeMenu();
    });
}