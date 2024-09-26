<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use League\Csv\Reader;
use League\Csv\Writer;


class PredictController extends Controller
{
    public function uploadCsv(Request $request)
    {

        $file = $request->file('csv_file');

        $fileName = 'csv_file_' . time() . '.' . $file->getClientOriginalExtension();

        Storage::put('uploads/' . $fileName, file_get_contents($file->getRealPath()));

        $filePath = storage_path('app/private/uploads/' . $fileName);


        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setHeaderOffset(0);

        $columns = $csv->getHeader();

        return view('select-columns', [
            'fileName' => $fileName,
            'columns' => $columns
        ]);
    }

    public function sendCsv(Request $request)
    {
        try {
            $n_clusters = $request->input('n_clusters');
            $normalize = $request->input('normalize');
            $session_id = $request->input('session_id');
            $columnsToDrop = $request->input('columns_to_drop', []);

            // Obtener el nombre del archivo guardado en el paso anterior
            $fileName = $request->input('file_name');
            $filePath = storage_path('app/private/uploads/' . $fileName);

            $csv = Reader::createFromPath($filePath, 'r');
            $csv->setHeaderOffset(0);

            $header = $csv->getHeader();
            $records = $csv->getRecords();

            if (!empty($columnsToDrop)) {
                $header = array_diff($header, $columnsToDrop);
            }

            $newCsvFileName = 'csv_file_' . Str::random(10) . '.csv';
            $newCsvPath = storage_path('app/private/uploads/' . $newCsvFileName);

            $csvWriter = Writer::createFromPath($newCsvPath, 'w+');
            $csvWriter->insertOne($header);

            foreach ($records as $record) {
                $filteredRecord = array_filter($record, function ($value, $key) use ($header) {
                    return in_array($key, $header);
                }, ARRAY_FILTER_USE_BOTH);
                $csvWriter->insertOne($filteredRecord);
            }

            $response = Http::timeout(120)
                ->attach('csv_file', file_get_contents($newCsvPath), $newCsvFileName)
                ->post('http://127.0.0.1:8001/api/clustering/create-pycaret-clusters', [
                    'n_clusters' => $n_clusters,
                    'normalize' => $normalize,
                    'session_id' => $session_id,
                ]);

            Storage::delete($newCsvPath . $newCsvFileName);

            if ($response->successful()) {
                $json = json_decode($response->body(), true);
                return view('response', [
                    'elbow_plot_base64' => $json['elbow_plot'],
                    'silhouette_plot_base64' => $json['silhouette_plot'],
                    'setup_table' => $json['setup_table'],
                ]);
            } else {
                return response()->json(['error' => 'API error'], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Critical error ' . $e->getMessage()]);
        }
    }
}
