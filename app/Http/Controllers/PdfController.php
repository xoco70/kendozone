<?php

namespace App\Http\Controllers;

use App\Championship;
use App\Grade;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class PdfController extends Controller
{
    public function index(Request $request)
    {
        // Get all data
        $championship = Championship::with('tree','settings')->find($request->championship);
        $grades = Grade::pluck('name', 'id');
        // Get Tree Type
//        if ($championship->hasPreliminary()) {
//            $layout = 'pdf.tree';
//        } else if ($championship->isDirectEliminationType()) {
//            $layout = 'pdf.tree';
//        } else if ($championship->isRoundRobinType()) {
//            $layout = 'pdf.tree';
//        }
        // Generate PDF
        return view ('pdf.tree', compact('championship','grades'));
//        $pdf = PDF::loadView('pdf.tree', ['championship' => $championship]);
//        return $pdf->download('tree.pdf');

    }

    public function tree(Request $request)
    {
        // Get all data
        $championship = Championship::with('tree','settings')->find($request->championship);

        // Get Tree Type
        if ($championship->hasPreliminary()) {
            $layout = 'pdf.tree';
        } else if ($championship->isDirectEliminationType()) {
            $layout = 'pdf.tree';
        } else if ($championship->isRoundRobinType()) {
            $layout = 'pdf.tree';
        }
        // Generate PDF

        $pdf = PDF::loadView('pdf.tree', ['championship' => $championship]);
        return $pdf->download('tree.pdf');

    }

}
