<!-- Footer -->
<footer class="site-footer">
    <div class="footer-content">
        <p>Made By Reyven Flores</p>
    </div>
</footer>

<!-- Script Navbar Scroll -->
<script>
(function() {
    let lastScroll = 0;
    const navbar = document.querySelector('.navbar');
    
    window.addEventListener('scroll', function() {
        const currentScroll = window.pageYOffset;
        
        if (currentScroll <= 0) {
            navbar.classList.remove('nav-hidden');
            return;
        }
        
        if (currentScroll > lastScroll && currentScroll > 80) {
            // Scroll giù - nascondi navbar
            navbar.classList.add('nav-hidden');
        } else {
            // Scroll su - mostra navbar
            navbar.classList.remove('nav-hidden');
        }
        
        lastScroll = currentScroll;
    });
})();
</script>
