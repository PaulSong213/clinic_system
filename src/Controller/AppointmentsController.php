<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Appointments Controller
 *
 * @property \App\Model\Table\AppointmentsTable $Appointments
 * @method \App\Model\Entity\Appointment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AppointmentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['PatientCases', 'InDepartments', 'AppointmentStatus'],
//            'order' => ['appointment_start_time' => 'DESC','time_created' => 'DESC'],
            'maxLimit' => 999999,
            'limit' => 999999
        ];
        $appointments = $this->paginate($this->Appointments);

        $this->set(compact('appointments'));
    }

    /**
     * View method
     *
     * @param string|null $id Appointment id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $appointment = $this->Appointments->get($id, [
            'contain' => ['PatientCases', 'InDepartments', 'AppointmentStatus', 'Documents', 'StatusHistories'],
        ]);

        $this->set(compact('appointment'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $appointment = $this->Appointments->newEmptyEntity();
        if ($this->request->is('post')) {
            $appointment = $this->Appointments->patchEntity($appointment, $this->request->getData());
            if ($this->Appointments->save($appointment)) {
                return $this->redirect(['action' => 'index']);
            }
        }
        $patientCases = $this->Appointments->PatientCases->find('list', 
                ['limit' => 200,
                  'keyField' => 'id',
                  'groupField' => 'id',  
                  'valueField' => 'full_details'])->contain(['Patients']);
        $inDepartments = $this->Appointments->InDepartments->find('list', 
                ['limit' => 200,
                 'keyField' => 'id',
                 'valueField' => 'title',
                 'groupField' => 'department.department_name'])->contain(['Employees','Departments']);
        $appointmentStatus = $this->Appointments->AppointmentStatus->find('list', ['limit' => 200]);
        $this->set(compact('appointment', 'patientCases', 'inDepartments', 'appointmentStatus'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Appointment id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $appointment = $this->Appointments->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $appointment = $this->Appointments->patchEntity($appointment, $this->request->getData());
            if ($this->Appointments->save($appointment)) {
                return $this->redirect(['action' => 'index']);
            }
        }
        $patientCases = $this->Appointments->PatientCases->find('list', 
                ['limit' => 200,
                  'keyField' => 'id',
                  'groupField' => 'id',  
                  'valueField' => 'patient.full_name'])->contain(['Patients']);
        $inDepartments = $this->Appointments->InDepartments->find('list', 
                ['limit' => 200,
                 'keyField' => 'id',
                 'valueField' => 'title',
                 'groupField' => 'department.department_name'])->contain(['Employees','Departments']);
        $appointmentStatus = $this->Appointments->AppointmentStatus->find('list', ['limit' => 200]);
        $this->set(compact('appointment', 'patientCases', 'inDepartments', 'appointmentStatus'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Appointment id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $appointment = $this->Appointments->get($id);
        if($this->Appointments->delete($appointment)){
            return $this->redirect(['action' => 'index']);
        }
    }
    
    public function departmentApointment($filter = null)
    {
        $this->paginate = [
            'contain' => ['PatientCases', 'InDepartments', 'AppointmentStatus'],
            'conditions' =>['Appointments.in_department_id' => 6],
            'order' => ['appointment_start_time' => 'DESC','time_created' => 'DESC'],
            'maxLimit' => 2000,
            'limit' => 2000
        ];
        $appointments = $this->paginate($this->Appointments,[
            'maxLimit' => 2000,
            'limit' => 2000
        ]);
        $appointmentStatus = $this->Appointments->AppointmentStatus->find('list',
                ['limit' => 200,
                 'maxLimit' => 2000,
                 'valueField' => 'full_details']);
        $this->set(compact('appointments','appointmentStatus','filter'));
    }
    
    public function changeStatus($id = null)
    {   
       $appointment = $this->Appointments->get($id, [
           'contain' => [],
       ]);
       if ($this->request->is(['patch', 'post', 'put'])) {
           $appointment = $this->Appointments->patchEntity($appointment, 
                   $this->request->getData());
           if ($this->Appointments->save($appointment)) {
               echo 'success';
           }else {
                 echo 'error';
           }

       }else{
           return $this->redirect(['action' => 'departmentApointment']);
       }
       
    }        
    
    public function dashboardAppointmentCount(){
        
        if ($this->request->is(['ajax'])) {
             
        $appointments = $this->paginate($this->Appointments,[
            'maxLimit' => 2000,
            'limit' => 2000,
            'conditions' =>['Appointments.in_department_id' => 7], 
        ]);
          
        $this->set(compact('appointments'));
        
        }else {
            return $this->redirect(['action' => 'index']);
        } 
    }
}
