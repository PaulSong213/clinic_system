<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * StatusHistories Controller
 *
 * @property \App\Model\Table\StatusHistoriesTable $StatusHistories
 * @method \App\Model\Entity\StatusHistory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StatusHistoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Appointments', 'AppointmentStatus'],
        ];
        $statusHistories = $this->paginate($this->StatusHistories);

        $this->set(compact('statusHistories'));
    }

    /**
     * View method
     *
     * @param string|null $id Status History id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $statusHistory = $this->StatusHistories->get($id, [
            'contain' => ['Appointments', 'AppointmentStatus'],
        ]);

        $this->set(compact('statusHistory'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $statusHistory = $this->StatusHistories->newEmptyEntity();
        if ($this->request->is('post')) {
            $statusHistory = $this->StatusHistories->patchEntity($statusHistory, $this->request->getData());
            if ($this->StatusHistories->save($statusHistory)) {
                return $this->redirect(['action' => 'index']);
            }
        }
        $appointments = $this->StatusHistories->Appointments->find('list', ['limit' => 200]);
        $appointmentStatus = $this->StatusHistories->AppointmentStatus->find('list', ['limit' => 200]);
        $this->set(compact('statusHistory', 'appointments', 'appointmentStatus'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Status History id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $statusHistory = $this->StatusHistories->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $statusHistory = $this->StatusHistories->patchEntity($statusHistory, $this->request->getData());
            if ($this->StatusHistories->save($statusHistory)) {
                return $this->redirect(['action' => 'index']);
            }
        }
        $appointments = $this->StatusHistories->Appointments->find('list', ['limit' => 200]);
        $appointmentStatus = $this->StatusHistories->AppointmentStatus->find('list', ['limit' => 200]);
        $this->set(compact('statusHistory', 'appointments', 'appointmentStatus'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Status History id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $statusHistory = $this->StatusHistories->get($id);
        $this->StatusHistories->delete($statusHistory);
        return $this->redirect(['action' => 'index']);
    }
}
