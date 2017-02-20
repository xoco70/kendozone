<?php

namespace App\Http\Controllers;

use App\Championship;
use App\Grade;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function tree(Request $request)
    {
        $layout ='pdf.preliminary_tree';
        // Get all data
        $championship = Championship::with('rounds','settings','category')->find($request->championship);
        $grades = Grade::getAllPlucked();
        // Get Tree Type
        if ($championship->hasPreliminary()) {
            $layout = 'pdf.preliminary_tree';
        } else if ($championship->isDirectEliminationType()) {
            $layout = 'pdf.direct_elimination_tree';
        } else if ($championship->isRoundRobinType()) {
            $layout = 'pdf.round_robin_tree';
        }
        // Generate PDF
        $file = 'tree-'.$championship->buildName();
        $file = sanitize($file).'.pdf';

        $pdf = PDF::loadView($layout, ['championship' => $championship, 'grades' => $grades]);
        return $pdf->inline($file);

    }

}
