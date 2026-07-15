<?php if (!isset($hideFooter) || !$hideFooter): ?>
<footer class="webfoot">
    <div class="footcont">
        <div class="footrow">
            <div class="footcol">
                <img src="<?php echo $basePath; ?>assets/images/logo.png" alt="logo">
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

    document.addEventListener('DOMContentLoaded', () => {
        const setupEyeToggle = (eyeId, inputId) => {
            const eyeIcon = document.getElementById(eyeId);
            const passField = document.getElementById(inputId);
            
            const eyeOpen = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>';
            
            const eyeClosed = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>';

            if (eyeIcon && passField) {
                eyeIcon.addEventListener('click', function(e) {
                    e.preventDefault();
                    const isHidden = passField.getAttribute('type') === 'password';
                    
                    passField.setAttribute('type', isHidden ? 'text' : 'password');
                    this.innerHTML = isHidden ? eyeClosed : eyeOpen;
                });
            }
        };

        setupEyeToggle('eye-pass', 'pass');
        setupEyeToggle('eye-conf', 'conf');
    });

    document.addEventListener('DOMContentLoaded', () => {
        const setupEyeToggle = (eyeId, inputId) => {
            const eyeIcon = document.getElementById(eyeId);
            const passField = document.getElementById(inputId);
            
            const eyeOpen = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>';
            
            const eyeClosed = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>';

            if (eyeIcon && passField) {
                eyeIcon.addEventListener('click', function(e) {
                    e.preventDefault();
                    const isHidden = passField.getAttribute('type') === 'password';
                    
                    passField.setAttribute('type', isHidden ? 'text' : 'password');
                    this.innerHTML = isHidden ? eyeClosed : eyeOpen;
                });
            }
        };

        setupEyeToggle('eye-password', 'password');
    });
</script>
</body>
</html>