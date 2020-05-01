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

class Ticket extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, HasMediaTrait, Auditable;

    public $table = 'tickets';

    protected $appends = [
        'ticket_image',
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

    protected $fillable = [
        'uuid',
        'event_id',
        'name',
        'total_available',
        'price',
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
        $this->addMediaConversion('thumb')->width(50)->height(50);

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
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
        }

        return $file;

    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');

    }

}
