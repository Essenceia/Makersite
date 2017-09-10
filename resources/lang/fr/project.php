<?php
/**
 * Created by PhpStorm.
 * User: pookie
 * Date: 8/30/17
 * Time: 5:59 PM
 */
return[
    'type'=>"Type du projet",
  'type0'=>'PSTE',
    'type1'=>'PPE',
    'type2'=>'PFE',
    'name'=>'Nom du project',
    'number'=>"Numeros du projet",
    'code'=>"Code d'identification du projet",
    'pointsnotrequired'=>"Si le nombre de points attribuer reste a 0 il sera automatiquement mise",
    'userid'=>"Identifiant du chef de project",
    'parseprojectinfo'=>"Cette interface permet de cree en une fois tout les projets referencer dans une table exel. Avant de commender veuillez ordonner les collones de donnes dans l'ordre suivant: 
    identifiant du projet, ex : PSTE102 ou PFE101 ; 
    nom du projet ;
     description du projet ;
      email du chef de projet. Attention, si l'email du chef de projet n'est pas de la forme 'xxxx@edu.ece.fr' il sera impossible de le relier a un compte utilisteur. Pour l'utiliser allez dans votre tableau exel ou google spreadsheat et exporter le en '.tsv'. ",
    'datagoeshere'=>'Entrez les donnes ici.',
    'parse'=>'Parsee les donnes',
    'creatproject'=>"Cree project via exel",
    'leaderemail'=>"email du chef de projet",


];