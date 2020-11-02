<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uteis extends Model
{

}
function print_rpre($valor)
    {
        echo "<pre>";
        print_r($valor);
        echo "</pre>";
    }

