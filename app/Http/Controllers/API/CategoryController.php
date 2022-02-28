<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\category;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index(){
        $category= category::withTranslation()->get();
        // dd($category->getTranslationsArray());
        return $this->sendResponse(CategoryResource::collection($category),'All data is here!');
    }

    public function show(category $category){
        $newcategory = category::withTranslation()->where('categories.id',$category->id)->get();
        // dd($newcategory);
        return $this->sendResponse(CategoryResource::collection($newcategory),'Category is ready!');
    }

    public function store(Request $request){
        $input = $request->all();


        $rule=['name'=>['required',Rule::unique('category_translations','name')]];

        $validator = Validator::make($input,$rule);
        if ($validator->fails()) {
            return $this->sendError('Validation error' , $validator->errors());
        }
        $category = category::create([]);
        DB::table('category_translations')->insert(array(
            'category_id'=>$category->id,
            'name'=>$request->name,
            'locale'=>$request->locale,
        ));
        $this->addEn($category,$request);
        return $this->sendResponse(new CategoryResource($category),'Category created successfully!');
    }

    private function addEn($category,$request){
        DB::table('category_translations')->insert(array(
            'category_id'=>$category->id,
            'name'=>$request->enname,
            'locale'=>$request->en,
        ));
    }
    private function updateEn($category,$request){
        DB::table('category_translations')->where('locale','en')->where('category_id',$category->id)->update(array(
            'name'=>$request->enname,
        ));
    }

    public function update(Request $request,category $category)
    {
        $input = $request->all();


        $rule=['name'=>['required',Rule::unique('category_translations','name')]];

        $validator = Validator::make($input,$rule);
        if ($validator->fails()) {
            return $this->sendError('Validation error' , $validator->errors());
        }
        $category->update([]);
        DB::table('category_translations')->where('category_id',$category->id)->update(array(
            'name'=>$request->name,
        ));
        $this->updateEn($category,$request);
        return $this->sendResponse(new CategoryResource($category),'Category updated successfully!');
    }

    public function destroy(category $category){
        $category->delete($category->id);
        return $this->sendResponse(new CategoryResource($category),'Category deleted successfully!');
    }
}
