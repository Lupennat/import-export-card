<?php

namespace Lupennat\ImportExportCard;

use Laravel\Nova\Card;

class ExportCard extends Card
{
    /**
     * The element's component.
     *
     * @var string
     */
    public $component = 'export-card';

    public function __construct($resource)
    {
        parent::__construct();
        $this->withMeta([
            'resourceLabel' => $resource::label(),
            'resource' => $resource::uriKey(),
        ]);
    }


}
