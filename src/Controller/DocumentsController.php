<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\ORM\TableRegistry;
use ZipArchive;
/**
 * Documents Controller
 *
 * @property \App\Model\Table\DocumentsTable $Documents
 * @method \App\Model\Entity\Document[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DocumentsController extends AppController 
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['DocumentTypes', 'Patients', 'PatientCases',
                'Appointments', 'InDepartments','DocumentFiles'],
            'limit' => 5000,
            'maxLimit' => 5000
        ];
        $documents = $this->paginate($this->Documents);

        $this->set(compact('documents'));
    }

    /**
     * View method
     *
     * @param string|null $id Document id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $document = $this->Documents->get($id, [
            'contain' => ['DocumentTypes', 'Patients', 'PatientCases',
                'Appointments', 'InDepartments','DocumentFiles'],
        ]);

        $this->set(compact('document'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $document = $this->Documents->newEmptyEntity();
        if ($this->request->is('post')) {
           
            $document = $this->Documents->patchEntity($document, $this->request->getData());
            $fileDocumentId = $this->request->getData('document_files');
            $fileDocumentToDelete = $this->request->getData('document_files_deletion');
            $fileIds = array_filter(explode(",", $fileDocumentId));
            $fileDelete = array_filter(explode(",", $fileDocumentToDelete));
            if ($this->Documents->save($document)) {
                $currentId = $document->id;
                $docFiles = TableRegistry::getTableLocator()->get('DocumentFiles');
                for($i = 0; $i < sizeof($fileIds); $i++){
                    $editDocFiles = $docFiles->get($fileIds[$i], [
                        'contain' => [],
                    ]);
                    $editDocFiles->document_id = $currentId;
                    $editDocFiles = $docFiles->patchEntity($editDocFiles,(array)$editDocFiles);
                    $docFiles->save($editDocFiles);
                }
                for($i = 0; $i < sizeof($fileDelete); $i++){
                    $file = $docFiles->get($fileDelete[$i]);
                    $deletePath = WWW_ROOT.'clinic-document'.DS.$file->pathName;
                    if($docFiles->delete($file)){
                        unlink($deletePath);
                    }
                }
            }
        }
        $documentTypes = $this->Documents->DocumentTypes->find('list', 
                ['limit' => 200,
                  'valueField' => 'type_name'   
                ]);
        $patients = $this->Documents->Patients->find('list', [
            'limit' => 200,
            'valueField' => 'full_name'   
            ]);
        $patientCases = $this->Documents->PatientCases->find('list', [
            'limit' => 200,
            'valueField' => 'full_details_with_id'   
            ]);
        $appointments = $this->Documents->Appointments->find('list', [
            'limit' => 200,
            'valueField' => 'patient_case_details'   
            ]);
        $inDepartments = $this->Documents->InDepartments->find('list', [
            'limit' => 200,
            'valueField' => 'title'   
            ]);
        $this->set(compact('document', 'documentTypes', 'patients', 'patientCases', 
                'appointments', 'inDepartments'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Document id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $document = $this->Documents->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $document = $this->Documents->patchEntity($document, $this->request->getData());
            if ($this->Documents->save($document)) {
                return $this->redirect(['action' => 'index']);
            }
        }
         $documentTypes = $this->Documents->DocumentTypes->find('list', 
                ['limit' => 200,
                  'valueField' => 'type_name'   
                ]);
        $patients = $this->Documents->Patients->find('list', [
            'limit' => 200,
            'valueField' => 'full_name'   
            ]);
        $patientCases = $this->Documents->PatientCases->find('list', [
            'limit' => 200,
            'valueField' => 'full_details_with_id'   
            ]);
        $appointments = $this->Documents->Appointments->find('list', [
            'limit' => 200,
            'valueField' => 'patient_case_details'   
            ]);
        $inDepartments = $this->Documents->InDepartments->find('list', [
            'limit' => 200,
            'valueField' => 'title'   
            ]);
        $this->set(compact('document', 'documentTypes', 'patients', 'patientCases', 'appointments', 'inDepartments'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Document id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $document = $this->Documents->get($id);
        $this->Documents->delete($document);
        return $this->redirect(['action' => 'index']);
    }
    
    public function downloadDocument($location){
        $filePath = WWW_ROOT.'clinic-document'.DS.$location;
        echo $location;
        $this->redirect($filePath);
    }
    
    public function downloadZip(){
        
        if ($this->request->is(['post'])) {
            
            $fileNames = [];
            $filePaths = [];
            
            $fileZipName = $this->cleanValidFileName($this->request->getData('zipName'));
            $filePathNames = $this->cleanValidFileName($this->request->getData('fileNamePath'));
             
            for($i = 0; $i < sizeof($filePathNames); $i++){
               $fileExtract = explode( "%" , $filePathNames[$i]);
               $filePaths[$i] = $fileExtract[0];
               $fileNames[$i] = $fileExtract[1];
            }
            echo $zipInfo = json_encode($this->makeZip($fileZipName,$filePaths,$fileNames));
            
        }else {
            return $this->redirect(['action' => 'index']);
        }
       
    }
    
    function makeZip($fileZipName = null,$filePaths = [], $fileNames = []){
        $zip = new ZipArchive();
        $zipName = $fileZipName.'.zip';
        $zipRootName = 'clinic-document'.DS.$zipName;
        $DelFilePath= WWW_ROOT.$zipRootName;
        if(file_exists($DelFilePath)) {
                unlink ($DelFilePath); 
        }
        
        if ($zip->open($DelFilePath, ZIPARCHIVE::CREATE) != TRUE) {
                die ("Could not open archive");
        }
        
        for($i = 0; $i < sizeof($filePaths); $i++){
            $path = strval($filePaths[$i]);
            $name = strval($fileNames[$i]);
            $relativeFilePath = WWW_ROOT.'clinic-document'.DS.$path;
            $zip->addFile($relativeFilePath,$name);
        }
        //close and save archive
        $zip->close(); 
        return [$zipRootName,$zipName];
    }
    
    function cleanValidFileName($string) {
        $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
        return preg_replace(['/[^A-Za-z0-9%.@\-]/'], '', $string); // Removes special chars.
        
    }
    
    
}
