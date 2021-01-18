<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * InDepartments Controller
 *
 * @property \App\Model\Table\InDepartmentsTable $InDepartments
 * @method \App\Model\Entity\InDepartment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InDepartmentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Employees', 'Departments'],
        ];
        $inDepartments = $this->paginate($this->InDepartments);

        $this->set(compact('inDepartments'));
    }

    /**
     * View method
     *
     * @param string|null $id In Department id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $inDepartment = $this->InDepartments->get($id, [
            'contain' => ['Employees', 'Departments', 'Appointments', 'Documents', 'Schedules'],
        ]);

        $this->set(compact('inDepartment'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $inDepartment = $this->InDepartments->newEmptyEntity();
        if ($this->request->is('post')) {
            $inDepartment = $this->InDepartments->patchEntity($inDepartment, $this->request->getData());
            if ($this->InDepartments->save($inDepartment)) {
                return $this->redirect(['action' => 'index']);
            }
        }
        $employees = $this->InDepartments->Employees->find('list', [
                    'limit' => 200,
                    'valueField' => 'full_details'
            ]);
        $departments = $this->InDepartments->Departments->find('list', ['limit' => 200]);
        $this->set(compact('inDepartment', 'employees', 'departments'));
    }

    /**
     * Edit method
     *
     * @param string|null $id In Department id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $inDepartment = $this->InDepartments->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $inDepartment = $this->InDepartments->patchEntity($inDepartment, $this->request->getData());
            if ($this->InDepartments->save($inDepartment)) {
                return $this->redirect(['action' => 'index']);
            }
        }
        $employees = $this->InDepartments->Employees->find('list', ['limit' => 200]);
        $departments = $this->InDepartments->Departments->find('list', ['limit' => 200]);
        $this->set(compact('inDepartment', 'employees', 'departments'));
    }

    /**
     * Delete method
     *
     * @param string|null $id In Department id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $inDepartment = $this->InDepartments->get($id);

        $this->InDepartments->delete($inDepartment);
        return $this->redirect(['action' => 'index']);
    }
    
    public function departmentsAppointment($id)
    {
        $this->paginate = [
            'contain' => ['Employees', 'Departments'],
        ];
        $inDepartments = $this->paginate($this->InDepartments);
        $this->set(compact('inDepartments'));
    }        
            
}
