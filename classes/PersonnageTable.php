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
     * Méthode de construction
     */
    public function __construct($datas = array()) {
        if (!empty($datas)) {
            $this->hydrate($datas);
        }
    }
    
    
    /*
     * Hydratation de l'objet par Méthode
     */
    public function hydrate(array $datas) {
//        if (isset($datas['id'])) {
//            $this->setId($datas['id']);
//        }
//        
//        if (isset($datas['nom'])) {
//            $this->setNom($datas['nom']);
//        }
//        
//        if (isset($datas['forcePerso'])) {
//            $this->setForcePerso($datas['forcePerso']);
//        }
//        
//        if (isset($datas['degats'])) {
//            $this->setForcePerso($datas['degats']);
//        }
//        
//        if (isset($datas['niveau'])) {
//            $this->setForcePerso($datas['niveau']);
//        }
//        
//        if (isset($datas['experience'])) {
//            $this->setForcePerso($datas['experience']);
//        }
        
        foreach ($datas as $key => $value) {
            $method = 'set'.ucfirst($key);
            
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        } 
    }
    
    /*
     * Méthodes Accesseurs (Getters) - Pour récupérer la valeur d'un attribut
     */
    public function getId() {
        return $this->_id;
    }
    
    public function getNom() {
        return $this->_nom;
    }
    
    public function getForcePerso() {
        return $this->_forcePerso;
    }
    
    public function getDegats() {
        return $this->_degats;
    }
    
    public function getNiveau() {
        return $this->_niveau;
    }
    
    public function getExperience() {
        return $this->_experience;
    }
    
    
    /*
     * Méthodes Mutateurs (Setters) - Pour modifier la valeur des attributs
     */
    public function setId($id) {
//        $id = (int) $id; // Conversion de l'argument en nombre entier
//        if ($id > 0) { // Vérification - le nombre doit être strictement positif
//            $this->_id = $id; // On assigne alors la valeur $id à l'attribut _id
//        }
        $this->_id = (int) $id; // L'id est obligatoirement un nombre entier
    }
    
    public function setNom($nom) {
        if (is_string($nom)) { // Vérification si présence d'une chaîne de caractères
            $this->_nom = $nom; // On assigne alors la valeur $nom à l'attribut _nom
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

