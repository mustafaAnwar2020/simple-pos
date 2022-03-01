<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class CategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:category-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $categories = category::when($request->search,function($q) use ($request){
            return $q->whereTranslationLike('name','%' . $request->search . '%');
        })->latest()->paginate(5);
        return view('dashboard.category.index')->with('categories',$categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.category.create');
    }


    public function store(Request $request)
    {


        $rules=[];


        foreach (config('translatable.locales') as $locale){

            $rules+=[$locale.'.name'=>['required',Rule::unique('category_translations','name')]];
        }
dd($request);

        $this->validate($request,$rules);
        $category = category::create($request->all());
        return redirect()->route('dashboard.category.index');
    }


    public function show(category $category)
    {
        return view('dashboard.category.show')->with('category',$category);
    }


    public function edit(category $category)
    {
        return view('dashboard.category.edit')->with('category',$category);
    }

    public function update(Request $request, category $category)
    {
        $rules=[];


        foreach (config('translatable.locales') as $locale){

            $rules+=[$locale.'.name'=>['required',Rule::unique('category_translations','name')->ignore($category->id,'category_id')]];
        }


        $this->validate($request,$rules);
        // dd($request);
        $category->update($request->all());
        return redirect()->route('dashboard.category.index');
    }


    public function destroy(category $category)
    {
        $category->delete($category->id);
        return redirect()->route('dashboard.category.index');
    }
}
