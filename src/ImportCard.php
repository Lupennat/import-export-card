<?php

namespace Lupennat\ImportExportCard;

use Laravel\Nova\Card;
use Laravel\Nova\Fields\File;

class ImportCard extends Card
{
    /**
     * The element's component.
     *
     * @var string
     */
    public $component = 'import-card';

    public function __construct($resource)
    {
        parent::__construct();
        $this->withMeta([
            'fields' => [
                new File('File'),
            ],
            'resourceLabel' => $resource::label(),
            'resource' => $resource::uriKey(),
        ]);
    }

}
