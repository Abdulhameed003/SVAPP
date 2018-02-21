<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
                'industry'=>'sometimes|required'];

        $this->validate($request,$rule);
        try{
            if($request->has('product_name')){
                $product = new Product();
                $product->product_name = $request->product_name;
                $product->save();
                return $product;
            }
            if($request->has('industry')){
                $industry = new Industry();
                $industry->industry = $request->industry;
                $industry->save();
                return $industry;
            }
            
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
            'old_password'=> 'required',
            'password'=>'required|confirmed'
        ]);
        $user = User::find($request->id);
        
        if(Hash::check($request->old_password,$user->password)){
            $user->password = bcrypt($request->password);
            $user->save();
            return 'success';
        }
        return 'failed';
        
    }

    
}
