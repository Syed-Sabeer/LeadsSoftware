<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'status',
        'source',
        'fullname',
        'email',
        'phone1',
        'phone2',
        'company',
        'website',
        'disposition',
        'additional_details',
        'comments',
        'country'
    ];

    protected $dates = ['deleted_at'];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Search scope
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('fullname', 'like', '%' . $search . '%')
              ->orWhere('email', 'like', '%' . $search . '%')
              ->orWhere('phone1', 'like', '%' . $search . '%')
              ->orWhere('phone2', 'like', '%' . $search . '%')
              ->orWhere('company', 'like', '%' . $search . '%');
        });
    }

    // Status scope
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Source scope
    public function scopeSource($query, $source)
    {
        return $query->where('source', $source);
    }
} 