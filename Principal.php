<?php

// Inclou els fitxers de connexió i capçalera
require_once('Connexio.php');
require_once('Header.php');

/**
 * Classe per mostrar la llista de productes.
 *
 * Aquesta classe s'encarrega de gestionar la visualització de la llista de productes
 * des de la base de dades, mostrant informació detallada sobre cada producte i
 * permetent realitzar accions com modificar o eliminar un producte.
 */
class Principal {
    
    /**
     * Mètode per mostrar la llista de productes.
     *
     * Aquest mètode recupera la llista de productes des de la base de dades,
     * juntament amb la informació de la seva categoria, i mostra aquesta informació
     * en una taula HTML. També inclou enllaços per modificar i eliminar productes,
     * així com un botó per afegir un nou producte.
     *
     * @return void
     */
    public function mostrarProductes() {
        // Obtén la connexió a la base de dades
        $conexionObj = new Connexio();
        $conexion = $conexionObj->obtenirConnexio();

        // Consulta per obtenir la llista de productes amb informació de categories
        $consulta = "SELECT p.id, p.nom, p.descripció, p.preu, c.nom as categoria
                     FROM productes p
                     INNER JOIN categories c ON p.categoria_id = c.id";
        $resultado = $conexion->query($consulta);

        // Estructura HTML de la pàgina
        echo '<!DOCTYPE html>
              <html lang="es">
              <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <title>Llista de productes</title>
                <!-- Enllaç a Bootstrap des del seu repositori remot -->
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
              </head>
              <body>
                <div class="container mt-5" style="margin-bottom: 100px">';

        // Verifica si hi ha productes a la base de dades
        if ($resultado->num_rows > 0) {
            // Botó per afegir un nou producte
            echo '<hr><a href="Nou.php" class="btn btn-primary">Nou producte</a><hr>';
            // Taula per mostrar la llista de productes
            echo '<table class="table table-striped">';
            echo '<thead>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Descripció</th>
                        <th>Preu</th>
                        <th>Categoria</th>
                        <th colspan="2">Accions</th>
                    </tr>
                  </thead>';
            echo '<tbody>';
            $i = 1;
            // Itera sobre els resultats i mostra cada producte en una fila de la taula
            while ($fila = $resultado->fetch_assoc()) {
                echo '<tr>
                        <td>' . $i . '</td>
                        <td>' . 'prod-' . $fila['id'] . '</td>
                        <td>' . $fila['nom'] . '</td>
                        <td>' . $fila['descripció'] . '</td>
                        <td>' . $fila['preu'] . '</td>
                        <td>' . $fila['categoria'] . '</td>
                        <td><a href="Modificar.php?id=' . $fila['id'] . '" class="btn btn-warning">Modificar</a></td>
                        <td><a href="Eliminar.php?id=' . $fila['id'] . '" class="btn btn-danger">Eliminar</a></td>
                      </tr>';
                $i++;
            }
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
            // Inclou el peu de pàgina
            require_once('Footer.php');
        } else {
            // Missatge si no hi ha productes
            echo '<p>No hi ha productes.</p>';
        }

        // Tanca la connexió a la base de dades
        $conexion->close();
    }
}

// Crea una instància de la classe Principal i crida al mètode mostrarProductes
$listaProductos = new Principal();
$listaProductos->mostrarProductes();

?>
