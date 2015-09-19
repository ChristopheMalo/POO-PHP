<?php
class MyClass {
    private $_onePrivateAttribut;

    public function __construct() {
        echo 'Construction de myClass<br>';
    }
    
    public function __set($nom, $valeur) {
        echo 'Tentative d\'assignation à l\'attribut <strong>' . $nom . '</strong> de la valeur <strong>' . $valeur . '</strong> - tentative impossible !<br>';
    }
    
    public function __get($name) {
        return 'Impossible d\'accéder à l\'attribut <strong>' . $name . '</strong><br>';
    }
    
    public function __destruct() {
        echo 'Destruction de myClass<br>';
    }
}

$obj = new MyClass;

$obj->attribut = 'Simple test';
$obj->onePrivateAttribut = '2ème simple test';

echo $obj->attribut;
echo $obj->onePrivateAttribut;




class MyClass2
{
  private $attributs = [];
  private $onePrivateAttribut;
  
  public function __get($nom)
  {
    if (isset($this->attributs[$nom]))
    {
      return $this->attributs[$nom];
    }
  }
  
  public function __set($nom, $valeur)
  {
    $this->attributs[$nom] = $valeur;
  }
  
  public function showAttributs()
  {
    echo '<pre>', print_r($this->attributs, true), '</pre>';
  }
  
  public function __isset($nom)
  {
    return isset($this->attributs[$nom]);
  }
  
  public function __destruct() {
        echo 'Destruction de myClass2<br>';
    }
}

$obj2 = new MyClass2;
$obj3 = new MyClass2;

$obj2->attribut = 'Simple test<br>';
$obj3->onePrivateAttribut = 'Autre simple test<br>';

echo $obj2->attribut;
echo $obj3->oneProvateAttribut;

if (isset($obj2->attribut))
{
  echo 'L\'attribut <strong>attribut</strong> existe !<br>';
}
else
{
  echo 'L\'attribut <strong>attribut</strong> n\'existe pas !<br>';
}

if (isset($obj3->onePrivateAttribut))
{
  echo 'L\'attribut <strong>onePrivateAttribut</strong> existe !<br>';
}
else
{
  echo 'L\'attribut <strong>onePrivateAttribut</strong> n\'existe pas !<br>';
}