<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cv extends Model
{
    use HasFactory;

    protected $table = 'cvs';

    public $timestamps = false;

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    public $fillable = [
        'body', 'person_id',
    ];
}
