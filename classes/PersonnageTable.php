<?php
class PersonnageTable {
    /*
     * Attributs
     */
    private $_id;
    private $_nom;
    private $_forcePerso;
    private $_degats;
    private $_niveau;
    private $_experience;
    
    
    /*
     * Méthodes Accesseurs (Getters) - Pour récupérer la valeur d'un attribut
     */
    public function id() {
        return $this->_id;
    }
    
    public function nom() {
        return $this->_nom;
    }
    
    public function forcePerso() {
        return $this->_forcePerso;
    }
    
    public function degats() {
        return $this->_degats;
    }
    
    public function niveau() {
        return $this->_niveau;
    }
    
    public function expericence() {
        return $this->_experience;
    }
    
    
    /*
     * Méthodes Mutateurs (Setters) - Pour modifier la valeur des attributs
     */
    public function setId($id) {
        $id = (int) $id; // Conversion de l'argument en nombre entier
        if ($id > 0) { // Vérification - le nombre doit être strictement positif
            $this->_id = $id; // On assigne alors la valeur $id à l'attribut _id
        }
    }
    
    public function setNom($nom) {
        if (is_string($nom)) { // Vérification si présence d'une chaîne de caractères
            $this->_nom = $nom; // On assigne alors la valeur $id à l'attribut _id
        }
    }
    
    public function setForcePerso($forcePerso) {
        $forcePerso = (int) $forcePerso;
        if ($forcePerso >= 1 && $forcePerso <= 100) {
            $this->_forcePerso = $forcePerso;
        }
    }
    
    public function setDegats($degats) {
        $degats = (int) $degats;
        if ($degats >= 0 && $degats <= 100) {
            $this->_degats = $degats;
        }
    }
    
    public function setNiveau($niveau) {
        $niveau = (int) $niveau;
        if ($niveau >= 1 && $niveau <= 100) {
            $this->_niveau = $niveau;
        }
    }
    
    public function setExperience($experience) {
        $experience = (int) $experience;
        if ($experience >= 1 && $experience <= 100) {
            $this->_experience = $experience;
        }
    }
}

