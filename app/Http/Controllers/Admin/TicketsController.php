<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTicketRequest;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Ticket;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Intervention\Image\ImageManagerStatic as Image;
use UUID;
use QrCode;

class TicketsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('ticket_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tickets = Ticket::all();

        return view('admin.tickets.index', compact('tickets'));
    }

    public function create()
    {
        abort_if(Gate::denies('ticket_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.tickets.create', compact('events'));
    }

    public function store(StoreTicketRequest $request)
    {
        $uuid = UUID::generate()->string;
        $ticket = Ticket::create($request->all());

        if ($request->input('ticket_image', false)) {
            $ticket->addMedia(storage_path('tmp/uploads/' . $request->input('ticket_image')))->toMediaCollection('ticket_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $ticket->id]);
        }

        $this->create_sample($ticket);

        return redirect()->route('admin.tickets.show',$ticket->id)->withMessage('You should be able to see a sample ticket as the ones your clients will see. Ensure the text is correctly placed and visible or adjust.');

    }

    public function edit(Ticket $ticket)
    {
        abort_if(Gate::denies('ticket_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ticket->load('event', 'created_by');

        return view('admin.tickets.edit', compact('events', 'ticket'));
    }

    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $ticket->update($request->all());

        if ($request->input('ticket_image', false)) {
            if (!$ticket->ticket_image || $request->input('ticket_image') !== $ticket->ticket_image->file_name) {
                $ticket->addMedia(storage_path('tmp/uploads/' . $request->input('ticket_image')))->toMediaCollection('ticket_image');
            }

        } elseif ($ticket->ticket_image) {
            $ticket->ticket_image->delete();
        }
        
        $this->create_sample($ticket);

        return redirect()->route('admin.tickets.show',$ticket->id)->withMessage('You should be able to see a sample ticket as the ones your clients will see. Ensure the text is correctly placed and visible or adjust.');

    }

    public function create_sample ($ticket) {
        
        $uuid = $ticket->uuid;
        // create Image from file
        $img = Image::make($ticket->ticket_image->url)->resize(300, 400);

        // write text at position
        $img->text($uuid, $ticket->left_margin,  $ticket->top_margin, function($font) use ($ticket) {
            
            // $font->file(public_path('fonts/lato/Lato-Regular.ttf'));
            $font->size($ticket->font_size);
            $font->color('#000000');
            $font->angle($ticket->font_angle);
        });

        
        $img->insert(base64_encode(QrCode::format('png')->size(100)->errorCorrection('H')->generate($uuid)), 'bottom-right', 10, 10)->encode('data-url');

        $ticket->addMediaFromBase64($img)->usingFileName($uuid.'.png')->toMediaCollection('ticket_sample');
    }

    public function show(Ticket $ticket)
    {
        abort_if(Gate::denies('ticket_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ticket->load('event', 'created_by', 'ticketPayments');

        return view('admin.tickets.show', compact('ticket'));
    }

    public function destroy(Ticket $ticket)
    {
        abort_if(Gate::denies('ticket_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ticket->delete();

        return back();

    }

    public function massDestroy(MassDestroyTicketRequest $request)
    {
        Ticket::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('ticket_create') && Gate::denies('ticket_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Ticket();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);

    }

}
