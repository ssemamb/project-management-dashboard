<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'status',
        'created_by',
        'updated_by'

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
}
