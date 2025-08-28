<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Incident
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $status
 * @property string $impact
 * @property \Illuminate\Support\Carbon $started_at
 * @property \Illuminate\Support\Carbon|null $resolved_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Component> $components
 * @property-read int|null $components_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\IncidentUpdate> $updates
 * @property-read int|null $updates_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Incident newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Incident newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Incident query()
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereImpact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereResolvedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereUpdatedAt($value)
 * @method static \Database\Factories\IncidentFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Incident extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'description',
        'status',
        'impact',
        'started_at',
        'resolved_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'started_at' => 'datetime',
        'resolved_at' => 'datetime',
    ];

    /**
     * Get the components affected by this incident.
     */
    public function components(): BelongsToMany
    {
        return $this->belongsToMany(Component::class);
    }

    /**
     * Get the updates for this incident.
     */
    public function updates(): HasMany
    {
        return $this->hasMany(IncidentUpdate::class)->orderBy('created_at', 'desc');
    }
}