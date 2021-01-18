<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Utility\Security;
/**
 * DocumentFiles Controller
 *
 * @property \App\Model\Table\DocumentFilesTable $DocumentFiles
 * @method \App\Model\Entity\DocumentFile[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DocumentFilesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Documents'],
        ];
        $documentFiles = $this->paginate($this->DocumentFiles);

        $this->set(compact('documentFiles'));
    }

    /**
     * View method
     *
     * @param string|null $id Document File id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $documentFile = $this->DocumentFiles->get($id, [
            'contain' => ['Documents'],
        ]);

        $this->set(compact('documentFile'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $documentFile = $this->DocumentFiles->newEmptyEntity();
        if ($this->request->is('post')) {
            $document = $this->request->getData('documentSubmitted');
            $name = $document->getClientFilename();
            $type = $document->getClientMediaType();
            $size = $document->getSize();
            $tmpName = $document->getStream()->getMetadata('uri');
            $error = $document->getError();
            $extension = substr(strrchr($name, '.'), 1);
            $documentFile = $this->DocumentFiles->patchEntity($documentFile, $this->request->getData());
            $path = Security::hash($name);
            $documentFile->name = $name;
            $documentFile->pathName = $path;
            
            if ($this->DocumentFiles->save($documentFile)) {
                $newUniquePath = $path.$documentFile->id.'.'.$extension;
                $documentFileNew = $this->DocumentFiles->get($documentFile->id, [
                    'contain' => [],
                ]);
                $documentFileNew = $this->DocumentFiles->patchEntity($documentFileNew, $this->request->getData());
                $documentFileNew->pathName = $newUniquePath;
                if ($this->DocumentFiles->save($documentFileNew)) {
                    move_uploaded_file($tmpName, WWW_ROOT."clinic-document".DS.$newUniquePath);
                    return $this->redirect(['action' => 'index']);
                }
            }
        }
        $documents = $this->DocumentFiles->Documents->find('list', ['limit' => 200]);
        $this->set(compact('documentFile', 'documents'));
    }

    
    
    
    /**
     * Edit method
     *
     * @param string|null $id Document File id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $documentFile = $this->DocumentFiles->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $documentFile = $this->DocumentFiles->patchEntity($documentFile, $this->request->getData());
            if ($this->DocumentFiles->save($documentFile)) {
                return $this->redirect(['action' => 'index']);
            }
        }
        $documents = $this->DocumentFiles->Documents->find('list', ['limit' => 200]);
        $this->set(compact('documentFile', 'documents'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Document File id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $documentFile = $this->DocumentFiles->get($id);
        
        $path = $documentFile->pathName;
        
        if ($this->DocumentFiles->delete($documentFile)) {
           unlink(WWW_ROOT.$path);
        } 

        return $this->redirect(['action' => 'index']);
    }
}
