// FCT hero carousel: overlap transition for dynamic (split) slides
document.addEventListener('DOMContentLoaded', function () {
    var carousel = document.getElementById('heroCarousel');
    if (!carousel || !window.bootstrap) return;

    function activate(el) {
        if (!el) return;
        document.querySelectorAll('.hero-split-slide').forEach(function (s) {
            s.classList.remove('active', 'overlap-in');
        });
        el.classList.add('active');
        void el.offsetWidth; // restart the wipe animation
        el.classList.add('overlap-in');
    }

    carousel.addEventListener('slid.bs.carousel', function (e) {
        activate(e.relatedTarget && e.relatedTarget.querySelector('.hero-split-slide'));
    });

    var initial = carousel.querySelector('.carousel-item.active .hero-split-slide');
    if (initial) activate(initial);
});
