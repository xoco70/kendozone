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
        $layout = 'pdf.preliminary_tree';
        // Get all data
        $championship = Championship::with('fightersGroups', 'settings', 'category')->find($request->championship);
        $grades = Grade::getAllPlucked();
        // Get Tree Type
        if ($championship->hasPreliminary()) {
            $layout = 'pdf.preliminary_tree';
        } else if ($championship->isSingleEliminationType()) {
            $layout = 'pdf.direct_elimination_tree';
        } else if ($championship->isPlayOffType()) {
            $layout = 'pdf.round_robin_tree';
        }
//        return view($layout, compact('championship'));

        // Generate PDF
        $file = 'tree-' . $championship->buildName();
        $file = sanitize($file) . '.pdf';

        $pdf = PDF::loadView($layout, ['championship' => $championship]);
        return $pdf->inline($file);

    }


    public function scoreSheets(Request $request)
    {
        $layout = 'pdf.scoresheets.sheet';
        // Get all data
        $championship = Championship::with('fightersGroups.championship.category',
            'settings',
            'category',
            'fightersGroups.championship.category', // TODO This is not good
            'fightersGroups.teams',
            'fightersGroups.competitors',
            'fightersGroups.fights.group.championship.category', // TODO This is not good
            'fightersGroups.fights.competitor1',
            'fightersGroups.fights.competitor2',
            'fightersGroups.fights.team1',
            'fightersGroups.fights.team2'
        )->find($request->championship);



        $tournament = $championship->tournament;

        // Generate PDF
        $file = 'scoreSheet-' . $championship->buildName();
        $file = sanitize($file) . '.pdf';

//                return view($layout, compact('championship','tournament'));
        $pdf = PDF::loadView($layout, ['championship' => $championship, 'tournament' => $tournament]);
        return $pdf->inline($file);

    }

}
