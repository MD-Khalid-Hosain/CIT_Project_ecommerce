<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Image;


class CategoryController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('verified');
      $this->middleware('checkrolecustomer');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $category_lists = Category::all();
        return view('cit.category.category', compact('category_lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        'category_name'=> 'required|unique:categories,category_name|string'
      ]);
        $return_after_create = Category::create([
          'category_name'=>$request->category_name,
          'added_by'=>Auth::id(),
          'created_at'=> Carbon::now()
        ]);
        //upload photo
        if($request->hasFile('category_photo')){
        $uploaded_category_img = $request->file('category_photo');
        $new_category_img_name = $return_after_create->id.".".$uploaded_category_img->extension();
        $new_category_location = base_path('public/uploads/category/'.$new_category_img_name);
        Image::make($uploaded_category_img)->resize(600, 470)->insert(public_path('uploads/category/khalid.png'), 'bottom-left', 20,20)->save($new_category_location);

        /*==after upload photo update database new photo name==*/
        // Category::find($return_after_create->id)->update([
        //   'category_photo'=>$new_category_img_name
        // ]);
        /*==short code for update==*/
        $return_after_create->category_photo = $new_category_img_name;
        $return_after_create->save();
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
      //route model binding
      return view('cit.category.edit_category', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
      //if we have file or not
        if($request->hasFile('category_photo')){
          //is your old photo default photo or not
           if($category->category_photo != 'default_photo.jpg'){
             //delete the old photo
            $location = base_path()."/public/uploads/category/".$category->category_photo;
            unlink($location);
           }
           $uploaded_category_img = $request->file('category_photo');
           $new_category_img_name = $category->id.".".$uploaded_category_img->extension();
           $new_category_location = base_path('public/uploads/category/'.$new_category_img_name);
           Image::make($uploaded_category_img)->resize(600, 470)->insert(public_path('uploads/category/khalid.png'), 'bottom-left', 20,20)->save($new_category_location);
           $category->category_photo = $new_category_img_name;

        }
        $category->category_name = $request->category_name;
        $category->save();

        return redirect('category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
      $category->delete();
        return back();
    }
}
