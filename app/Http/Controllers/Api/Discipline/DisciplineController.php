<?php

namespace App\Http\Controllers\Api\Discipline;

use App\Exports\DisciplinesExport;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Discipline\DisciplineResource;
use App\Http\Resources\Api\User\Teacher\TeacherResource;
use App\Imports\DisciplinesImport;
use App\Models\Discipline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class DisciplineController extends Controller
{
    /**
     * Получение всех дисциплин
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return DisciplineResource::collection(Discipline::get());
    }

    /**
     * Получение дисциплины по secondId
     *
     * @param $disciplineSecondId
     * @return DisciplineResource
     */
    public function show($disciplineSecondId)
    {
        return DisciplineResource::make(Discipline::where('second_id', $disciplineSecondId)->firstOrFail());
    }

    /**
     * Экпорт в pdf формат
     *
     * @return mixed
     */
    public function exportPdf(Request $request)
    {
        $pdf = \PDF::loadView('pdf.discipline');
        $content = $pdf->download()->getOriginalContent();
        Storage::put(public_path() . '/pdf/discipline.pdf', $content);

        $file = public_path() . "/storage/pdf/discipline.pdf";

        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return response()->download($file, 'test.pdf', $headers);
    }

    /**
     * Экпрорт в excel формат
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportExcel(Request $request)
    {
        return Excel::download(new DisciplinesExport, 'disciplines.xlsx');
    }

    /**
     * Получаем преподавателей дисциплины
     *
     * @param $disciplineSecondId
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function teachers($disciplineSecondId)
    {
        $discipline = Discipline::where('second_id', $disciplineSecondId)->firstOrFail();

        return TeacherResource::collection($discipline->teachers);
    }

    /**
     * @return Discipline[]|\Illuminate\Database\Eloquent\Collection
     */
    public function importExcel()
    {
        Excel::import(new DisciplinesImport(), 'disciplines.xlsx');

        return Discipline::all();
    }
}
