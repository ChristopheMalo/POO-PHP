<?php
class PersonnagesTableManager {
    /*
     * Attributs
     */
    private $_bdd;
    
    
    /*
     * Méthode de construction
     */
    public function __construct($bdd) {
        $this->setDb($bdd);
    }
    
    
    /*
     * Methodes CRUD
     */
     
    /*  Methode d'insertion d'un personnage dans la BDD
     *  Pour éviter le message d'erreur Strict Standards: Only variables should be passed by reference
     *  il faut utiliser bindValue et non bind Param
     */
    public function addPersonnage(PersonnageTable $perso) {
        $req = $this->_bdd->prepare('INSERT INTO PersonnagesTable
                                             SET nom        = :nom,
                                                 forcePerso = :forcePerso,
                                                 degats     = :degats,
                                                 niveau     = :niveau,
                                                 experience = :experience
                                    ');
        
        $req->bindValue(':nom',         $perso->getNom(),           PDO::PARAM_STR);
        $req->bindValue(':forcePerso',  $perso->getForcePerso(),    PDO::PARAM_INT);
        $req->bindValue(':degats',      $perso->getDegats(),        PDO::PARAM_INT);
        $req->bindValue(':niveau',      $perso->getNiveau(),        PDO::PARAM_INT);
        $req->bindValue(':experience',  $perso->getExperience(),    PDO::PARAM_INT);
        
        $req->execute();
        
        $req->closeCursor();
    }
    
    // Methode de suppression d'un personnage dans la BDD
    public function deletePersonnage(PersonnageTable $perso) {
        $this->_bdd->exec('DELETE FROM PersonnagesTable WHERE id = ' . $perso->getId());
    }
    
    //Methode de selection d'un personnage avec clause WHERE
    public function getPersonnage($id) {
        $id = (int) $id;
        
        $req = $this->_bdd->query('SELECT id, nom, forcePerso, degats, niveau, experience 
                                    FROM PersonnagesTable
                                   WHERE id = '. $id);
        $datas = $req->fetch(PDO::FETCH_ASSOC);
        //var_dump($datas);
        return new PersonnageTable($datas);
        
        $req->closeCursor();
    }   
    
    // Methode de selection de toute la liste des personnages
    public function getListPersonnages() {
        $persos = [];
        
        $req = $this->_bdd->query('SELECT id, nom, forcePerso, degats, niveau, experience 
                                    FROM PersonnagesTable
                                   ORDER BY nom');
        
        while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {
            $persos[] = new PersonnageTable($datas);
        }
        //var_dump($persos);
        return $persos;
        
        $req->closeCursor();
    }
    
    // Methode de mise à jour d'un personnage dans la BDD
    public function updatePersonnage(PersonnageTable $perso) {
        $req = $this->_bdd->prepare('UPDATE PersonnagesTable
                                        SET forcePerso = :forcePerso,
                                            degats     = :degats,
                                            niveau     = :niveau,
                                            experience = :experience
                                      WHERE id         = :id
                                    ');
        
        $req->bindValue(':forcePerso',  $perso->getForcePerso(),    PDO::PARAM_INT);
        $req->bindValue(':degats',      $perso->getDegats(),        PDO::PARAM_INT);
        $req->bindValue(':niveau',      $perso->getNiveau(),        PDO::PARAM_INT);
        $req->bindValue(':experience',  $perso->getExperience(),    PDO::PARAM_INT);
        $req->bindValue(':id',          $perso->getId(),            PDO::PARAM_INT);
        
        $req->execute();
        
        $req->closeCursor();
    }
    
    
    /*
     * Méthodes Mutateurs (Setters) - Pour modifier la valeur des attributs
     */
    public function setDb(PDO $bdd) {
        $this->_bdd = $bdd;
    }
}