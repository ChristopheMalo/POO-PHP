<?php
class Personnage {
    /*
     * Attributs
     */
    private $_force;           // La force du personnage
    private $_localisation;    // Sa localisation
    private $_experience;      // Son expérience
    private $_degats;          // Ses dégâts
    
    /*
     * Attributs / Variables statiques
     */
    private static $_leTexteStatique = '<strong>Attribut statique :</strong> Je suis ton père petit Padawan !!!<br>';

    /*
     * Déclaration des constantes de Force
     */
    const FORCE_PETITE  = 20;
    const FORCE_MOYENNE = 50;
    const FORCE_GRANDE  = 80;
    
    /*
     * Méthode de construction
     */
    public function __construct($forceInitiale, $degats) {
        //echo 'Voici le constructeur !';       // Message de test
        $this->setForce($forceInitiale);        // Initialisation de la force
        $this->setDegats($degats);              // Initialisation des dégats
        $this->_experience = 1;                 // Intialisation de l'expérience à 1
    }


    /*
     * Methodes
     */
    // Simple méthode test affichage texte
    //public function parler() {
    //    echo 'Je suis le personnage 1, personnage virtuel RD2D.<br> La force est avec moi !<br>';
    //}
    
    // Méthode de gestion du déplacement du personnage
    public function deplacer() {
         
    }
    
    // Méthode de gestion de la frappe selon la force du personnage
    public function frapper(Personnage $persoAFrapper) {
        $persoAFrapper->_degats += $this->_force;
    }
    
    // Methode de gestion de l'expérience du personnage
    public function gagnerExperience() {
        $this->_experience ++;  // Incrémente l'expérience
    }
    
    
    /*
     * Méthodes Accesseurs (Getters) - Pour récupérer la valeur d'un attribut
     */
    // Methode force() qui renvoie le contenu de l'attributs $_force
    public function force() {
        return $this->_force; 
    }
    
    // Methode experience() qui renvoie le contenu de l'attribut $_ecperience
    public function experience() {
        return $this->_experience;
    }
    
    // Methode degats() qui renvoie le contenu de l'attribut $_degats
    public function degats() {
        return $this->_degats;
    }
    
    
    /*
     * Méthodes Mutateurs - Pour modifier la valeur des attributs
     */
    // Mutateur qui modifie l'attribut $_force
    public  function setForce($force) {
//        if (!is_int($force)) { // S'il ne s'agit pas d'un nombre entier.
//            trigger_error('La force d\'un personnage doit être un nombre entier', E_USER_WARNING);
//            return;
//        }
//
//        if ($force > 100) { // On vérifie bien qu'on ne souhaite pas assigner une valeur supérieure à 100.
//            trigger_error('La force d\'un personnage ne peut dépasser 100', E_USER_WARNING);
//            return;
//        }
//        
//        $this->_force = $force;
        
        if (in_array($force, [self::FORCE_PETITE, self::FORCE_MOYENNE, self::FORCE_GRANDE])) {
            $this->_force = $force;
        }
    }
    
    // Mutateur chargé de modifier l'attribut $_experience.
    public function setExperience($experience) {
        if (!is_int($experience)) { // S'il ne s'agit pas d'un nombre entier.
            trigger_error('L\'expérience d\'un personnage doit être un nombre entier', E_USER_WARNING);
            return;
        }

        if ($experience > 100) { // On vérifie bien qu'on ne souhaite pas assigner une valeur supérieure à 100.
            trigger_error('L\'expérience d\'un personnage ne peut dépasser 100', E_USER_WARNING);
            return;
        }

        $this->_experience = $experience;
    }
    
    public function setDegats($degats) {
        if (!is_int($degats)) { // S'il ne s'agit pas d'un nombre entier.
            trigger_error('Le niveau de dégâts d\'un personnage doit être un nombre entier', E_USER_WARNING);
            return;
        }

        $this->_degats = $degats;
    }
    
    
    /*
     * Méthodes statiques - Pour agir sur une classe et non sur un objet
     */
    public static function parler() {
        //echo '<strong>Méthode staitique :</strong> Je suis ton père !!!<br>';
        echo self::$_leTexteStatique; // Appel de l'attribut statique
    }
}