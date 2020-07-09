<?php

namespace App\Models\db;

use Illuminate\Database\Eloquent\Model;

/**
 * Участник
 *
 * @property int    $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property int    $event_id
 */
class Participant extends Model
{
    public $timestamps = false;

    protected $table = 'participant';

    protected $perPage = 10;
}
