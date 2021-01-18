<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Clinic $clinic
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <p class="clinic-link">List Appointment Status</p>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="clinics form content">
            <?= $this->Form->create($clinic) ?>
            <fieldset>
                <legend><?= __('Add Clinic') ?></legend>
                <?php
                    echo $this->Form->control('clinic_name');
                    echo $this->Form->control('address');
                    echo $this->Form->control('details');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        addForm('/clinics/add','/clinics');
        dataActions('.clinic-link','/clinics',false);
    });
</script>