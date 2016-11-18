<?php

namespace App\Http\Controllers;

use App\Exceptions\TreeGenerationException;
use App\Grade;
use App\PreliminaryTree;
use App\Tree;
use Illuminate\Http\Request;

class TreeController extends Controller
{
    /**
     * Display a listing of trees.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $grades = Grade::pluck('name', 'id');
        $tournament = PreliminaryTree::getTournament($request);
        return view('trees.index', compact('tournament', 'grades', 'numCompetitors', 'numTeams', 'settingSize', 'categorySize'));
    }

    /**
     * Build Tree
     *
     * @param Request $request
     * @return \Illuminate\Http\Response|string
     */
    public function store(Request $request)
    {

        $grades = Grade::pluck('name', 'id');
        $tournament = PreliminaryTree::getTournament($request);
        foreach ($tournament->championships as $championship) {
            if (!$championship->isRoundRobinType()) {
                $generation = Tree::getGenerationStrategy($championship);
                $generation->championship = $championship;
                try {
                    $tree = $generation->run();
                    $championship->tree = $tree;
                    flash()->success(trans('msg.championships_tree_generation_success'));
                } catch (TreeGenerationException $e) {
                    flash()->error($e->message);
                } finally {
                    return redirect(route('indexTree', $tournament->slug));
                }
            }
        }
        return redirect(route('indexTree', $tournament->slug));
    }
}
