<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * AppointmentStatus Controller
 *
 * @property \App\Model\Table\AppointmentStatusTable $AppointmentStatus
 * @method \App\Model\Entity\AppointmentStatus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AppointmentStatusController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $appointmentStatus = $this->paginate($this->AppointmentStatus);
        $this->set(compact('appointmentStatus'));
    }

    /**
     * View method
     *
     * @param string|null $id Appointment Status id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $appointmentStatus = $this->AppointmentStatus->get($id, [
            'contain' => ['Appointments', 'StatusHistories'],
        ]);

        $this->set(compact('appointmentStatus'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $appointmentStatus = $this->AppointmentStatus->newEmptyEntity();
        if ($this->request->is('post')) {
            $appointmentStatus = $this->AppointmentStatus->patchEntity($appointmentStatus, $this->request->getData());
            if ($this->AppointmentStatus->save($appointmentStatus)) {
                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('appointmentStatus'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Appointment Status id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $appointmentStatus = $this->AppointmentStatus->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $appointmentStatus = $this->AppointmentStatus->patchEntity($appointmentStatus, $this->request->getData());
            if ($this->AppointmentStatus->save($appointmentStatus)) {
                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('appointmentStatus'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Appointment Status id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $appointmentStatus = $this->AppointmentStatus->get($id);
        $this->AppointmentStatus->delete($appointmentStatus);
        return $this->redirect(['action' => 'index']);
    }
    
    public function statusDashboard(){
        
        if ($this->request->is(['ajax'])) {
        
        $appointmentStatus = $this->paginate($this->AppointmentStatus,[
            'contain' => ['Appointments'],
        ]);
        $this->set(compact('appointmentStatus'));
        }else {
            return $this->redirect(['action' => 'index']);
        } 
    }
    
}
