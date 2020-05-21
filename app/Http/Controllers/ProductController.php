<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Product;
use App\Category;
use App\Product_multiple_photo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Image;

class ProductController extends Controller
{
      public function __construct(){
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('verified')->except(['index', 'show']);
        $this->middleware('checkrole');

      }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      return view('cit.product.index', [
        'categories' => Category::all(),
        'products' => Product::all()
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $slug = Str::slug($request->product_name.'-'.Carbon::now()->timestamp);
        $product_id = Product::insertGetId([
          'category_id' =>$request->category_id,
          'product_name' =>$request->product_name,
          'product_price' =>$request->product_price,
          'product_short_description' =>$request->product_short_description,
          'product_long_description' =>$request->product_long_description,

          'product_slug' => $slug,
          'quantity' => $request->quantity,
          'created_at' =>Carbon::now()
        ]);
        // photo upload start
        $uploaded_product_img = $request->file('product_thumbnail_photo');
        $new_product_img_name = $product_id.".".$uploaded_product_img->extension();
        $new_product_location = base_path('public/uploads/product_thumbnail/'.$new_product_img_name);
        Image::make($uploaded_product_img)->resize(600, 622)->save($new_product_location);


        Product::find($product_id)->update([
          'product_thumbnail_photo' => $new_product_img_name
        ]);

        $all_image = $request->file('product_multiple_photo');
        $flag = 1;
        foreach ($all_image as $single_image) {
          // photo upload code one by one start

          $new_product_img_name = $product_id."-".$flag.".".$single_image->extension();
          $new_product_location = base_path('public/uploads/product_multiple/'.$new_product_img_name);
          Image::make($single_image)->resize(600, 550)->save($new_product_location);
          // photo upload code one by one end
          Product_multiple_photo::insert([
            'product_id' => $product_id,
            'multiple_photo_name' => $new_product_img_name,
            'created_at' => Carbon::now()
          ]);
          $flag++;
        }
        return back();
        // $return_after_create->product_thumbnail_photo = $new_product_img_name;
        // $return_after_create->save();
        // photo upload end
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
      $product_info = Product::where('product_slug', $slug)->first();
      $related_products = Product::where('category_id', $product_info->category_id)->where('id', '!=', $product_info->id)->limit(3)->get();

        return view('cit.frontend.single_product_page', compact('product_info', 'related_products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
