<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'created_by_id');
    }

    public function employer()
    {
        return $this->hasOne(Employer::class);
    }

    public function hasIncompleteProfile(): bool
    {
        $employer = $this->employer;

        if (! $employer) {
            return true;
        }

        if (empty($employer->name) || empty($employer->logo) || empty($employer->description)) {
            return true;
        }

        return false;
    }

    public function getUrgentJob()
    {
        if (! $this->employer) {
            return null;
        }

        return $this->employer->jobs()
            ->whereDate('expires_at', '>=', now())
            ->whereDate('expires_at', '<=', now()->addDays(5))
            ->orderBy('expires_at', 'asc')
            ->first();
    }

    public function getQuickStats()
    {
        $employer = $this->employer;

        if (!$employer) {
            return (object) ['applicants' => 0, 'jobs' => 0];
        }

        $totalJobs = $employer->jobs()->count();

        $jobIds = $employer->jobs()->pluck('id');

        $applicantsThisWeek = \App\Models\JobApplication::whereIn('job_id', $jobIds)
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->count();

        return (object) [
            'applicants' => $applicantsThisWeek,
            'jobs' => $totalJobs
        ];
    }

    public function getRecentEmployerJobs($limit = 3)
    {
        if (! $this->employer) {
            return collect();
        }

        return $this->employer->jobs()
            ->latest()
            ->take($limit)
            ->get();
    }

    public function hasPostedJob()
    {
        return $this->employer && $this->employer->jobs()->count() > 0;
    }
}
