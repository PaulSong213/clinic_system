<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InDepartment $inDepartment
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <p class="inDepartment-link">List Employee in Department</p>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="inDepartments form content">
            <?= $this->Form->create($inDepartment,[
                 'id' => 'mainAddForm',
            ]) ?>
            <fieldset>
                <legend><?= __('Add In Department') ?></legend>
                <?php
                    echo $this->Form->control('employee_id', 
                            ['options' => $employees,
                             'id' => 'employee'    
                            ]);
                    echo $this->Form->control('department_id', 
                            ['options' => $departments,
                              'id' => 'department']);
                    echo $this->Form->control('title',[
                        'type' => 'hidden',
                        'id' => 'title'
                    ]);
                    echo $this->Form->control('time_from');
                    echo $this->Form->control('time_to');
                    echo $this->Form->control('is_active');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script>
    function setTitle(){
        var selectedDepartment = $("#department option:selected").html();
        var selectedEmployee = $("#employee option:selected").html();
        $('#title').attr('value', selectedEmployee + ' | '+ selectedDepartment); 
    }
    $(document).ready(function(){
        setTitle();
        $("#department").click(function(){
            setTitle();
        });
        $("#employee").click(function(){
            setTitle();
        });
        addForm('/in-departments/add','/in-departments');
        dataActions('.inDepartment-link','/in-departments',false);
    });
</script>  

