<?php

/**
 * Classe per mostrar el peu de pàgina (footer).
 *
 * Aquesta classe gestiona la visualització del peu de pàgina en la pàgina web,
 * incloent la informació de drets d'autor i els scripts de Bootstrap per al carrusel.
 */
class Footer {

    /**
     * Mètode per mostrar el peu de pàgina.
     *
     * Aquest mètode imprimeix el codi HTML per al peu de pàgina, així com els scripts
     * necessaris per a la funcionalitat del carrusel utilitzant Bootstrap.
     * També carrega els scripts de Bootstrap des d'un repositori remot.
     *
     * @return void
     */
   public function mostrarFooter() {
        // Imprimeix el HTML del peu de pàgina
        echo '<div class="footer text-center bg-dark text-white py-2">
                <p>&copy; 2023 CIFP Pau Casesnoves · Centro de Formación Profesional</p>
              </div>';

        // Imprimeix els scripts de Bootstrap des del seu repositori remot i el script personalitzat per activar el carrusel
        echo '<!-- Scripts de Bootstrap des del seu repositori remot i script personalitzat per activar el carrusel -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener(\'DOMContentLoaded\', function () {
        // Inicialitzar el carrusel utilitzant Bootstrap
        var myCarousel = new bootstrap.Carousel(document.getElementById(\'carrusel\'), {
            interval: 2000, // Canviar la velocitat del carrusel (en milisegons)
            wrap: true // Repetir el carrusel quan arribi al final
        });
    });
</script>';
        
        // Tanca la etiqueta </body> i </html>
        echo '</body></html>';
    }
}

// Crea una instància de la classe Footer i crida el mètode mostrarFooter
$footer = new Footer();
$footer->mostrarFooter();

?>
