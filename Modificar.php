<?php

// Inclou els fitxers de connexió i capçalera
require_once('Connexio.php');
require_once('Header.php');

/**
 * Classe per modificar la informació d'un producte.
 *
 * Aquesta classe gestiona la visualització i el processament del formulari
 * per modificar un producte existent a la base de dades.
 */
class Modificar {

    /**
     * Mètode per mostrar el formulari de modificació d'un producte.
     *
     * Aquest mètode genera el formulari HTML per modificar un producte existent. 
     * Primer verifica que l'ID del producte sigui vàlid, obté la informació del producte
     * des de la base de dades, i mostra el formulari amb les dades actuals del producte.
     * Si l'ID no és vàlid o el producte no es troba, s'informa de l'error.
     *
     * @param int $id L'ID del producte a modificar.
     * @return void
     */
    public function mostrarFormulari($id) {
        // Verifica si l'ID del producte és vàlid
        if (!isset($id) || !is_numeric($id)) {
            echo '<p>ID de producte no vàlid.</p>';
            return;
        }

        // Obtén la connexió a la base de dades
        $conexionObj = new Connexio();
        $conexion = $conexionObj->obtenirConnexio();

        // Consulta per obtenir la informació del producte
        $consulta = "SELECT id, nom, descripció, preu, categoria_id
                     FROM productes
                     WHERE id = " . $id;
        $resultado = $conexion->query($consulta);

        // Verifica si es troba el producte
        if ($resultado && $resultado->num_rows > 0) {
            $producto = $resultado->fetch_assoc();

            // Imprimeix l'estructura HTML del formulari de modificació
            echo '<!DOCTYPE html>
                  <html lang="es">
                  <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                    <title>Modificar producte</title>
                    <!-- Enllaç a Bootstrap des del seu repositori remot -->
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
                  </head>
                  <body>
                    <div class="container mt-5" style="margin-bottom: 200px">
                        <h2>Modificar producte</h2>
                        <hr>
                        <form action="Actualitzar.php" method="POST">
                            <!-- Camps del formulari amb la informació actual del producte -->
                            <input type="hidden" name="id" value="' . $producto['id'] . '">

                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom:</label>
                                <input type="text" name="nom" class="form-control" value="' . $producto['nom'] . '" required>
                            </div>

                            <div class="mb-3">
                                <label for="descripcio" class="form-label">Descripció:</label>
                                <input type="text" name="descripcio" class="form-control" value="' . $producto['descripció'] . '" required>
                            </div>

                            <div class="mb-3">
                                <label for="preu" class="form-label">Preu:</label>
                                <input type="number" name="preu" class="form-control" value="' . $producto['preu'] . '" required>
                            </div>

                            <div class="mb-3">
                                <label for="categoria" class="form-label">Categoria:</label>
                                <select name="categoria" class="form-select" required>
                                    <option value="1" ' . ($producto['categoria_id'] == 1 ? 'selected' : '') . '>Electrònics</option>
                                    <option value="2" ' . ($producto['categoria_id'] == 2 ? 'selected' : '') . '>Roba</option>
                                    <!-- Afegir més opcions segons sigui necessari -->
                                </select>
                            </div>

                            <!-- Afegir més camps segons sigui necessari -->

                            <hr>
                            <!-- Botons de guardar i cancel·lar -->
                            <input type="submit" value="Guardar" class="btn btn-primary">
                            <a href="Principal.php" class="btn btn-secondary">Cancel·lar</a>
                        </form>
                    </div>';
            
            // Inclou el peu de pàgina
            require_once('Footer.php');
        } else {
            echo '<p>No es va trobar el producte.</p>';
        }

        // Tanca la connexió a la base de dades
        $conexion->close();
    }
}

// Obtén l'ID del producte des de la variable GET
$idProducto = isset($_GET['id']) ? $_GET['id'] : null;

// Crea una instància de la classe Modificar i crida al mètode mostrarFormulari
$modificarProducto = new Modificar();
$modificarProducto->mostrarFormulari($idProducto);

?>
