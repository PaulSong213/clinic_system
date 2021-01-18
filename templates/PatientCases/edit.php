<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PatientCase $patientCase
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <p class="delete" id="d<?=$patientCase->id?>" >Delete Patient Case</p>
            <p class="patientCase-link">List Patient Cases</p>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="patientCases form content">
            <?= $this->Form->create($patientCase,[
                'id' => '/patient-cases/edit/'.$patientCase->id,
                'class' => 'editForm'
            ]) ?>
            <fieldset>
                <legend><?= __('Edit Patient Case') ?></legend>
                <?php
                    echo $this->Form->control('patient_id', [
                        'options' => $patients,
                        'id' => 'patientID'
                        ]);
                    echo $this->Form->control('full_name',[
                        'type' => 'hidden',
                        'id' => 'patientName'
                    ]);
                    echo $this->Form->control('start_time');
                    echo $this->Form->control('end_time');
                    echo $this->Form->control('in_progress');
                    echo $this->Form->control('total_cost',[
                        'required' => 'true'
                    ]);
                    echo $this->Form->control('amount_paid',[
                        'required' => 'true'
                    ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        setDefaultFullName("#patientID",'#patientName');
        dataActions('.patientCase-link','/patient-cases',false);
        dataDeleteAction('/patient-cases/delete/', '/patient-cases',false);
        editForm('.editForm','/patient-cases');
    });
</script>