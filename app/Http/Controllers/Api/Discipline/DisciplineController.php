<?php

namespace App\Http\Controllers\Api\Discipline;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Discipline\DisciplineResource;
use App\Http\Resources\Api\User\Teacher\TeacherResource;
use App\Models\Discipline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
}
