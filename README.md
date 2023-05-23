1. [Requirements](#Requirements)
2. [Installation](#Installation)
3. [Usage](#Usage)
4. [Customization](#customization)


## Requirements

- `php: ^7.4 | ^8`
- `laravel/nova: ^4`

## Installation

```
composer require lupennat/import-export-card
```

## Usage

Next up, you must register the card(s). This is typically done in the card method of the corresponding resource or the NovaServiceProvider.

```php
// in  app/Nova/<Resource>.php

    public function cards(NovaRequest $request)
    {
        return [
            new \Lupennat\ImportExportCard\ImportCard(self::class),
            (new \Lupennat\ImportExportCard\DownloadImportSampleCard(asset('import-samples/file.csv')))
                ->withHelp('By importing you will insert a new row or update duplicate entries.'),
            new \Lupennat\ImportExportCard\ExportCard(self::class),
        ];
    }
```

## Customization

To customize the import/export process create a new importer/exporter class. The importer class is basically just an [import implementation of the laravel-excel package](https://docs.laravel-excel.com/3.1/imports/). The exporter class is basically just an [export implementation of the laravel-excel package](https://docs.laravel-excel.com/3.1/exports/).
The easiest way to get started is to extend `Lupennat\ImportExportCard\BasicImporter` or `Lupennat\ImportExportCard\BasicExporter` and overwrite the different methods. During the import process you may throw an exception of the type `Lupennat\ImportExportCard\ImportException` with an error message visible for the user. You may also add a `message(): String` method to customize the success message.

The custom importer/exporter classes can be registered on global or resource basis.

```php
// app/Nova/User.php

class User extends Resource
{

    public static $importer = CustomImporter::class;

    public static $exporter = CustomExporter::class;

    // ...
}
```

---

# Credits

ImportExport Card is based on original [Nova Import Card](https://github.com/Sparclex/nova-import-card).
