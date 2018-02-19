<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Industry;
use App\Product;
use App\User;

class ConfigController extends Controller
{
    public function show(){
        $industry = Industry::orderBy('industry','asc')->get();
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
        try{
            if($request->has('product')){
                $product = new Product();
                $product->product_name = $request->product;
                $product->save();
            }
            if($request->has('industry')){
                $industry = new Industry();
                $industry->industry = $request->industry;
                $industry->save();
            }
            return 'success';
        }catch(Exception $e){
            return 'failed';
        }
        

       
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        
        return 'success';

    }

    public function deleteIndustry($id)
    {
        $industry = Industry::find($id);
        $industry->delete();
        return 'success';

    }

    /**
     * This method changes the password of a user when requested from the users settings
     */

    public function changePassword(Request $request){
        $this->validate($request,[
            'oldpassword'=> 'required',
            'password'=>'required|confirmed'
        ]);
        $user = User::find($requst->id);
        if(bcrypt($request->oldpassword) !== $user->password){
           return 'failed';
        }
       
        $user->password = bcrypt($request->password);
        $user->save();
        return 'success';


    }

    
}
