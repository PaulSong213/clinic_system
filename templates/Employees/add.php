<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav ">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <p class="employee-link">List Employees</p>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="employees form content">
            <?= $this->Form->create($employee) ?>
            <fieldset>
                <legend><?= __('Add Employee') ?></legend>
                <?php
                    echo $this->Form->control('first_name');
                    echo $this->Form->control('last_name');
                    echo $this->Form->control('password');
                    echo $this->Form->control('email');
                    echo $this->Form->control('mobile_number');
                    echo $this->Form->control('is_active');
                    echo $this->Form->control('gender_id', ['options' => $genders]);
                    echo $this->Form->control('age');
                    echo $this->Form->control('address');
                    echo $this->Form->control('contact_person');
                    echo $this->Form->control('contact_person_number');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        addForm('/employees/add','/employees');
        dataActions('.employee-link','/employees',false);
       
    });
</script>