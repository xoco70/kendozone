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
        $championship = Championship::with('tree','settings','category')->find($request->championship);
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
//        return view ($layout, compact('championship','grades'));
        $file = 'tree-'.$championship->category->buildName();
        $file = sanitize($file).'.pdf';

        $pdf = PDF::loadView($layout, ['championship' => $championship, 'grades' => $grades]);
        return $pdf->inline($file);

    }

//    public function tree(Request $request)
//    {
//        // Get all data
//        $championship = Championship::with('tree','settings')->find($request->championship);
//
//        // Get Tree Type
//        if ($championship->hasPreliminary()) {
//            $layout = 'pdf.tree';
//        } else if ($championship->isDirectEliminationType()) {
//            $layout = 'pdf.tree';
//        } else if ($championship->isRoundRobinType()) {
//            $layout = 'pdf.tree';
//        }
//        // Generate PDF
//
//        $pdf = PDF::loadView('pdf.tree', ['championship' => $championship]);
//        return $pdf->download('tree.pdf');
//
//    }

}
