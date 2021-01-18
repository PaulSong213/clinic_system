<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * DocumentTypes Controller
 *
 * @property \App\Model\Table\DocumentTypesTable $DocumentTypes
 * @method \App\Model\Entity\DocumentType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DocumentTypesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $documentTypes = $this->paginate($this->DocumentTypes);

        $this->set(compact('documentTypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Document Type id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $documentType = $this->DocumentTypes->get($id, [
            'contain' => ['Documents'],
        ]);

        $this->set(compact('documentType'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $documentType = $this->DocumentTypes->newEmptyEntity();
        if ($this->request->is('post')) {
            $documentType = $this->DocumentTypes->patchEntity($documentType, $this->request->getData());
            if ($this->DocumentTypes->save($documentType)) {
                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('documentType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Document Type id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $documentType = $this->DocumentTypes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $documentType = $this->DocumentTypes->patchEntity($documentType, $this->request->getData());
            if ($this->DocumentTypes->save($documentType)) {
                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('documentType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Document Type id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $documentType = $this->DocumentTypes->get($id);
        $this->DocumentTypes->delete($documentType);
        return $this->redirect(['action' => 'index']);
    }
}
