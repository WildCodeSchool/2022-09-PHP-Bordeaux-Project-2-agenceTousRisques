<?php

namespace App\Controller;

use App\Model\DeleteModel;

class DeleteController extends AbstractController 
{

 /*  
public function edit($item_id){
    $theItem = $this->model('Item')->find($item_id);
    if(isset($_POST['action']))(
        $theItem->name = $_POST['firstname'];
        $theItem->name = $_POST['lastname'];
        $theItem->name = $_PST['email'];
        $theitem->update();
        $theItem->create();
        header('location:/home/index');
    }else{
        $this->view('home/edit', $theItem);
    }
*/
    public function delete(){
        $message = [];
     
        if ($_SERVER['REQUEST_METHOD'] ==='POST'){
            if (!filter_var(($_POST['email']), FILTER_VALIDATE_EMAIL)) {
                $message[]= "Email obligatoire";
                return $this->twig->render('Delete/delete.html.twig', [
                    'message' => $message
                ]);
              } elseif (empty($message) ){
                
                  $deleteModel = new DeleteModel();
                $emailfound = $deleteModel->selectOneByEmail($_POST['email']);     
                 if ($emailfound == false) {
                    $message[]= "Email non disponible";
                    return $this->twig->render('Delete/delete.html.twig', [
                        'message' => $message
                    ]);
            } elseif (($emailfound == true)){
                    $emailDelete =  $deleteModel->updateUser($_POST['email']); 
                    $message[]= "Utilisateur supprimé";
                    return $this->twig->render('Delete/delete.html.twig', [
                        'message' => $message
                    ]);
                  }
                 }
              }
              return $this->twig->render('Delete/delete.html.twig', [
                'message' => $message]);
                
        }

    }




    
    
    


    
   