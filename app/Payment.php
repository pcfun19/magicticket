<?php

namespace App;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Payment extends Model
{
    use SoftDeletes, MultiTenantModelTrait, Auditable;

    public $table = 'payments';

    public static $searchable = [
        'uuid',
    ];

    const STATUS_SELECT = [
        'paid'        => 'Paid',
        'refunded'    => 'Refunded',
        'chargedback' => 'Chargedback',
    ];

    protected $dates = [
        'refunded_at',
        'first_scanned',
        'last_scanned',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'uuid',
        'ticket_id',
        'status',
        'method_id',
        'refunded_at',
        'chargedback',
        'affiliate_user_id',
        'first_scanned',
        'last_scanned',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');

    }

    public function method()
    {
        return $this->belongsTo(SavedCustomer::class, 'method_id');

    }

    public function getRefundedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;

    }

    public function setRefundedAtAttribute($value)
    {
        $this->attributes['refunded_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;

    }

    public function affiliate_user()
    {
        return $this->belongsTo(User::class, 'affiliate_user_id');

    }

    public function getFirstScannedAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;

    }

    public function setFirstScannedAttribute($value)
    {
        $this->attributes['first_scanned'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;

    }

    public function getLastScannedAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;

    }

    public function setLastScannedAttribute($value)
    {
        $this->attributes['last_scanned'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;

    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');

    }
}
