<?php

namespace App;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;
use Carbon;

class Event extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, HasMediaTrait, Auditable;

    public $table = 'events';

    protected $appends = [
        'cover',
    ];

    public static $searchable = [
        'name',
    ];

    protected $dates = [
        'event_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'is_online',
        'address',
        'organiser_details',
        'scan_code',
        'latdec',
        'londec',
        'event_date',
        'created_at',
        'slug',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public static function boot()
    {
        parent::boot();
        Event::observe(new \App\Observers\EventActionObserver);

    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(150);

    }

    public function eventTickets()
    {
        return $this->hasMany(Ticket::class, 'event_id', 'id');

    }

    public function getCoverAttribute()
    {
        $file = $this->getMedia('cover')->last();

        if ($file) {
            $file->url       = $file->getTemporaryUrl(Carbon::now()->addMinutes(30));
            $file->thumbnail = $file->getTemporaryUrl(Carbon::now()->addMinutes(30),'thumb');
        }

        return $file;

    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');

    }

}
