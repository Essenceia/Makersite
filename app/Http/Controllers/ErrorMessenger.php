<?php
/**
 * Created by PhpStorm.
 * User: pookie
 * Date: 7/16/17
 * Time: 3:36 PM
 */

namespace App\Http\Controllers;


class ErrorMessenger
{
    /*$error = ['id'=>0,
'title'=>'Erreur dans la reservation','body'=>'Utilisateur inconnu'];*/
  public function reservation($idcode){
   switch ($idcode){
       case 0:
           $error = ['id'=>0,
               'title'=>'Erreur dans la reservation','body'=>'Utilisateur inconnu'];
           break;
       case 0:
           $error = ['id'=>0,
               'title'=>'Erreur dans la reservation','body'=>'Utilisateur inconnu'];
           break;
       case 0:
           $error = ['id'=>0,
               'title'=>'Erreur dans la reservation','body'=>'Utilisateur inconnu'];
           break;
       case 0:
           $error = ['id'=>0,
               'title'=>'Erreur dans la reservation','body'=>'Utilisateur inconnu'];
           break;
       case 0:
           $error = ['id'=>0,
               'title'=>'Erreur dans la reservation','body'=>'Utilisateur inconnu'];
           break;
       default:
           $error = ['id'=>0,
               'title'=>'Erreur dans la reservation','body'=>'Utilisateur inconnu'];
           break;
   }
  }
}