<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'descripton',
        'image_path',
        'status',
        'priority',
        'due_date',
        'asigned_user_id',
        'created_by',
        'updated_by',
        'project_id',
        'category_id'
    ];


    public function creator(): BelongsTo
    {
        return $this->belongsTo(related: User::class, foreignKey: 'created_by');
    }

    public function updator(): BelongsTo
    {
        return $this->belongsTo(related: User::class, foreignKey: 'updated_by');
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function asignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, foreignKey: 'asigned_user_id');
    }
}
