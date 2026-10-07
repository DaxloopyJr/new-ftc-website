// FCT document lists: AJAX filtering + pagination for publications & info library
document.addEventListener('DOMContentLoaded', function () {
    var wrap = document.getElementById('doclist-wrap');
    if (!wrap) return;
    var form = document.getElementById('doclist-filters');

    function load(url) {
        wrap.style.opacity = '.5';
        fetch(url + (url.indexOf('?') > -1 ? '&' : '?') + 'ajax=1', {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(function (r) { return r.json(); })
        .then(function (data) {
            wrap.innerHTML = data.html;
            wrap.style.opacity = '1';
            if (window.history && window.history.pushState) { window.history.pushState({}, '', url); }
            wrap.scrollIntoView({ behavior: 'smooth', block: 'start' });
        })
        .catch(function () { window.location.href = url; });
    }

    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            var params = new URLSearchParams(new FormData(form));
            var base = form.getAttribute('action') || window.location.pathname;
            load(base + '?' + params.toString());
        });
    }

    wrap.addEventListener('click', function (e) {
        var a = e.target.closest('a.page-link');
        if (!a) return;
        var href = a.getAttribute('href');
        if (!href || href === '#') return;
        e.preventDefault();
        load(href);
    });
});
