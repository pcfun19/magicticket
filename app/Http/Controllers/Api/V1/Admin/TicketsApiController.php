<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Http\Resources\Admin\TicketResource;
use App\Ticket;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TicketsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('ticket_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TicketResource(Ticket::with(['event', 'created_by'])->get());

    }

    public function store(StoreTicketRequest $request)
    {
        $ticket = Ticket::create($request->all());

        if ($request->input('ticket_image', false)) {
            $ticket->addMedia(storage_path('tmp/uploads/' . $request->input('ticket_image')))->toMediaCollection('ticket_image');
        }

        return (new TicketResource($ticket))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(Ticket $ticket)
    {
        abort_if(Gate::denies('ticket_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TicketResource($ticket->load(['event', 'created_by']));

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

        return (new TicketResource($ticket))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(Ticket $ticket)
    {
        abort_if(Gate::denies('ticket_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ticket->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
