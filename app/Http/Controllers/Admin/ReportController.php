<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Reports');
    }


    public function index()
    {
        $reports = Report::latest()->get();
        return view('dashboard.reports.index', compact('reports'));
    }


    public function destroy(Report $report)
    {
        $report->delete();
        return 'Done';
    }

    public function solve($id)
    {
        $report = Report::findOrFail($id);
        $report->update(['is_resolved'=>!$report->is_resolved]);
        return redirect(route('admin.reports.index'))->with('success', 'تم التعديل بنجاح');
    }
}
