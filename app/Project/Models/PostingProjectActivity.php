<?php declare(strict_types = 1);

namespace App\Project\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostingProjectActivity extends Model
{
    /** @use HasFactory<\Database\Factories\PostingProjectActivityFactory> */
    use HasFactory;

    protected static string $factory = \Database\Factories\PostingProjectActivityFactory::class;

    protected $fillable = [
        "scope",
        "description",
        "start_time",
        "end_time",
        "duration",
        "project_id",
        "monthly_project_control_id",
    ];

    /**
     * @return BelongsTo<Project, $this>
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @return BelongsTo<MonthlyProjectControl, $this>
     */
    public function monthlyProjectControl(): BelongsTo
    {
        return $this->belongsTo(MonthlyProjectControl::class);
    }
}
