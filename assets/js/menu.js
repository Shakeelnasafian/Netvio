// Move changeSvgColor and resetSvgColor to global scope
function changeSvgColor(div) {
    const svg = div.querySelector('svg');
    if (!svg) return;

    const paths = svg.querySelectorAll('path');
    paths.forEach(path => {
        const stroke = path.getAttribute('stroke');
        if (stroke) {
            path.setAttribute('data-original-stroke', stroke);
            if (stroke.toUpperCase() === '#593FFB' || stroke.toUpperCase() === 'WHITE') {
                path.setAttribute('stroke', '#FFF');
            }
        }

        const fill = path.getAttribute('fill');
        if (fill) {
            path.setAttribute('data-original-fill', fill);
            if (fill.toUpperCase() === '#593FFB' || fill.toUpperCase() === 'WHITE') {
                path.setAttribute('fill', '#FFF');
            }
        }
    });
}

function resetSvgColor(div) {
    const svg = div.querySelector('svg');
    if (!svg) return;

    const paths = svg.querySelectorAll('path');
    paths.forEach(path => {
        const originalStroke = path.getAttribute('data-original-stroke');
        if (originalStroke) {
            path.setAttribute('stroke', originalStroke);
        }

        const originalFill = path.getAttribute('data-original-fill');
        if (originalFill) {
            path.setAttribute('fill', originalFill);
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const iconOpen = document.getElementById('menu-icon-open');
    const iconClose = document.getElementById('menu-icon-close');

    if (!toggleButton || !mobileMenu) {
        return;
    }

    const setOpen = (open) => {
        toggleButton.setAttribute('aria-expanded', open ? 'true' : 'false');
        mobileMenu.classList.toggle('hidden', !open);
        if (iconOpen && iconClose) {
            iconOpen.classList.toggle('hidden', open);
            iconClose.classList.toggle('hidden', !open);
        }
    };

    toggleButton.addEventListener('click', function (event) {
        event.stopPropagation();
        const expanded = toggleButton.getAttribute('aria-expanded') === 'true';
        setOpen(!expanded);
    });

    // Dismiss on outside click so users never feel trapped in the menu.
    document.addEventListener('click', function (event) {
        if (mobileMenu.classList.contains('hidden')) return;
        if (mobileMenu.contains(event.target) || toggleButton.contains(event.target)) return;
        setOpen(false);
    });

    // Dismiss on Escape — keyboard users often try this first.
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && !mobileMenu.classList.contains('hidden')) {
            setOpen(false);
            toggleButton.focus();
        }
    });

    // Close on internal anchor navigation so the menu doesn't cover the target.
    mobileMenu.querySelectorAll('a[href^="#"], a[href^="/"]').forEach(link => {
        link.addEventListener('click', () => setOpen(false));
    });
});
