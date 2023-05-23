<?php

namespace Lupennat\ImportExportCard;

use Laravel\Nova\Card;

class DownloadImportSampleCard extends Card
{
    /**
     * The element's component.
     *
     * @var string
     */
    public $component = 'download-import-sample-card';

    public function __construct($filename)
    {
        parent::__construct();
        $this->withMeta([
            'filename' => $filename,
        ]);
    }

    public function withHelp($helpText)
    {
        return $this->withMeta([
            'helpText' => $helpText
        ]);
    }
}
