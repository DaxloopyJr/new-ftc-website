// FCT navigation: open dropdowns on hover, close on mouse off
document.addEventListener('DOMContentLoaded', function () {
    if (!window.bootstrap) return;
    document.querySelectorAll('.navbar-fct .nav-item.dropdown').forEach(function (dd) {
        var toggle = dd.querySelector('[data-bs-toggle="dropdown"]');
        if (!toggle) return;
        var inst = bootstrap.Dropdown.getOrCreateInstance(toggle);
        dd.addEventListener('mouseenter', function () { inst.show(); });
        dd.addEventListener('mouseleave', function () { inst.hide(); });
    });
});
