<?php declare(strict_types = 1);

namespace App\Project\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MonthlyProjectControl extends Model
{
    /** @use HasFactory<\Database\Factories\MonthlyProjectControlFactory> */
    use HasFactory;

    protected static string $factory = \Database\Factories\MonthlyProjectControlFactory::class;

    protected $fillable = [
        'month',
        'year',
        'hourly_rate',
        'total_hours_worked',
        'total_receivable',
    ];

    /**
     * @return BelongsTo<Project, $this>
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @return HasMany<PostingProjectActivity, $this>
     */
    public function postingProjectActivities(): HasMany
    {
        return $this->hasMany(PostingProjectActivity::class);
    }
}
