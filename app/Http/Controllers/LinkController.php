<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Link;

class LinkController extends Controller
{

    /**
    * Return view shorten.
    *
    * @return void
    */
    public function index()
    {
        return view('shortener.index');
    }
    /**
    * Make shorterner link .
    *
    * @return void
    */
    public function make(Request $request)
    {
        
        $this->validate($request, [
            'url'   => 'required|url'
         ]);

         $url = $request->url;
         $code = null;
         $exists = Link::where('url', $url)->first();


         if($exists){

            $code = $exists->first()->code;
            return redirect('link')->with('global', 'Done!! <a href="' . route('get', $code) . '" target="_blank" >Click Here !!</a>');

         }else{

            $created = Link::create([
                'url' => $url
            ]);

            if($created){

                $code = base_convert($created->id, 10, 36);

                Link::where('id', $created->id)->update([
                    'code' => $code
                ]);

            }

            if($code){
                return redirect('link')->with('global', 'Done!! <a href="' . route('get', $code) . '" target="_blank" >Click Here !!</a>');
            }


        }

        return redirect('link')->with('global', 'wrong please try again!!');

    }
    /**
    * redirect to link
    *
    * @return void
    */
    public function get($code)
    {

        $link = Link::where('code', $code);

        if($link->count() === 1){

            return redirect($link->first()->url);
        }
        return redirect('home');
    }
}
