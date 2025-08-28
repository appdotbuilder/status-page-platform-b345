<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\ComponentGroup
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $sort_order
 * @property bool $is_expanded
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Component> $components
 * @property-read int|null $components_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|ComponentGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ComponentGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ComponentGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|ComponentGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComponentGroup whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComponentGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComponentGroup whereIsExpanded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComponentGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComponentGroup whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComponentGroup whereUpdatedAt($value)
 * @method static \Database\Factories\ComponentGroupFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class ComponentGroup extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
        'sort_order',
        'is_expanded',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_expanded' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get the components for the group.
     */
    public function components(): HasMany
    {
        return $this->hasMany(Component::class)->orderBy('sort_order');
    }
}