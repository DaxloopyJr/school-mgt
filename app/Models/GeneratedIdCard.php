<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneratedIdCard extends Model
{
    protected $table = 'generated_id_cards';

    protected $fillable = ['student_id', 'id_card_id', 'card_no', 'date'];

    protected $casts = ['pinned' => 'boolean', 'submitted_at' => 'datetime', 'read_at' => 'datetime', 'logged_in_at' => 'datetime'];
}
