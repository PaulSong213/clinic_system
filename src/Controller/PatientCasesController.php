<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * PatientCases Controller
 *
 * @property \App\Model\Table\PatientCasesTable $PatientCases
 * @method \App\Model\Entity\PatientCase[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PatientCasesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Patients'],
        ];
        $patientCases = $this->paginate($this->PatientCases);

        $this->set(compact('patientCases'));
    }

    /**
     * View method
     *
     * @param string|null $id Patient Case id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $patientCase = $this->PatientCases->get($id, [
            'contain' => ['Patients', 'Appointments', 'Documents'],
        ]);

        $this->set(compact('patientCase'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $patientCase = $this->PatientCases->newEmptyEntity();
        if ($this->request->is('post')) {
            $patientCase = $this->PatientCases->patchEntity($patientCase, $this->request->getData());
            if ($this->PatientCases->save($patientCase)) {
                return $this->redirect(['action' => 'index']);
            }
        }
        $patients = $this->PatientCases->Patients->find('list',
                ['limit' => 200,
                 'keyField' => 'id',
                 'valueField' => 'full_name']);
        $this->set(compact('patientCase', 'patients'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Patient Case id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $patientCase = $this->PatientCases->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $patientCase = $this->PatientCases->patchEntity($patientCase, $this->request->getData());
            if ($this->PatientCases->save($patientCase)) {
                return $this->redirect(['action' => 'index']);
            }
        }
        $patients = $this->PatientCases->Patients->find('list', 
                ['limit' => 200,
                 'keyField' => 'id',
                 'valueField' => 'full_name'   
                ]);
        $this->set(compact('patientCase', 'patients'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Patient Case id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $patientCase = $this->PatientCases->get($id);

        $this->PatientCases->delete($patientCase);
        return $this->redirect(['action' => 'index']);
    }
    
    public function income(){
        
        //if ($this->request->is(['ajax'])) {
        
        $this->paginate = [
            'maxLimit' => 10000,
        ];
        $patientCases = $this->paginate($this->PatientCases);
        $this->set(compact('patientCases'));
//        }else {
//            return $this->redirect(['action' => 'index']);
//        } 
    }
}
