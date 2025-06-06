<?php

namespace App;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class SavedCustomer extends Model
{
    use SoftDeletes, MultiTenantModelTrait, Auditable;

    public $table = 'saved_customers';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'provider',
        'code',
        'method_type',
        'slug',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function methodPayments()
    {
        return $this->hasMany(Payment::class, 'method_id', 'id');

    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');

    }
}
