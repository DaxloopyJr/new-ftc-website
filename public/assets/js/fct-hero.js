// FCT hero carousel: slide counter sync
document.addEventListener('DOMContentLoaded', function () {
    var carousel = document.getElementById('heroCarousel');
    if (!carousel) return;
    var counter = document.getElementById('cmtCounter');
    if (!counter) return;
    var items = carousel.querySelectorAll('.carousel-item');
    carousel.addEventListener('slid.bs.carousel', function (e) {
        var idx = Array.prototype.indexOf.call(items, e.relatedTarget);
        if (idx > -1) { counter.textContent = idx + 1; }
    });
});
