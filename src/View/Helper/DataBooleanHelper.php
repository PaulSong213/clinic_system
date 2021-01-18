<?php

namespace App\View\Helper;

use Cake\View\Helper;
class DataBooleanHelper extends Helper
{
    public function setAlternativeBoolean($status, $trueAlternative = 'Active',
            $falseAlternative = 'Inactive')
    {
        if($status){
            return $trueAlternative;
        }else{
            return $falseAlternative;
        }
    }
}

