<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupTime extends Model
{
    use HasFactory;
    protected $fillable = ['user_id' , 'group_id' , 'time_from' , 'time_to' ];


    public function group()
    {
        return $this->belongsTo(Group::class , 'group_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'time_from' => 'datetime',
            'time_to' => 'datetime',
        ];
    }
}
