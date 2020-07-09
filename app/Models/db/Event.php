<?php

namespace App\Models\db;

use Illuminate\Database\Eloquent\Model;

/**
 * Мероприятие
 *
 * @property int    $id
 * @property string $name
 * @property string $date
 * @property string $city
 */
class Event extends Model
{
    public $timestamps = false;
    
    protected $table = 'event';
}
