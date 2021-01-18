<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Genders Controller
 *
 * @property \App\Model\Table\GendersTable $Genders
 * @method \App\Model\Entity\Gender[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GendersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $genders = $this->paginate($this->Genders);

        $this->set(compact('genders'));
    }

    /**
     * View method
     *
     * @param string|null $id Gender id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $gender = $this->Genders->get($id, [
            'contain' => ['Employees', 'Patients'],
        ]);

        $this->set(compact('gender'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $gender = $this->Genders->newEmptyEntity();
        if ($this->request->is('post')) {
            $gender = $this->Genders->patchEntity($gender, $this->request->getData());
            if ($this->Genders->save($gender)) {
                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('gender'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Gender id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $gender = $this->Genders->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $gender = $this->Genders->patchEntity($gender, $this->request->getData());
            if ($this->Genders->save($gender)) {
                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('gender'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Gender id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $gender = $this->Genders->get($id);
        $this->Genders->delete($gender);
        return $this->redirect(['action' => 'index']);
    }
}
