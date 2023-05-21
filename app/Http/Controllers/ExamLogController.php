<?php

namespace App\Http\Controllers;

use App\Models\ExamLog;
use App\Http\Requests\StoreExamLogRequest;
use App\Http\Requests\UpdateExamLogRequest;

class ExamLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExamLogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExamLogRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExamLog  $examLog
     * @return \Illuminate\Http\Response
     */
    public function show(ExamLog $examLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExamLog  $examLog
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamLog $examLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExamLogRequest  $request
     * @param  \App\Models\ExamLog  $examLog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExamLogRequest $request, ExamLog $examLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExamLog  $examLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamLog $examLog)
    {
        //
    }
}
