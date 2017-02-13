<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Crypt,
Validator,
Redirect,
DB,
Session,
Mail,URL;

class ProductController extends Controller
{
    public function index(Request $request){
    	$name = $request->get('name');
        if($name){
          $products= Product::where("name", "LIKE", "%{$request->get('name')}%")->paginate(2);
        }else{
         $products=Product::paginate(2);

        }
    	return view('product.index',['products'=>$products]);
    }

    public function create(){
    	return view('product.product');
    }

    public function store(Request $req) {
    	$rules = array(
			'name' => 'required',	
			'details'=>'required'
			);

		$validator = Validator::make($req->all(), $rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		else {
	
			 
			if ($req->get('id') == "") {
				 $product = new Product($req->all());
                   $product->save();
                   }
              else{
              	$id=$req->get('id');
                  Product::find($id)->update($req->all());

                   }
			return redirect('/product');
		}
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('product.product',['product'=>$product]);
    }

    public function delete($id) {
    	$data=Product::find($id)->delete();
  	
  	return redirect::back();
    }

    
}
