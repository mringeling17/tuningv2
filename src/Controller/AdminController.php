<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Http\Exception\NotFoundException;

class AdminController extends AppController
{
     public function index()
     {

    }
    public function list()
    {
        $this->user->recursive = 1;
        $user = $this->user->find('all');
        $this->set('user',$user);
        $this->render('list');
    }

   public function view($id)
   {
       if (!$id) {
           throw new NotFoundException(__('Invalid user'));
       }

       $user = $this->Users->get($id);
       $this->set(compact('user'));
   }

   public function add()
   {
       $user = $this->Users->newEntity();
       if ($this->request->is('post')) {
           $user = $this->Users->patchEntity($user, $this->request->getData());
           if ($this->Users->save($user)) {
               $this->Flash->success(__('The user has been saved.'));
               return $this->redirect(['action' => 'add']);
           }
           $this->Flash->error(__('Unable to add the user.'));
       }
       $this->set('user', $user);
   }
   public function delete($id){
    $this->request->allowMethod(['post', 'delete']);

    $article = $this->Users->get($id);
    if ($this->Users->delete($article)) {
        $this->Flash->success(__('El Usuario con id: {0} ha sido eliminado.', h($id)));
        return $this->redirect(['action' => 'index']);
    }
}
}

