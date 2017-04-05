<?php

namespace App\Models\B2c;

use Illuminate\Database\Eloquent\Model;

Abstract class AbstractB2cModel extends Model
{
    protected $connection = 'mysql_eccube2_b2c';
}
