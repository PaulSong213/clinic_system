<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Patient $patient
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <p class="delete" id="d<?=$patient->id?>" >Delete patient</p>
            <p class="patient-link">List patient</p>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="patients form content">
            <?= $this->Form->create($patient,[
                'id' => '/patients/edit/'.$patient->id,
                'class' => 'editForm'
            ]) ?>
            <fieldset>
                <legend><?= __('Edit Patient') ?></legend>
                <?php
                    echo $this->Form->control('first_name');
                    echo $this->Form->control('last_name');
                    echo $this->Form->control('gender_id', ['options' => $genders]);
                    echo $this->Form->control('email');
                    echo $this->Form->control('age');
                    echo $this->Form->control('address');
                    echo $this->Form->control('contact_number');
                    echo $this->Form->control('password');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        dataActions('.patient-link','/patients',false);
        dataDeleteAction('/patients/delete/', '/patients',false);
        editForm('.editForm','/patients');
    });
</script>