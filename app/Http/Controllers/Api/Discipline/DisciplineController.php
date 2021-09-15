<?php

namespace App\Http\Controllers\Api\Discipline;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Discipline\DisciplineResource;
use App\Models\Discipline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DisciplineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DisciplineResource::collection(Discipline::get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return DisciplineResource::make(Discipline::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Export in pdf
     *
     * @return mixed
     * TODO change to form request + export
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
}
