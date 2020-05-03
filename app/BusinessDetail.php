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

class BusinessDetail extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, HasMediaTrait, Auditable;

    public $table = 'business_details';

    protected $appends = [
        'passport',
        'documents',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'taxid',
        'activities_details',
        'created_at',
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
        BusinessDetail::observe(new \App\Observers\BusinessDetailActionObserver);

    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(150);

    }

    public function getPassportAttribute()
    {
        $files = $this->getMedia('passport');
        $files->each(function ($item) {
            $item->url       = $item->getTemporaryUrl(Carbon::now()->addMinutes(30));
            $item->thumbnail = $item->getTemporaryUrl(Carbon::now()->addMinutes(30),'thumb');
        });

        return $files;

    }

    public function getDocumentsAttribute()
    {
        // return $this->getMedia('documents');
        $files = $this->getMedia('documents');
        $files->each(function ($item) {
            $item->url       = $item->getTemporaryUrl(Carbon::now()->addMinutes(30));
            $item->thumbnail = $item->getTemporaryUrl(Carbon::now()->addMinutes(30),'thumb');
        });

        return $files;

    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');

    }
}
