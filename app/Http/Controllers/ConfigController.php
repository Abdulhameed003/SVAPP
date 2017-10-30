<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Industry;
use App\Product;

class ConfigController extends Controller
{
    public function show(){
        $industry = Industry::orderBy('name','asc')->get();
        $product = Product::orderBy('product_name','asc')->get();

        return response()->json(['industry'=>$industry,'product'=>$product]);
    }
    /**
     * stores a product into the system
     * @param  \Illuminate\Http\Request $request
     * @Return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule= ['product_name'=>'sometimes|required',
                'industry_name'=>'sometimes|required'];

        $this->validate($request,$rule);

        if($request->exist('product_name')){
            $product = new Product();
            $product->product_name = $request->product_name;
            $product->save();
        }
        if($request->exist('industry_name')){
            $industry = new Industry();
            $industry->name = $request->industry_name;
            $industry->save();
        }

        return redirect()->back();
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        
        return redirect()->back();

    }

    public function deleteIndustry($id)
    {
        $industry = Industry::find($id);
        $industry->delete();
        
        return redirect()->back();

    }
 
}
