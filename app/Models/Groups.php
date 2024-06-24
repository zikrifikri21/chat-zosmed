<?php

namespace App\Models;

use App\Http\Enums\GroupUserRole;
use App\Http\Enums\GroupUserStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

class Groups extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasSlug;

    protected $fillable = [
        'name',
        'user_id',
        'auto_approval',
        'about',
        'cover_path',
        'thumbnail_path',
        'pinned_post_id',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function currentUserGroup(): HasOne
    {
        return $this->hasOne(GroupUsers::class, 'group_id')->where('user_id', Auth::id());
    }

    public function isAdmin($userId): bool
    {
        return GroupUsers::query()
            ->where('user_id', $userId)
            ->where('group_id', $this->id)
            ->where('role', GroupUserRole::ADMIN->value)
            ->exists();
    }
    public function hasApprovedUser($userId): bool
    {
        return GroupUsers::query()
            ->where('user_id', $userId)
            ->where('group_id', $this->id)
            ->where('status', GroupUserStatus::APPROVED->value)
            ->exists();
    }
    public function isOwner($userId): bool
    {
        return $this->user_id == $userId;
    }

    public function adminUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'group_users', 'group_id')
            ->wherePivot('role', GroupUserRole::ADMIN->value);
    }
    public function pendingUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'group_users', 'group_id')
            ->wherePivot('status', GroupUserStatus::PENDING->value);
    }
    public function approvedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'group_users', 'group_id')
            ->wherePivot('status', GroupUserStatus::APPROVED->value);
    }
}
