<?php
class PersonnagesTableManager {
    /*
     * Attributs
     */
    private $_db;
    
    
    /*
     * Méthode de construction
     */
    public function __construct($db) {
        $this->setDb($db);
    }
    
    
    /*
     * Methodes CRUD
     */
    // Methode d'insertion d'un personnage dans la BDD
    public function addPersonnage(PersonnageTable $perdso) {
        
    }
    
    // Methode de suppression d'un personnage dans la BDD
    public function deletePersonnage(PersonnageTable $perso) {
        
    }
    
    //Methode de selection d'un personnage avec clause WHERE
    public function getPersonnage($id) {
        
    }   
    
    // Methode de selection de toute la liste des personnages
    public function getListPersonnages() {
        
    }
    
    // Methode de mise à jour d'un personnage dans la BDD
    public function updatePersonnage(Personnage $perso) {
        
    }
    
    /*
     * Méthodes Mutateurs (Setters) - Pour modifier la valeur des attributs
     */
    public function setDb(PDO $db) {
        $this->_db = $db;
    }
}