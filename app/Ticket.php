<?php

namespace App;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class Ticket extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, HasMediaTrait, Auditable;

    public $table = 'tickets';

    protected $appends = [
        'ticket_image',
        'ticket_sample',
    ];

    public static $searchable = [
        'uuid',
        'name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const CURRENCY_SELECT = [
        'eur' => 'EUR',
        'usd' => 'USD',
        'gbp' => 'GBP',
    ];

    protected $fillable = [
        'uuid',
        'event_id',
        'name',
        'total_available',
        'price',
        'currency',
        'includes',
        'instructions',
        'created_at',
        'top_margin',
        'left_margin',
        'font_size',
        'font_angle',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(150);

    }

    public function ticketPayments()
    {
        return $this->hasMany(Payment::class, 'ticket_id', 'id');

    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');

    }

    public function getTicketImageAttribute()
    {

        $file = $this->getMedia('ticket_image')->last();

        if ($file) {
            $file->url       = $file->getTemporaryUrl(Carbon::now()->addMinutes(30));
            $file->thumbnail = $file->getTemporaryUrl(Carbon::now()->addMinutes(30),'thumb');
        }

        return $file;

    }


    public function getTicketSampleAttribute()
    {

        $file = $this->getMedia('ticket_sample')->last();

        if ($file) {
            $file->url       = $file->getTemporaryUrl(Carbon::now()->addMinutes(30));
            $file->thumbnail = $file->getTemporaryUrl(Carbon::now()->addMinutes(30),'thumb');
        }

        return $file;

    }

    public function getEventDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;

    }

    public function setEventDateAttribute($value)
    {
        $this->attributes['event_date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;

    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');

    }

}
