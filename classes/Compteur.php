<?php
/*
 * Cette simple classe permet de calculer le nombre de fois que la classe est instanciée
 */
class Compteur {
    /*
     * Attributs
     */
    private static $_compteur = 0; // Déclaration de la variable / attribut $_compteur
    
    
    /*
     * Méthode de construction
     */
    public function __construct() {
        self::$_compteur++; // Instanciation de la variable $_compteur qui apppartient à la classe donc utilisation de self et non $this
    }
    
    
    /*
     * Méthodes Accesseurs (Getters) - Pour récupérer la valeur d'un attribut
     */
    // Methode statique getCompteur() qui renvoie la valeur du compteur - self et pas $this car static
    public static function getCompteur() {
        return self::$_compteur;
    }
}
