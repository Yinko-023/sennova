// public/js/calidad_specific.js
document.addEventListener("DOMContentLoaded", function() {
    // Lógica de zoom y drag para zoomImg (de calidad.html)
    const zoomImg = document.getElementById('zoomImg');
    if (zoomImg) {
        let isZoomed = false;
        let isDragging = false;
        let startX, startY, currentX = 0, currentY = 0;

        zoomImg.addEventListener('click', () => {
            isZoomed = !isZoomed;
            if (isZoomed) {
                zoomImg.classList.add('zoomed');
                zoomImg.style.transform = `scale(2) translate(0px, 0px)`;
                currentX = 0;
                currentY = 0;
            } else {
                zoomImg.classList.remove('zoomed');
                zoomImg.style.transform = '';
            }
        });

        zoomImg.addEventListener('mousedown', (e) => {
            if (!isZoomed) return;
            isDragging = true;
            zoomImg.classList.add('dragging');
            startX = e.clientX - currentX;
            startY = e.clientY - currentY;
        });

        document.addEventListener('mousemove', (e) => {
            if (!isDragging || !isZoomed) return;
            currentX = e.clientX - startX;
            currentY = e.clientY - startY;
            zoomImg.style.transform = `scale(2) translate(${currentX}px, ${currentY}px)`;
        });

        document.addEventListener('mouseup', () => {
            isDragging = false;
            zoomImg.classList.remove('dragging');
        });
    }

    // Lógica para abrir modal con imagen (de calidad.html, si usa img-thumbnail)
    const imgThumbnail = document.getElementById('img-thumbnail');
    const modalElement = document.getElementById('imagenModal');
    if (imgThumbnail && modalElement) {
        const modal = new bootstrap.Modal(modalElement);
        const modalImg = modalElement.querySelector('img');

        imgThumbnail.style.cursor = 'pointer';
        imgThumbnail.addEventListener('click', () => {
            modalImg.src = imgThumbnail.src;
            modal.show();
        });
    }
});