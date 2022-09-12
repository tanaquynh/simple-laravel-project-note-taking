<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Note extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'notes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', 'title', 'complated', 
        'created_at', 'updated_at', 'deleted_at', 
        'created_by'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function($model) {
            $model->created_by = auth()->user()->id;
        });
    }

}
