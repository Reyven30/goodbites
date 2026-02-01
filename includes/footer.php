<!-- Footer -->
<footer class="site-footer">
    <div class="footer-content">
        <p>Made By Reyven Flores</p>
    </div>
</footer>

<!-- Bootstrap JS per hamburger menu -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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
