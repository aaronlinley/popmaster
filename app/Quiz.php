<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    // Helpers
    public function questions() {
        return [
            [
                'name' => 'Question 1',
                'points' => 3,
            ],
            [
                'name' => 'Question 2',
                'points' => 3,
            ],
            [
                'name' => 'Question 3 (Bonus)',
                'points' => 6,
            ],
            [
                'name' => 'Question 4',
                'points' => 3,
            ],
            [
                'name' => 'Question 5',
                'points' => 3,
            ],
            [
                'name' => 'Question 6 (Bonus)',
                'points' => 6,
            ],
            [
                'name' => 'Question 7',
                'points' => 3,
            ],
            [
                'name' => 'Question 8',
                'points' => 3,
            ],
            [
                'name' => 'Question 9 (Bonus)',
                'points' => 6,
            ],
            [
                'name' => 'Question 10',
                'points' => 3,
            ],
        ];
    }
}
