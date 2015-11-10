<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShiaiCategoryRequest;
use App\ShiaiCategory;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Webpatser\Countries\Countries;

class ShiaiCategoryController extends Controller
{
    protected $currentModelName;

    public function __construct()
    {
//        $this->middleware('auth');
        // Fetch the Site Settings object
        $this->currentModelName = Lang::get('crud.shiaiCategory');
        View::share('currentModelName', $this->currentModelName);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shiaiCategories = DB::table('shiaiCategory')
            ->leftJoin('countries', 'shiaiCategory.countryId', '=', 'countries.id')
            ->select('shiaiCategory.*','countries.name as country')
            ->get(); //
        return view('shiaiCategories.index', compact('shiaiCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shiaiCategory=new ShiaiCategory();
        $countries = Countries::lists('name', 'id');
        return view('shiaiCategories.create', compact('shiaiCategory','countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShiaiCategoryRequest $request)
    {
        $shiaiCategory = $request->all();
        if (ShiaiCategory::create($shiaiCategory))
            Session::flash('flash_message', 'Operación Exitosa!');
        else
            Session::flash('flash_message', 'Operación No realizada!');
        return redirect('shiaiCategories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shiaiCategory = ShiaiCategory::findOrFail($id);
        return view('shiaiCategories.show', compact('shiaiCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shiaiCategory = ShiaiCategory::findOrFail($id);
        $countries = Countries::lists('name', 'id');

        return view('shiaiCategories.edit', compact('shiaiCategory','countries'));
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
        $shiaiCategory = ShiaiCategory::findOrFail($id);
        $shiaiCategory->update($request->all());
        return redirect("shiaiCategories");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shiaiCategory = ShiaiCategory::findOrFail($id);
        $shiaiCategory->delete();
        return redirect("shiaiCategories");
    }
}
