<?php

namespace App\Http\Controllers\manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Table;


class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = Table::all();
        return view('manage/table.index')->with('tables', $tables);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage/table.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:tables',
            'status' => 'required|in:Available,Unavailable'
        ]);

        $table = new Table();
        $table->name = $request->input('name');
        $table->status = $request->input('status');
        if ($table->save()) {
            Session()->flash('status', "Table is Added!");
        }
        return (redirect('manage/table'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $table = Table::find($id);
        return view('manage/table.create')->with('table',$table);
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
        $request->validate([
            'name' => 'required',
            'status' => 'required|in:Available,Unavailable'
        ]);

        $table = Table::find($id);
        $table->name = $request->input('name');
        $table->status = $request->input('status');
        if ($table->save()) {
            Session()->flash('status', "Table is Updated!");
        }
        return (redirect('manage/table'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Table::destroy($id)) {
            Session()->flash('status', "Table is Deleted!");
        } else {
            Session()->flash('status', "Something went wrong,try again later");
        }
        return (redirect('/manage/table'));
    }
}
