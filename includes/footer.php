<?php if (!isset($hideFooter) || !$hideFooter): ?>
<footer class="webfoot">
    <div class="footcont">
        <div class="footrow">
            <div class="footcol">
                <img src="/PROGram/assets/images/logo.png" alt="logo">
                <h5>PROGram</h5>
                <p>Group members: </p>
                <div class="members">
                    <p>Jade Carlos Castillo</p>
                    <p>James Ivan Frondarina</p>
                    <p>Gene Andrei Manacop</p>
                    <p>Cedrick Nicolas Valera</p>
                </div>
            </div>
            <div class="footcol second">
                <h6>Contact Info</h6>
                <p>Email: program@gmail.com</p>
                <p>Contact Number: (+632) 912-3456</p>
            </div>
        </div>

        <p class="disclaimer">
            This website is a student project from FEU Tech, subject CCS0043/L, which is for
            educational purposes only. No real transactions take place.
        </p>
    </div>
</footer>

<?php endif; ?>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const header = document.querySelector('.webhead');

        const toggleHead = () => {
            const scrollpos = window.scrollY || document.documentElement.scrollTop;

            if (scrollpos > 10){
                header.classList.add('scrolled')
            } else {
                header.classList.remove('scrolled')
            }
        };

        window.addEventListener('scroll', toggleHead);
        toggleHead();
    });

     const buttonToggle = document.getElementById('ham-toggle')
    const nav = document.getElementById('main-menu')
    if(buttonToggle && nav){
        const closeMenu = () => {
            nav.classList.remove('open')
            buttonToggle.classList.remove('active')
            buttonToggle.setAttribute('aria-expanded', 'false')
            document.body.classList.remove('menu-open')
        };

        buttonToggle.addEventListener('click', () => {
            const isOpen = nav.classList.toggle('open')
            buttonToggle.classList.toggle('active', isOpen)
            buttonToggle.setAttribute('aria-expanded', isOpen)
            document.body.classList.toggle('menu-open', isOpen)
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
</script>
</body>
</html>