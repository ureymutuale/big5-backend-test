<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'status'
    ];

    public static function boot()
    {
        parent::boot();
    }

    public function attachments()
    {
        return $this->hasMany(TaskAttachment::class, 'task_id', 'id');
    }
}


