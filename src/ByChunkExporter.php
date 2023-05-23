<?php

namespace Lupennat\ImportExportCard;

class ByChunkExporter extends BasicExporter
{
    public function download()
    {
        $modelClass = $this->modelClass;

        return response()->streamDownload(function () use ($modelClass) {
            $handle = fopen('php://output', 'w');

            if (!empty($this->headings())) {
                fputcsv($handle, $this->headings());
                flush();
            }

            $modelClass::chunkById(1000, function ($collection) use (&$handle) {
                foreach ($collection as $key => $item) {
                    $row = $this->row($item);
                    fputcsv($handle, $row);
                    flush();

                }
            });

            fclose($handle);
        }, $this->filename());

    }
}
