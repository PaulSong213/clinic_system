<?php

?>

<div class="content form">
    <h3 class="text-center"><?= __('System Configuration') ?></h3>
    <div class="flex flex-col justify-center">
    <?= $this->Form->control('System Name for: '.$_SERVER['HTTP_HOST'], 
            ['options' => $clinics,
              'class' => 'mb-5 nameLocation']);?>
        <input type="button" value="Save" style="width: fit-content" 
               class="block mx-auto saveSettings"/>
    </div>
</div>

<script>
    
    function setCurrentSystemName(){
        var nameLocText = $(".nameLocation option:first").html();
        var nameLocSlice = nameLocText.split(';');
        var clinicName = nameLocSlice[0];
        var clinicAddress = nameLocSlice[1];
        setSystemName(clinicName);
    }
    
    $(document).ready(function(){
        
    });
    
    
</script>