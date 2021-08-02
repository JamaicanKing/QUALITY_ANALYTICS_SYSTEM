<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = Attribute::all();

        foreach ($attributes as $key => $attribute) {
            $attributes[$key]->category_name = Category::find($attribute->category_id)->name;
        };

        return view('attribute.index',['attributes' => $attributes]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all(['id','name']);

        return view('attribute.create',['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attribute = Attribute::create([
            'attribute' => $request->input('attribute'),
            'weightage' => $request->input('weightage'),
            'category_id' => $request->input('category_name'),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        return redirect()->route("attribute.index");
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
    public function edit(Request $request, $id)
    {
        $attribute = Attribute::find($id);
        $category = Category::all(['id','name']);
        $category_id = $request->input('categoryId');
        
        return view('attribute.edit',
        [
            'attribute' => $attribute,
            'category' => $category,
            'category_id' => $category_id,
        ]);
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
        $attribute = Attribute::find($id);
        $attribute->attribute = $request->input('attribute');
        $attribute->weightage = $request->input('weightage');
        $attribute->category_id = $request->input('category_name');

        $attribute->save();

        return redirect()->route('attribute.index');
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
}
