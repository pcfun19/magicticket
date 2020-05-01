<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\BusinessDetail;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBusinessDetailRequest;
use App\Http\Requests\UpdateBusinessDetailRequest;
use App\Http\Resources\Admin\BusinessDetailResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BusinessDetailsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('business_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BusinessDetailResource(BusinessDetail::with(['created_by'])->get());

    }

    public function store(StoreBusinessDetailRequest $request)
    {
        $businessDetail = BusinessDetail::create($request->all());

        if ($request->input('passport', false)) {
            $businessDetail->addMedia(storage_path('tmp/uploads/' . $request->input('passport')))->toMediaCollection('passport');
        }

        if ($request->input('documents', false)) {
            $businessDetail->addMedia(storage_path('tmp/uploads/' . $request->input('documents')))->toMediaCollection('documents');
        }

        return (new BusinessDetailResource($businessDetail))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(BusinessDetail $businessDetail)
    {
        abort_if(Gate::denies('business_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BusinessDetailResource($businessDetail->load(['created_by']));

    }

    public function update(UpdateBusinessDetailRequest $request, BusinessDetail $businessDetail)
    {
        $businessDetail->update($request->all());

        if ($request->input('passport', false)) {
            if (!$businessDetail->passport || $request->input('passport') !== $businessDetail->passport->file_name) {
                $businessDetail->addMedia(storage_path('tmp/uploads/' . $request->input('passport')))->toMediaCollection('passport');
            }

        } elseif ($businessDetail->passport) {
            $businessDetail->passport->delete();
        }

        if ($request->input('documents', false)) {
            if (!$businessDetail->documents || $request->input('documents') !== $businessDetail->documents->file_name) {
                $businessDetail->addMedia(storage_path('tmp/uploads/' . $request->input('documents')))->toMediaCollection('documents');
            }

        } elseif ($businessDetail->documents) {
            $businessDetail->documents->delete();
        }

        return (new BusinessDetailResource($businessDetail))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(BusinessDetail $businessDetail)
    {
        abort_if(Gate::denies('business_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessDetail->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
