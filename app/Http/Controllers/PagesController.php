<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\About;
use App\Service;
use App\Category;
use App\Subcategory;
use App\Tfe;

class PagesController extends Controller
{
    public function index()
    {
        
        $about   = About::first()->toArray();
        $service = Service::all()->toArray();
        $tfe     = Tfe::all()->take(3)->toArray();
        foreach($service as $key => $value) {
            $service[$key]['category'] = Service::find($value['id'])->Categories()->get()->take(3)->toArray();
            foreach ($service[$key]['category'] as $k => $v) {
                $service[$key]['category'][$k]['subcategory'] = Category::find($v['id'])->Subcategorys()->first()->toArray();
            }         
        }
        return view('pages.home')->with([
            'about'   => $about,
            'service' => $service,
            'tfe'     => $tfe
        ]);

    }

    public function about()
    {
        $about = About::first();
        return view('pages.about', [
        	'about' => $about
        ]);
    }
}
