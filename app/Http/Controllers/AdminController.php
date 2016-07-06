<?php
namespace App\Http\Controllers;

use App\Customer;
use App\Tfe;
use App\Posttfe;
use App\Post;
use App\Category;
use App\Subcategory;
use App\Slideshow;
use App\Slideshowtfe;
use App\Service;
use App\Register;
use App\Partner;

use App\Http\Requests\StoreTfeRequest;
use App\Http\Requests\StorePostRequest;

use Validator;
use Image;
use Redirect;
use Storage;
use Carbon\Carbon as Carbon;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    
    public function SupportIndex()
    {
        $content = Customer::orderBy('created_at','desc')->paginate(10);
        return view('admin.support.index')->with('contents',$content);
    }

    public function SupportShow($id)
    {
        $content = Customer::findOrFail($id)->toArray();
        $update = Customer::find($content['id'])->update(['read' => 1]);
        return view('admin.support.show')->with('content',$content);
    }

    public function RegisterIndex()
    {

        $posts = Register::paginate(10);

        return view('admin.register.index')->with([
            'posts' => $posts
             
        ]);

    }

    public function RegisterShow($id)
    {

        $post = Register::findOrFail($id);
        $post->update([
            'read' => 1
        ]);

        return view('admin.register.show')->with([
            'post' => $post
        ]);

    }

    public function PartnerIndex()
    {

        $result = Partner::paginate(10);

        return view('admin.partner.index')->with([
            'result' => $result
        ]);

    }

    public function PartnerEdit($id)
    {

        $result = Partner::findOrFail($id);

        return view('admin.partner.edit')->with([
            'result' => $result
        ]);

    }

    public function PartnerCreate()
    {

        return view('admin.partner.create');

    }

    public function PartnerStore(Request $request)
    {

        $rules = [
            'description' => 'required|max:255',
            'link'        => 'required|max:255',
            'image'       => 'required|max:255'
        ];

        $messenges = [
            'description.required' => 'Bạn cần nhập thông tin đối tác.',
            'description.max'      => 'Bạn nhập thông tin quá dài.',
            'link.required'        => 'Bạn cần nhập liên kết đến đối tác.',
            'link.max'             => 'Bạn nhập liên kết quá dài.',
            'image.required'       => 'Bạn cần nhập ảnh đại diện.',
            'image.max'            => 'Bạn nhập ảnh quá dài.'
        ];

        $validator = Validator::make($request->input(), $rules, $messenges);

        if($validator->fails())
            return Redirect::back()->withErrors($validator)->withInput();
        else {
            if(!isset($request->id)) {
                $partner = new Partner([
                    'description' => $request->description,
                    'link'        => $request->link,
                    'image'       => $request->image
                ]);
                $partner->save();
            } else {
                $result = Partner::find($request->id);
                $result->update([
                    'description' => $request->description,
                    'link'        => $request->link,
                    'image'       => $request->image
                ]);
            }

            return Redirect::route('admin.partner.index');
        }

    }

    public function PartnerDestroy(Request $request)
    {

        try {

            $result = Partner::findOrFail($request->id);
            $result->delete();

            return response()->json([
                'messenger' => 'OK'
            ], 200);

        } catch(ModelNotFoundException $e) {

            return response()->json([
                'messenger' => 'Không tìm thấy ID để xóa.'
            ], 422);

        }

    }

    public function ServiceCreate($id)
    {
        $category = array();
        $contents = Category::where('parent_id','=',$id)->select('id')->get();
        foreach($contents as $content){
            $a = Category::where('parent_id','=', $content->id)->select('id', 'name')->get();
            foreach($a as $b){
                $category[] = $b;
            }
        }
        return view('admin.service.create')->with('category', $category);
    }

    public function ServiceStore(Request $request)
    {
        $file = $request->input();
        $rules = array(
            'title'         => 'required|min:10|max:200',
            'information'   => 'required|min:10|max:500',
            'image'         => 'required'
        );

        $messages = array(
            'title.required'        =>  'Bạn cần điền vào Tiêu Đề',
            'title.min'             =>  'Tiêu đề quá ngắn',
            'title.max'             =>  'Tiêu đề quá dài',
            'information.required'  =>  'Bạn cần điền vào phần Nội Dung',
            'information.min'       =>  'Nội dung quá ngắn',
            'information.max'       =>  'Nội dung quá dài',
            'image.required'        =>  'Bạn cần chọn ít nhất 1 cái ảnh trong mục Ảnh'
        );

        $validator = Validator::make($request->input(), $rules, $messages);
        if($validator->fails()){
            $messages = $validator->messages();
            return  Redirect::route('admin.service.edit')->withErrors($validator);
        }else{
            // Article
            $article = new Article;

            $article->category_id = $request->input('parent_id');
            $article->name = $request->input('title');
            $article->slug = str_slug($request->input('title'));


            $image = Image::make($this->Separator(public_path($request->input('thumbnail'))));
            $path = $this->Separator(public_path('uploads/images/thumb/').basename($request->input('thumbnail')));
            $image->resize(252, 152)->save($path, 60);            
            $article->thumbnail = 'uploads/images/thumb/'.basename($request->input('thumbnail'));

            $article->information = $request->input('information');

            $article->save();

            // SlideShow
            $imgs = $request->input('image');
            foreach($imgs as $img){
                $slide = new Slideshow;
                $slide->title = $img['title'];
                $slide->article_id = $article->id;
                $path_img = $this->Separator(public_path($img['image']));
                $a = Image::make($path_img);
                $a->resize(95,58)->save($this->Separator(public_path('uploads/images/thumb/95x58/'.basename($img['image']))),60);
                $slide->image = 'uploads/images/thumb/95x58/'.basename($img['image']);
                $a = Image::make($path_img);
                $a->resize(535,376)->save($this->Separator(public_path('uploads/images/thumb/535x376/'.basename($img['image']))),80);
                $slide->image = 'uploads/images/thumb/535x376/'.basename($img['image']);
                $slide->save();
            }

            return Redirect::route('admin.service.index');
        }
    }

    public function ServiceEdit($id)
    {

        $model = Article::findOrFail($id);

        return view('admin.service.edit');
        
    }

    protected function Separator($str)
    {
        $uname = php_uname();
        if(stripos($uname, 'windows'))
            return $str;
        else
            return str_replace('/', '\\', $str);
    }

    /*----------Begin Service Tfe-----------*/

    public function ServiceTfe()
    {

        $result = Tfe::paginate(10);
        return view('admin.service.tfe.index')->with([
            'result' => $result
        ]);

    }

    public function ServiceTfeStore(StoreTfeRequest $request)
    {

        if($request->ajax()){
            $category = new Tfe;
            $category->name = $request->name;
            $category->slug = str_slug($request->name);
            $category->image = $request->image;
            $category->description = $request->description;
            $category->start = $request->start;
            $category->end = $request->end;
            $category->save();

            if(($request->end) > Carbon::now()->toDateString())
                $category->update(['status' => 1]);

            $post = new Posttfe;
            $post->information = $request->information;
            $post->content = $request->content;
         
            $category->Post()->save($post);

            foreach($request->slide as $v){
                $show = new Slideshowtfe([
                    'image' => $v,
                    'thumbnail' => $v
                ]);
                $post->Slideshows()->save($show);
            }


            return response()->json([
                'messenger' => 'Bạn đã lưu thành công.'          
            ]);
        }
        
    }

    public function ServiceTfeCreate()
    {

        return view('admin.service.tfe.create');

    }

    public function ServiceTfeEdit($id)
    {

        $result = Tfe::findOrFail($id);
        $result['post'] = $result->Post()->first();
        $result['slide'] = $result->Slideshows()->get();
        return view('admin.service.tfe.edit')->with([
            'result' => $result
        ]);
        
    }

    public function ServiceTfeUpdate(StoreTfeRequest $request, $id)
    {

        if($request->ajax()) {

            $result = Tfe::findOrFail($id);
            $result->name = $request->name;
            $result->slug = str_slug($request->name);
            if(($request->end) < Carbon::now()->toDateString())
                $result->status = 1;
            else
                $result->status = 0;
            $result->image = $request->image;
            $result->description = $request->description;
            $result->start = $request->start;
            $result->end = $request->end;

            $post = $result->Post()->first();

            $result->Post()->update([
                'information' => $request->information,
                'content'     => $request->content
            ]);

            $slide = Posttfe::find($post->id);
            $slide->Slideshows()->delete();
                       
            foreach($request->slide as $value) {
                $tmp = new Slideshowtfe([
                    'image'     => $value,
                    'thumbnail' => $value
                ]);
                $slide->Slideshows()->save($tmp);
            }

            $result->save();
            
            return response()->json([
                'messenger' => 'Đã lưu thành công'
            ]);
        }

    }

    public function ServiceTfeDestroy(Request $request)
    {

        if($request->ajax()){
            $destroy = Tfe::findOrFail($request->id);
            $destroy->Slideshows()->delete();
            $destroy->Post()->delete();
            $destroy->delete();

            return response()->json([
                'messenger' => 'Đã xóa thành công',
                'value' => $destroy->Post()->first()
            ]);
        }

    }

    /*-----End Service Tfe------------------*/

    /*-------Begin Service---------*/

    public function ServiceIndex($id)
    {

        $service = Service::findOrFail($id);
        
        return view('admin.service.index')->with([
            'service'     => $service
        ]);

    }

    public function ServiceCategoryIndex($id)
    {

        $service = Service::findOrFail($id);
        $category = $service->Categories()->get()->toArray();
        foreach($category as $key => $value){
            $category[$key]['sub'] = Category::find($value['id'])->Subcategorys()->get()->toArray();
        }
        
        return view('admin.service.category.index')->with([
            'category' => $category,
            'service'  => $service
        ]);

    }

    public function ServiceCategoryEdit($id, $c_id)
    {

        $category = Service::findOrFail($c_id);
        return view('admin.service.category.edit')->with([
            'service'  => $category,
            'category' => $category->Categories()->where('id', '=', $id)->first()
        ]);

    }

    public function ServiceCategoryCreate($id)
    {

        $service = Service::findOrFail($id);
        return view('admin.service.category.create')->with([
            'service' => $service
        ]);

    }

    public function ServiceCategoryStore(Request $request)
    {

        $rules = [
            'name' => 'required|unique:categories,name,'.$request->id
        ];
        $messenges = [
            'required' => 'Bạn cần nhập Tên',
            'unique'   => 'Tên đã có sẵn'
        ];

        $validator = Validator::make($request->input(), $rules, $messenges);
        if($validator->fails())
            return  Redirect::back()->withErrors($validator)->withInput();
        else if(is_null($request->id)){
            $category = new Category([
                'name' => $request->name,
                'slug' => str_slug($request->name)
            ]);
            Service::findOrFail($request->c_id)->Categories()->save($category);
            return Redirect::route('admin.service.category.index', ['id' => $request->c_id]);            
        } else {
            $category = Category::findOrFail($request->id)->update([
                'name' => $request->name,
                'slug' => str_slug($request->name)
            ]);
            return Redirect::route('admin.service.category.index', ['id' => $request->c_id]);
        }

    }

    public function ServiceSubcategoryCreate($id)
    {

        $service = Service::findOrFail($id);
        $category = $service->Categories()->get();

        return view('admin.service.category.subcategory.create')->with([
            'service'  => $service,
            'category' => $category
        ]);

    }

    public function ServiceSubcategoryEdit($id, $s_id)
    {

        $service = Service::findOrFail($s_id);
        $category = $service->Categories()->get();
        $sub = Subcategory::findOrFail($id);

        return view('admin.service.category.subcategory.edit')->with([
            'service'     => $service,
            'category'    => $category,
            'subcategory' => $sub
        ]);

    }

    public function ServiceSubcategoryStore(Request $request)
    {

        $rules = [
            'name'     => 'required|unique:subcategories,name,'.$request->id,
            'category' => 'required|exists:categories,id'
        ];

        $messenges = [
            'name.required'     => 'Bạn cần nhập Tên',
            'name.unique'       => 'Tên bạn nhập đã có sẵn',
            'category.required' => 'Bạn cần phải có chuyên mục cha',
            'category.exists'   => 'Không có tên chuyên mục cha trong cơ sở dữ liệu'
        ];

        $validator = Validator::make($request->input(), $rules, $messenges);

        if($validator->fails())
            return Redirect::back()->withErrors($validator)->withInput();
        else if(is_null($request->id)) {
            $sub = new Subcategory([
                'name'  => $request->name,
                'slug'  => str_slug($request->name),
                'image' => $request->image
            ]);
            Category::findOrFail($request->category)->Subcategorys()->save($sub);
            return Redirect::route('admin.service.category.index', $request->c_id);
        } else {
            $sub = Subcategory::findOrFail($request->id);
            $sub->update([
                'category_id' => $request->category,
                'name'        => $request->name,
                'slug'        => str_slug($request->name),
                'image'       => $request->image
            ]);
            return Redirect::route('admin.service.category.index', $request->c_id);
        }

    }

    public function ServiceCategoryDestroy(Request $request)
    {

        if($request->ajax()){
            if(isset($request->category)){
                try{

                    $category = Category::findOrFail($request->category);
                    $sub = $category->Subcategorys()->get();
                    foreach($sub as $key => $value) {
                        $subcategory = Subcategory::find($value['id']);
                        $post = $subcategory->Posts()->get();
                        foreach($post as $k => $v) {
                            $p = Post::find($v['id']);
                            $p->Slideshows()->delete();
                            $p->delete();
                        }
                    }
                    $category->Subcategorys()->delete();
                    $category->delete();

                    return response()->json([
                        'messenger' => 'Xóa thành công'
                    ], 200);

                } catch(ModelNotFoundException $e) {

                    return response()->json([
                        'messenger' => 'Không tìm thấy Chuyên mục cha để xóa.'
                    ], 422);

                }
            } else {
                try{

                    $category = Subcategory::findOrFail($request->subcategory);
                    foreach($category->Posts()->get() as $key => $value) {
                        $post = Post::find($value['id']);
                        $post->Slideshows()->delete();
                        $post->delete();
                    }
                    $category->delete();

                    return response()->json([
                        'messenger' => 'Xóa thành công'
                    ], 200);

                } catch(ModelNotFoundException $e) {

                    return response()->json([
                        'messenger' => 'Không tìm thấy Chuyên mục để xóa.'
                    ], 422);

                }
            }
        }
        
    }

    public function ServicePostIndex($id, $view)
    {

        if($view == 'all'){
            $service = Service::findOrFail($id);
            $sub = $service->Subcategorys()->get();
            $i = 0;
            foreach($sub as $value){
                $listCategory[$value['id']] = $value['name'];
                $list[$i] = $value['id'];
                $i++;
            }

            if(isset($list))
                $post = Post::whereIn('subcategory_id', $list)->paginate(10);
            else {
                $post = [];
                $listCategory = [];
            }

            return view('admin.service.post.index')->with([
                'service'      => $service,
                'listCategory' => $listCategory,
                'post'         => $post,
                'view'         => $view
            ]);
        } else {
            $service = Service::findOrFail($id);
            $listCategory = $service->Subcategorys()->get();
            $sub = Subcategory::findOrFail($view);
            $post = $sub->Posts()->paginate(10);

            return view('admin.service.post.index')->with([
                'service'  => $service,
                'category' => $sub,
                'list'     => $listCategory,
                'post'     => $post,
                'view'     => $view
            ]);
        }

    }

    public function ServicePostEdit($id, $s_id)
    {

        $service = Service::findOrFail($s_id);
        $sub = $service->Subcategorys()->get();
        $post = Post::findOrFail($id);
        $slideshow = $post->Slideshows()->get();

        return view('admin.service.post.edit')->with([
            'service'     => $service,
            'subcategory' => $sub,
            'post'        => $post,
            'slideshow'   => $slideshow
        ]);

    }

    public function ServicePostCreate($id)
    {

        $service = Service::findOrFail($id);
        $category = $service->Subcategorys()->get();

        return view('admin.service.post.create')->with([
            'service'  => $service,
            'category' => $category
        ]);

    }

    public function ServicePostStore(StorePostRequest $request)
    {

        if(is_null($request->id)) {

            $post = new Post([
                'name'        => $request->name,
                'slug'        => str_slug($request->name),
                'image'       => $request->image,
                'information' => $request->information
            ]);

            Subcategory::find($request->category)->Posts()->save($post);

            if(isset($request->slide)){
                foreach($request->slide as $value){
                    $slide = new Slideshow([
                        'image' => $value
                    ]);
                    $post->Slideshows()->save($slide);
                }
            }

            return Redirect::route('admin.service.post.index', [
                'id'   => $request->service, 
                'view' => "all"
            ]);

        } else {
            $post = Post::findOrFail($request->id);
            $post->update([
                'subcategory_id' => $request->category,
                'name'           => $request->name,
                'slug'           => str_slug($request->name),
                'image'          => $request->image,
                'information'    => $request->information
            ]);
            $post->Slideshows()->delete();
            if(isset($request->slide)){
                foreach($request->slide as $value){
                    $slide = new Slideshow([
                        'image' => $value
                    ]);
                    $post->Slideshows()->save($slide);
                }
            }

            return Redirect::route('admin.service.post.index', [
                'id'   => $request->service, 
                'view' => "all"
            ]);
        }

    }

    public function ServicePostDestroy(Request $request)
    {

        if($request->ajax()) {
            try{
                $post = Post::findOrFail($request->id);
                $post->Slideshows()->delete();
                $post->delete();
                return response()->json([
                    'messenger' => 'Xóa thành công.'
                ], 200);
            } catch(ModelNotFoundException $e) {
                return response()->json([
                    'messenger' => 'Không xóa được.'
                ], 422);
            }
            
        }

    }

    /*--------End Service----------------*/

}
