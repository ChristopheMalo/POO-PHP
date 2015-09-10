<?php
class Personnage {
    private $_force         = 20;           // La force du personnage
    private $_localisation;                 // Sa localisation
    private $_experience    = 0;            // Son expérience
    private $_degats        = 0;            // Ses dégâts
    
    public function parler() {              // Simple méthode test affichage texte
        echo 'Je suis un personnage virtuel RD2D !<br>';
    }
    
    public function deplacer() {            // Méthode de gestion du déplacement du personnage
         
    }
    
    public function frapper($persoAFrapper) {             // Méthode de gestion de la frappe selon la force
        $persoAFrapper->_degats += $this->_force;
    }
    
    public function gagnerExperience() {    // Methode de gestion de l'expérience du personnafe
        $this->_experience = $this->_experience + 1;
    }
    
    public function afficherExperience() {
        echo $this->_experience;
    }
}