<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * HasRoles Controller
 *
 * @property \App\Model\Table\HasRolesTable $HasRoles
 * @method \App\Model\Entity\HasRole[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HasRolesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Employees', 'Roles'],
        ];
        $hasRoles = $this->paginate($this->HasRoles);

        $this->set(compact('hasRoles'));
    }

    /**
     * View method
     *
     * @param string|null $id Has Role id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $hasRole = $this->HasRoles->get($id, [
            'contain' => ['Employees', 'Roles'],
        ]);

        $this->set(compact('hasRole'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $hasRole = $this->HasRoles->newEmptyEntity();
        if ($this->request->is('post')) {
            $hasRole = $this->HasRoles->patchEntity($hasRole, $this->request->getData());
            if ($this->HasRoles->save($hasRole)) {
                return $this->redirect(['action' => 'index']);
            }
        }
        $employees = $this->HasRoles->Employees->find('list', 
                ['limit' => 200,
                 'valueField' => 'full_details'
                 ]);
        $roles = $this->HasRoles->Roles->find('list', ['limit' => 200]);
        $this->set(compact('hasRole', 'employees', 'roles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Has Role id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $hasRole = $this->HasRoles->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $hasRole = $this->HasRoles->patchEntity($hasRole, $this->request->getData());
            if ($this->HasRoles->save($hasRole)) {
                return $this->redirect(['action' => 'index']);
            }
        }
        $employees = $this->HasRoles->Employees->find('list', 
                ['limit' => 200,
                 'valueField' => 'full_details'
                 ]);
        $roles = $this->HasRoles->Roles->find('list', ['limit' => 200]);
        $this->set(compact('hasRole', 'employees', 'roles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Has Role id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $hasRole = $this->HasRoles->get($id);
        $this->HasRoles->delete($hasRole);
        return $this->redirect(['action' => 'index']);
    }
    
    public function dashboardData()
    {
        if ($this->request->is(['ajax'])) {
        
        $this->paginate = [
            'contain' => ['Employees', 'Roles'],
        ];
        
        $hasRoles = $this->paginate($this->HasRoles,[
            'contain' => ['Employees', 'Roles'],
        ]);
        
        $this->set(compact('hasRoles'));
        }else {
            return $this->redirect(['action' => 'index']);
        } 
    }
    
    
}
