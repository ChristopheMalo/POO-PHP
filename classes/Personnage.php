<?php
class Personnage {
    private $_force;                        // La force du personnage
    private $_localisation;                 // Sa localisation
    private $_experience;                   // Son expérience
    private $_degats;                       // Ses dégâts
    
    public function parler() {              // Simple méthode test affichage texte
        echo 'Je suis un personnage virtuel RD2D !';
    }
    
    public function deplacer() {            // Méthode de gestion du déplacement du personnage
         
    }
    
    public function frapper() {             // Méthode de gestion de la frappe selon la force
        
    }
    
    public function gagnerExperience() {    // Methode de gestion de l'expérience du personnafe
        
    }
}