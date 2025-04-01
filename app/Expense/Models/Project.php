<?php declare(strict_types = 1);

namespace App\Expense\Models;

use App\Service\Models\PostingProjectActivity;
use App\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected static string $factory = \Database\Factories\ProjectFactory::class;

    protected $fillable = [
        "type",
        "hourly_rate",
        "total_hours_worked",
        "total_receivable",
        "user_id",
    ];

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany<PostingProjectActivity, $this>
     */
    public function PostingProjectActivities(): HasMany
    {
        return $this->hasMany(PostingProjectActivity::class);
    }
}
