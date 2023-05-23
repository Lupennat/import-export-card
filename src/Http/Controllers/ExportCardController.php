<?php

namespace Lupennat\ImportExportCard\Http\Controllers;

use Laravel\Nova\Actions\Action;
use Laravel\Nova\Http\Requests\NovaRequest;
use Lupennat\ExportCard\BasicExporter;

class ExportCardController
{
    public function handle(NovaRequest $request)
    {
        $resource = $request->newResource();
        $exporterClass = $resource::$exporter ?? BasicExporter::class;

        $exporter = new $exporterClass(get_class($resource->resource));

        try {
            return $exporter->download();
        } catch (\Exception $e) {
            Action::danger($e->getMessage());
        }
    }
}
