<?php

// Inclou el fitxer de connexió a la base de dades
require_once('Connexio.php');

/**
 * Classe per actualitzar productes a la base de dades.
 *
 * Aquesta classe proporciona un mètode per actualitzar la informació d'un producte a la base de dades.
 * Els detalls del producte com el nom, descripció, preu i categoria poden ser modificats.
 */
class Actualitzar {
    
    /**
     * Mètode per actualitzar un producte a la base de dades.
     *
     * Aquest mètode actualitza la informació d'un producte a la base de dades utilitzant els paràmetres
     * proporcionats per l'usuari: nom, descripció, preu i categoria.
     *
     * @param int $id El identificador del producte a actualitzar.
     * @param string $nom El nou nom del producte.
     * @param string $descripcio La nova descripció del producte.
     * @param float $preu El nou preu del producte.
     * @param int $categoria El ID de la nova categoria del producte.
     * 
     * @return void
     */
    public function actualizar($id, $nom, $descripcio, $preu, $categoria) {
        // Verifica si tots els camps requerits estan presents
        if (!isset($id) || !isset($nom) || !isset($descripcio) || !isset($preu) || !isset($categoria)) {
            echo '<p>Són necessaris tots els camps per actualitzar el producte.</p>';
            return;
        }

        // Crea una instància de la classe de connexió
        $conexionObj = new Connexio();
        // Obtén la connexió a la base de dades
        $conexion = $conexionObj->obtenirConnexio();

        // Escapa les variables per prevenir injeccions SQL
        $id = $conexion->real_escape_string($id);
        $nom = $conexion->real_escape_string($nom);
        $descripcio = $conexion->real_escape_string($descripcio);
        $preu = $conexion->real_escape_string($preu);
        $categoria = $conexion->real_escape_string($categoria);

        // Construeix la consulta SQL d'actualització
        $consulta = "UPDATE productes
                     SET nom = '$nom', descripció = '$descripcio', preu = '$preu', categoria_id = '$categoria'
                     WHERE id = '$id'";

        // Executa la consulta i redirigeix a la pàgina principal si té èxit
        if ($conexion->query($consulta) === TRUE) {
            header('Location: Principal.php');
            exit();
        } else {
            // Mostra un missatge d'error si la consulta falla
            echo '<p>Error en actualitzar el producte: ' . $conexion->error . '</p>';
        }

        // Tanca la connexió a la base de dades
        $conexion->close();
    }
}

// Obtén els valors del formulari (si existeixen)
$id = isset($_POST['id']) ? $_POST['id'] : null;
$nom = isset($_POST['nom']) ? $_POST['nom'] : null;
$descripcio = isset($_POST['descripcio']) ? $_POST['descripcio'] : null;
$preu = isset($_POST['preu']) ? $_POST['preu'] : null;
$categoria = isset($_POST['categoria']) ? $_POST['categoria'] : null;

/**
 * Crea una instància de la classe Actualitzar i crida al mètode actualitzar.
 * Aquest bloc de codi obté les dades enviades pel formulari 
 * i crida al mètode per actualitzar el producte a la base de dades.
 *
 * @return void
 */
$actualizarProducto = new Actualitzar();
$actualizarProducto->actualizar($id, $nom, $descripcio, $preu, $categoria);

?> 
