<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\JobApplication;

class Job extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'published_at' => 'date',
        'expires_at' => 'date',
        'is_published' => 'boolean',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function employer()
    {
        return $this->hasOneThrough(
            Employer::class,
            User::class,
            'id',
            'user_id',
            'created_by_id',
            'id'
        );
    }

    public function scopeActive($query)
    {
        return $query->where('is_published', true)
            ->whereDate('expires_at', '>', now());
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class, 'job_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($q, $search) {
            $q->where(function ($subQ) use ($search) {
                $subQ->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('company_name', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['min_salary'] ?? false, function ($q, $salary) {
            $q->where('salary', '>=', $salary);
        });
    }
}
