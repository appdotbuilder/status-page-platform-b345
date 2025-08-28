<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\IncidentUpdate
 *
 * @property int $id
 * @property int $incident_id
 * @property string $message
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Incident $incident
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentUpdate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentUpdate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentUpdate query()
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentUpdate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentUpdate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentUpdate whereIncidentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentUpdate whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentUpdate whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentUpdate whereUpdatedAt($value)
 * @method static \Database\Factories\IncidentUpdateFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class IncidentUpdate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'incident_id',
        'message',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'incident_id' => 'integer',
    ];

    /**
     * Get the incident that owns the update.
     */
    public function incident(): BelongsTo
    {
        return $this->belongsTo(Incident::class);
    }
}