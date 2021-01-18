<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DocumentTypes Model
 *
 * @property \App\Model\Table\DocumentsTable&\Cake\ORM\Association\HasMany $Documents
 *
 * @method \App\Model\Entity\DocumentType newEmptyEntity()
 * @method \App\Model\Entity\DocumentType newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\DocumentType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DocumentType get($primaryKey, $options = [])
 * @method \App\Model\Entity\DocumentType findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\DocumentType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DocumentType[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\DocumentType|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DocumentType saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DocumentType[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DocumentType[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\DocumentType[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DocumentType[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class DocumentTypesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('document_types');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Documents', [
            'foreignKey' => 'document_type_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('type_name')
            ->maxLength('type_name', 64)
            ->requirePresence('type_name', 'create')
            ->notEmptyString('type_name');

        return $validator;
    }
}
