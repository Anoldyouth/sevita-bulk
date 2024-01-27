<?php

namespace App\Http\Controllers;

use App\Actions\CreatePerfumesImportAction;
use App\Actions\ProcessImportAction;
use App\Http\Requests\CreatePerfumesImportRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class PerfumesImportController extends VoyagerBaseController
{
    public function store(Request $request)
    {
        try {
            $request = CreatePerfumesImportRequest::createFrom($request);

            $slug = $this->getSlug($request);

            $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

            // Check permission
            $this->authorize('add', app($dataType->model_name));

            // Validate fields with ajax
            $val = $request->validated();

            $data = app(CreatePerfumesImportAction::class)->execute($request->uploadedFile());
            app(ProcessImportAction::class)->onQueue()->execute($data);

            event(new BreadDataAdded($dataType, $data));

            if (!$request->has('_tagging')) {
                if (auth()->user()->can('browse', $data)) {
                    $redirect = redirect()->route("voyager.{$dataType->slug}.index");
                } else {
                    $redirect = redirect()->back();
                }

                return $redirect->with([
                    'message'    => __('voyager::generic.successfully_added_new')." {$dataType->getTranslatedAttribute('display_name_singular')}",
                    'alert-type' => 'success',
                ]);
            } else {
                return response()->json(['success' => true, 'data' => $data]);
            }
        } catch (\Throwable $exception) {
            dd($exception);
        }

    }

    public function show(Request $request, $id)
    {
        throw new NotFoundHttpException();
    }

    public function edit(Request $request, $id)
    {
        throw new NotFoundHttpException();
    }

    public function update(Request $request, $id)
    {
        throw new NotFoundHttpException();
    }

    public function destroy(Request $request, $id)
    {
        throw new NotFoundHttpException();
    }

    public function restore(Request $request, $id)
    {
        throw new NotFoundHttpException();
    }

    public function remove_media(Request $request)
    {
        throw new NotFoundHttpException();
    }
}
