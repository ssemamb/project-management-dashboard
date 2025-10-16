<?php

namespace App\Models;

use Filament\Panel\Concerns\HasFont;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'image_path',
        'status',
        'created_by',
        'updated_by',
        'client_id',
        'category_id'
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function creator(): BelongsTo
    {
        return $this->belongsTo(related: User::class, foreignKey: 'created_by');
    }

    public function updator(): BelongsTo
    {
        return $this->belongsTo(related: User::class, foreignKey: 'updated_by');
    }

    public function task(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
