const menuBtn = document.getElementById('menuBtn');
const menu = document.getElementById('menu');

if (menuBtn && menu) {
    menuBtn.addEventListener('click', () => {
        menu.classList.toggle('open');
    });
}

const serviceCards = document.querySelectorAll('.service-card');

if ('IntersectionObserver' in window && serviceCards.length) {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.2,
    });

    serviceCards.forEach((card) => observer.observe(card));
} else {
    serviceCards.forEach((card) => card.classList.add('visible'));
}
