<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Component
 *
 * @property int $id
 * @property int $component_group_id
 * @property string $name
 * @property string|null $description
 * @property string $status
 * @property int $sort_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ComponentGroup $componentGroup
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Incident> $incidents
 * @property-read int|null $incidents_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MaintenanceWindow> $maintenanceWindows
 * @property-read int|null $maintenance_windows_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Component newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Component newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Component query()
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereComponentGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereUpdatedAt($value)
 * @method static \Database\Factories\ComponentFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Component extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'component_group_id',
        'name',
        'description',
        'status',
        'sort_order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'component_group_id' => 'integer',
        'sort_order' => 'integer',
    ];

    /**
     * Get the component group that owns the component.
     */
    public function componentGroup(): BelongsTo
    {
        return $this->belongsTo(ComponentGroup::class);
    }

    /**
     * Get the incidents that affect this component.
     */
    public function incidents(): BelongsToMany
    {
        return $this->belongsToMany(Incident::class);
    }

    /**
     * Get the maintenance windows that affect this component.
     */
    public function maintenanceWindows(): BelongsToMany
    {
        return $this->belongsToMany(MaintenanceWindow::class, 'maintenance_component');
    }
}