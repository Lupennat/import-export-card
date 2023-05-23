import ExportCard from './components/ExportCard';
import ImportCard from './components/ImportCard';
import DownloadSampleCard from './components/DownloadSampleCard';

Nova.booting((app, store) => {
    app.component('export-card', ExportCard);
    app.component('import-card', ImportCard);
    app.component('download-import-sample-card', DownloadSampleCard);
});
