document.addEventListener('DOMContentLoaded', () => {
    const track = document.querySelector('.carousel-track');
    const items = Array.from(track.children);
    const nextButton = document.querySelector('.carousel-control.next');
    const prevButton = document.querySelector('.carousel-control.prev');
    const itemWidth = items[0].getBoundingClientRect().width + parseInt(getComputedStyle(items[0]).marginRight);
    const itemsPerClick = 3; // Configura cuántos elementos avanzar por clic
    let currentIndex = 0;
    let isTransitioning = false;

    // Clonar los elementos para efecto infinito
    items.forEach(item => {
        const cloneFirst = item.cloneNode(true);
        const cloneLast = item.cloneNode(true);
        track.appendChild(cloneFirst);
        track.insertBefore(cloneLast, items[0]);
    });

    // Ajustar la posición inicial
    track.style.transform = `translateX(-${items.length * itemWidth}px)`;

    const moveToIndex = (index) => {
        if (isTransitioning) return;
        isTransitioning = true;
        track.style.transition = 'transform 0.5s ease-in-out';
        track.style.transform = `translateX(-${index * itemWidth}px)`;

        track.addEventListener('transitionend', () => {
            isTransitioning = false;
            if (index >= items.length * 2) {
                track.style.transition = 'none';
                currentIndex = items.length;
                track.style.transform = `translateX(-${currentIndex * itemWidth}px)`;
            } else if (index < 0) {
                track.style.transition = 'none';
                currentIndex = items.length - 1;
                track.style.transform = `translateX(-${currentIndex * itemWidth}px)`;
            }
        }, { once: true });
    };

    nextButton.addEventListener('click', () => {
        if (isTransitioning) return;
        currentIndex += itemsPerClick; // Avanza varios elementos
        moveToIndex(currentIndex);
    });

    prevButton.addEventListener('click', () => {
        if (isTransitioning) return;
        currentIndex -= itemsPerClick; // Retrocede varios elementos
        moveToIndex(currentIndex);
    });
});
