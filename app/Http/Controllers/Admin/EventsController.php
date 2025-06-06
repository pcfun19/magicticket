<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEventRequest;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Carbon;
use Geocoder;

class EventsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('event_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::all();

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        abort_if(Gate::denies('event_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.events.create');
    }

    public function store(StoreEventRequest $request)
    {
        $geoAdd = [];
        if ($request->input('is_online')==0){ $geo = Geocoder::getCoordinatesForAddress($request->input('address'));
            $geoAdd = ['latdec'=>$geo['lat'],'longdec'=>$geo['lng']];
        }
        $isOnline = [];
        if (!$request->input('is_online')){
            $isOnline = ['is_online'=>0];
        }


        $event = Event::create($request->all()+['scan_code'=>$this->gen_rand()]+$geoAdd+$isOnline);

        if ($request->input('cover', false)) {
            $event->addMedia(storage_path('tmp/uploads/' . $request->input('cover')))->toMediaCollection('cover');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $event->id]);
        }

        return redirect()->route('admin.events.show',$event->id)->withMessage('Event created. If the address is physical, please check the map to confirm the address is shown properly or contact us.');

    }

    public function edit(Event $event)
    {
        abort_if(Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->load('created_by');

        return view('admin.events.edit', compact('event'));
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $geoAdd = [];
        if ($event->address!=$request->input('address') && $request->input('is_online')==0){ $geo = Geocoder::getCoordinatesForAddress($request->input('address'));
            $geoAdd = ['latdec'=>$geo['lat'],'londec'=>$geo['lng']];
        }

        $isOnline = [];
        if (!$request->input('is_online')){
            $isOnline = ['is_online'=>0];
        }

        $event->update($request->all()+$geoAdd+$isOnline);

        if ($request->input('cover', false)) {
            if (!$event->cover || $request->input('cover') !== $event->cover->file_name) {
                $event->addMedia(storage_path('tmp/uploads/' . $request->input('cover')))->toMediaCollection('cover');
            }

        } elseif ($event->cover) {
            $event->cover->delete();
        }

        return redirect()->route('admin.events.show',$event->id)->withMessage('Event created. If the address is physical, please check the map to confirm the address is shown properly or contact us.');

    }

    public function show(Event $event)
    {
        abort_if(Gate::denies('event_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->load('created_by', 'eventTickets');

        return view('admin.events.show', compact('event'));
    }

    public function destroy(Event $event)
    {
        abort_if(Gate::denies('event_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->delete();

        return back();

    }

    public function massDestroy(MassDestroyEventRequest $request)
    {
        Event::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('event_create') && Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Event();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);

    }

}
