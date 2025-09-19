
document.addEventListener("DOMContentLoaded", function() {
   
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