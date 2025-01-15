<?php

/**
 * Classe per gestionar la connexió a la base de dades.
 *
 * Aquesta classe estableix una connexió a la base de dades `la_meva_botiga` utilitzant
 * les credencials de connexió especificades. Proporciona un mètode per obtenir
 * una instància de connexió.
 */
class Connexio {
    
    /**
     * @var string El nom del host de la base de dades (per defecte 'localhost').
     */
    private $host = "localhost";
    
    /**
     * @var string El nom d'usuari per la connexió a la base de dades.
     */
    private $usuario = "root";
    
    /**
     * @var string La contrasenya de l'usuari per la connexió a la base de dades.
     */
    private $contraseña = "";
    
    /**
     * @var string El nom de la base de dades a la qual es connecta.
     */
    private $baseDatos = "la_meva_botiga";

    /**
     * Obté la connexió a la base de dades.
     *
     * Aquest mètode estableix una connexió amb la base de dades utilitzant
     * els paràmetres configurats a la classe. Si es produeix un error de connexió,
     * el script es deté mostrant el missatge d'error.
     *
     * @return mysqli Retorna la instància de la connexió a la base de dades.
     * @throws Exception Si es produeix un error en connectar amb la base de dades.
     */
    public function obtenirConnexio() {
        $conexion = new mysqli($this->host, $this->usuario, $this->contraseña, $this->baseDatos);

        if ($conexion->connect_error) {
            die("Error de connexió: " . $conexion->connect_error);
        }

        return $conexion;
    }
}

?>
