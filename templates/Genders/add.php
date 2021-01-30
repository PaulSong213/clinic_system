<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Gender $gender
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <p class="gender-link">List Genders</p>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="genders form content">
            <?= $this->Form->create($gender,[
                 'id' => 'mainAddForm',
            ]) ?>
            <fieldset>
                <legend><?= __('Add Gender') ?></legend>
                <?php
                    echo $this->Form->control('gender_title');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        addForm('/genders/add','/genders');
        dataActions('.gender-link','/genders',false);
    });
</script>