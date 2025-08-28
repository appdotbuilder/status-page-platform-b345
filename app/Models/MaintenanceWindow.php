<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\MaintenanceWindow
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $status
 * @property \Illuminate\Support\Carbon $scheduled_start
 * @property \Illuminate\Support\Carbon $scheduled_end
 * @property \Illuminate\Support\Carbon|null $actual_start
 * @property \Illuminate\Support\Carbon|null $actual_end
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Component> $components
 * @property-read int|null $components_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|MaintenanceWindow newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MaintenanceWindow newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MaintenanceWindow query()
 * @method static \Illuminate\Database\Eloquent\Builder|MaintenanceWindow whereActualEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaintenanceWindow whereActualStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaintenanceWindow whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaintenanceWindow whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaintenanceWindow whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaintenanceWindow whereScheduledEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaintenanceWindow whereScheduledStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaintenanceWindow whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaintenanceWindow whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaintenanceWindow whereUpdatedAt($value)
 * @method static \Database\Factories\MaintenanceWindowFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class MaintenanceWindow extends Model
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
        'scheduled_start',
        'scheduled_end',
        'actual_start',
        'actual_end',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'scheduled_start' => 'datetime',
        'scheduled_end' => 'datetime',
        'actual_start' => 'datetime',
        'actual_end' => 'datetime',
    ];

    /**
     * Get the components affected by this maintenance window.
     */
    public function components(): BelongsToMany
    {
        return $this->belongsToMany(Component::class, 'maintenance_component');
    }
}