<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Person extends Model
{
    use HasFactory;
    protected $table ='people';
    public $timestamps = false;
    public function cvs():HasMany{
        return $this->hasMany(Cv::class);
    }

    public $fillable =[
        'name','email','post'
    ];
}
