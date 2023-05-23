<?php

namespace Lupennat\ImportExportCard;

use Illuminate\Support\Str;

class BasicExporter
{
    protected $modelClass;
    protected $filename;

    public function __construct($modelClass)
    {
        $this->modelClass = $modelClass;

    }

    protected function collection()
    {
        $modelClass = $this->modelClass;
        return $modelClass::all();
    }

    protected function headings()
    {
        return [];
    }

    protected function row($collectionItem)
    {
        return $collectionItem->toArray();
    }

    protected function filename()
    {
        if (empty($this->filename)) {
            $shortClassName   = explode("\\", $this->modelClass);
            $shortClassName   = end($shortClassName);
            return Str::slug($shortClassName) . '.csv';
        }

        return $this->filename;
    }

    public function download()
    {
        $collection = $this->collection();
        return response()->streamDownload(function () use ($collection) {
            $handle = fopen('php://output', 'w');

            if (!empty($this->headings())) {
                fputcsv($handle, $this->headings());
                flush();
            }

            foreach ($collection as $key => $item) {
                $row = $this->row($item);
                fputcsv($handle, $row);
                flush();
                $collection->forget($key);
            }

            fclose($handle);
        }, $this->filename());
    }
}
