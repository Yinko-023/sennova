// public/js/funcion.js

console.log("funcion.js cargado correctamente");

document.addEventListener("DOMContentLoaded", function () {
  // Activar nav (ajustado para URLs MVC)
  const pathSegments = window.location.pathname.split('/').filter(segment => segment !== '');
  const currentPage = pathSegments[pathSegments.length - 1]; // Último segmento de la URL

  document.querySelectorAll('.nav-link').forEach(link => {
    link.classList.remove('active');
    // Para enlaces directos como "home", "cronograma"
    if (link.href.endsWith(currentPage) || (currentPage === 'home' && link.href.endsWith(BASE_URL))) {
      link.classList.add('active');
    }
  });

  // Para el dropdown "Laboratorio"
  if (pathSegments.includes('publications')) {
    const laboratorioLink = document.querySelector('a.nav-link.dropdown-toggle');
    if (laboratorioLink) laboratorioLink.classList.add('active');
  }

  // Spinner (esto ya estaba bien, solo asegúrate de que esté aquí)
  window.addEventListener('load', () => {
    const spinner = document.getElementById('spinner-carga');
    if (spinner) {
      spinner.style.transition = 'opacity 2s ease';
      spinner.style.opacity = '0';
      setTimeout(() => {
        spinner.style.display = 'none';
        spinner.remove();
      }, 1000);
    }
  });
});