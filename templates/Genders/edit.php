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
            <p class="delete" id="d<?=$gender->id?>" >Delete gender</p>
            <p class="gender-link">List gender</p>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="genders form content">
            <?= $this->Form->create($gender,[
                'id' => '/genders/edit/'.$gender->id,
                'class' => 'editForm'
            ]) ?>
            <fieldset>
                <legend><?= __('Edit Gender') ?></legend>
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
        dataActions('.gender-link','/genders',false);
        dataDeleteAction('/genders/delete/', '/genders',false);
        editForm('.editForm','/genders');
    });
</script>