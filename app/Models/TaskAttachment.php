<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskAttachment  extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'file_type',
        'name',
        'uri',
        'task_id',
    ];

    public static function boot()
    {
        parent::boot();
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id', 'id');
    }
}

