<?php

namespace App\Models;

use App\Enums\TypeOwners;
use App\Traits\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'user_data';

    protected $fillable = [
        'user_id',
        'type_owner',
        'first_name',
        'last_name',
        'middle_name',
        'region',
        'address',
        'phone',
        'email',
        'passport_series',
        'passport_number',
        'passport_issued_by',
        'passport_issued_date',
        'unp',
        'info',
        'company_name',
        'documents',
        'status',
        'admin_comment'
    ];

    protected $casts = [
        'type_owner' => TypeOwners::class,
        'documents' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
