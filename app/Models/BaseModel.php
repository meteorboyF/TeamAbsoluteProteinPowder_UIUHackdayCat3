<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

abstract class BaseModel extends Model
{
    // Common logic for all Mongo models
    protected $connection = 'mongodb';
}
