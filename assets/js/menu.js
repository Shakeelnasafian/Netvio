console.log("menu.js loaded");
// Move changeSvgColor and resetSvgColor to global scope
function changeSvgColor(div) {
    const svg = div.querySelector('svg');
    if (!svg) return;

    const paths = svg.querySelectorAll('path');
    paths.forEach(path => {
        // Handle stroke
        const stroke = path.getAttribute('stroke');
        if (stroke) {
            path.setAttribute('data-original-stroke', stroke);
            if (stroke.toUpperCase() === '#593FFB' || stroke.toUpperCase() === 'WHITE') {
                path.setAttribute('stroke', '#FFF');
            }
        }

        // Handle fill
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
        // Restore stroke
        const originalStroke = path.getAttribute('data-original-stroke');
        if (originalStroke) {
            path.setAttribute('stroke', originalStroke);
        }

        // Restore fill
        const originalFill = path.getAttribute('data-original-fill');
        if (originalFill) {
            path.setAttribute('fill', originalFill);
        }
    });
}

// Keep the DOMContentLoaded block for menu toggle functionality
document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    toggleButton.addEventListener('click', function () {
        mobileMenu.classList.toggle('hidden');
    });
});