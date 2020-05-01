<?php

namespace App\Http\Controllers\Admin;

use App\BusinessDetail;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBusinessDetailRequest;
use App\Http\Requests\StoreBusinessDetailRequest;
use App\Http\Requests\UpdateBusinessDetailRequest;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BusinessDetailsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('business_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessDetails = BusinessDetail::all();

        return view('admin.businessDetails.index', compact('businessDetails'));
    }

    public function create()
    {
        abort_if(Gate::denies('business_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.businessDetails.create');
    }

    public function store(StoreBusinessDetailRequest $request)
    {
        $businessDetail = BusinessDetail::create($request->all());

        foreach ($request->input('passport', []) as $file) {
            $businessDetail->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('passport');
        }

        foreach ($request->input('documents', []) as $file) {
            $businessDetail->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('documents');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $businessDetail->id]);
        }

        return redirect()->route('admin.business-details.index');

    }

    public function edit(BusinessDetail $businessDetail)
    {
        abort_if(Gate::denies('business_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessDetail->load('created_by');

        return view('admin.businessDetails.edit', compact('businessDetail'));
    }

    public function update(UpdateBusinessDetailRequest $request, BusinessDetail $businessDetail)
    {
        $businessDetail->update($request->all());

        if (count($businessDetail->passport) > 0) {
            foreach ($businessDetail->passport as $media) {
                if (!in_array($media->file_name, $request->input('passport', []))) {
                    $media->delete();
                }

            }

        }

        $media = $businessDetail->passport->pluck('file_name')->toArray();

        foreach ($request->input('passport', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $businessDetail->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('passport');
            }

        }

        if (count($businessDetail->documents) > 0) {
            foreach ($businessDetail->documents as $media) {
                if (!in_array($media->file_name, $request->input('documents', []))) {
                    $media->delete();
                }

            }

        }

        $media = $businessDetail->documents->pluck('file_name')->toArray();

        foreach ($request->input('documents', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $businessDetail->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('documents');
            }

        }

        return redirect()->route('admin.business-details.index');

    }

    public function show(BusinessDetail $businessDetail)
    {
        abort_if(Gate::denies('business_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessDetail->load('created_by');

        return view('admin.businessDetails.show', compact('businessDetail'));
    }

    public function destroy(BusinessDetail $businessDetail)
    {
        abort_if(Gate::denies('business_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessDetail->delete();

        return back();

    }

    public function massDestroy(MassDestroyBusinessDetailRequest $request)
    {
        BusinessDetail::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('business_detail_create') && Gate::denies('business_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new BusinessDetail();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);

    }

}
