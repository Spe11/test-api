<?php

use App\Models\db\Event;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('event')->insert([
            'id' => 1,
            'name' => 'name',
            'date' => '2000-10-10:10-10-10',
            'city' => 'city',
        ]);

        DB::table('participant')->insert([
            'id' => 1,
            'first_name' => 'firstName',
            'last_name' => 'lastName',
            'email' => 'email',
            'event_id' => 1,
        ]);
    }
}
