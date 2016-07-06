<?php

namespace App\Http\Controllers;

use DB;
use Request;
use Response;
use App\Http\Requests\StoreFormPostRequest;
use App\Http\Requests\StoreFormRegisterRequest;
use App\Http\Controllers\Controller;
use Input;
use Carbon\Carbon as Carbon;

// Cac model su dung
use App\Category;
use App\Service;
use App\Subcategory;
use App\Post;
use App\Slideshow;
use App\Slideshowtfe;
use App\Customer;
use App\Tfe;
use App\Posttfe;
use App\Register;


class ServicesController extends Controller
{

    public function ServiceIndex() 
    {

        $service = Service::all()->toArray();
        $tfe     = Tfe::all()->take(3)->toArray();
        foreach($service as $key => $value) {
            $service[$key]['category'] = Service::find($value['id'])->Categories()->get()->take(3)->toArray();
            foreach ($service[$key]['category'] as $k => $v) {
                $service[$key]['category'][$k]['subcategory'] = Category::find($v['id'])->Subcategorys()->first()->toArray();
            }         
        }
        return view('service.index')->with([
            'service' => $service,
            'tfe'     => $tfe
        ]);

    }

	public function TradeIndex()
	{

		$result = Tfe::paginate(6);

		return view('service.trade.index')->with('result',$result);

	}

	public function TradeShow($post)
    {

        $result = Tfe::where('slug', $post)->firstOrFail()->toArray();
        $result['post'] = Tfe::find($result['id'])->Post()->first()->toArray();
        $result['slide'] = Posttfe::find($result['post']['id'])->Slideshows()->get()->toArray();
        if($result['end'] >= Carbon::now()->toDateString())
            $active = 0;
        else
            $active = 1;
    	$related = Tfe::where('id', '<>', $result['id'])->get()->shuffle()->take(4)->toArray();
    	return view('service.trade.show')->with([
                'related' => $related,
                'result'  => $result,
                'active'  => $active
    		]);
    }

    public function Register(StoreFormRegisterRequest $request)
    {

            if($request->ajax()){
                $store = new Register;
                $store->post    = $request->post;
                $store->name    = $request->name;
                $store->email   = $request->email;
                $store->phone   = $request->phone;
                $store->address = $request->address;
                $store->company = $request->company;
                $store->save();
    
                return response()->json([
                    'messenger' => 'Cảm ơn bạn đã quan tâm đến công ty chúng tôi. Chúng tôi sẽ sớm liên lạc với bạn.'
                ]);
            }

    }

    public function ServiceStore(StoreFormPostRequest $request)
    {
        
        if(Request::ajax()){
            $form = new Customer;
            $form->location   = $request->category;
            $form->name       = $request->name;
            $form->email      = $request->email;
            $form->phone      = $request->phone;
            $form->company    = $request->company;
            $form->address    = $request->address;
            $form->title      = $request->title;
            $form->content    = $request->content;
            $form->save();
            return response()->json([
                'messenger' => 'Cám ơn bạn đã quan tâm đến công ty chúng tôi. Chúng tôi sẽ sớm liên lạc lại với bạn.'
            ]);
        }
    }

    public function ServiceService($service)
    {
        $namecategory = Service::where('slug', $service)->firstOrFail()->toArray();
        $category     = Service::find($namecategory['id'])->Categories()->paginate(3);
        foreach($category as $value) {
            $value->subcategory = Category::find($value['id'])->Subcategorys()->get()->take(3);
        }
        return view('service.service')->with([
            'categorys'    => $category,
            'namecategory' => $namecategory
        ]);
    }

    public function ServiceCategory($service, $category)
    {
        $name   = Service::where('slug', $service)->firstOrFail();
        $result = Service::find($name['id'])->Categories()->where('slug', $category)->firstOrFail();
        $result->subcategory = Category::find($result->id)->Subcategorys()->paginate(3);
        foreach($result->subcategory as $value) {
            $value->post = Subcategory::find($value->id)->Posts()->get()->take(3);
        }
        return view('service.category')->with([
            'result' => $result,
            'name'   => $name
        ]);
    }

    public function ServiceSubcategory($service, $category, $subcategory)
    {
        
        $name           = Service::where('slug', $service)->firstOrFail();
        $name->category = Service::find($name->id)->Categories()->where('slug', $category)->firstOrFail();
        $result         = Category::find($name->category->id)->Subcategorys()->where('slug', $subcategory)->firstOrFail();
        $result->post   = Subcategory::find($result->id)->Posts()->paginate(12);
        return view('service.subcategory')->with([
            'name'   => $name,
            'result' => $result
        ]);
       
    }

    public function ServiceShow($service ,$category, $subcategory, $post)
    {

        $name = Service::where('slug', $service)->firstOrFail();
        $name->category = $name->Categories()->where('slug', $category)->firstOrFail();
        $name->category->subcategory = Category::find($name->category->id)->Subcategorys()->where('slug', $subcategory)->firstOrFail();
        $result = Subcategory::find($name->category->subcategory->id)->Posts()->where('slug', $post)->firstOrFail();
        $related = Subcategory::find($name->category->subcategory->id)->Posts()->get()->shuffle()->take(4);
        $slide = Post::find($result->id)->Slideshows()->get();

        return view('service.show')->with([
            'name'      => $name,
            'result'    => $result,
            'related'   => $related,
            'slideshow' => $slide
        ]);
       
    }

}
