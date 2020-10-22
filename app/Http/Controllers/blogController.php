<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog;
use ImageOptimizer;

class blogController extends Controller
{

    public function search(Request $request)
    {
        $cond = ['visible' => 1];
        $category_id = $request->category_id;
        $query = $request->q;

        if ($category_id != null) {
            $cond = array_merge($cond, ['category_id' => $category_id]);
        }

        $blogs = Blog::where($cond);

        if ($query != null) {
            $blogs = $blogs->where('title', 'like', '%' . $query . '%');
        }
        $blogs = $blogs->paginate(8);
        return view('article.article-blog',compact('blogs'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::orderBy('created_at','desc')->get();
        $banner = \App\Banner::where("url","#blog")->first();
        return view('article.admin.index',compact(['blogs','banner']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $operasi = "Tulis";
        $url = route('blog.store');
        $method = "create";
        return view('article.admin.create',compact(['operasi','url','method']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $blog = new Blog;
        $reqArray = $request->all();
        $blog->visible = array_key_exists('visible',$reqArray)? (int)$request->visible : 0;
        $blog->category_id = $request->category;
        $blog->title = $request->title;
        $blog->subtitle = $request->subtitle;
        $blog->slug = str_replace(" ","-",$request->title);
        $blog->content = $request->content;
        $blog->thumbnail = $this->upload_image($request);
        $blog->save();
        flash("berhasil menambah blog")->success();
        return redirect(route('blog.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::findOrFail(decrypt($id));
        if ($blog == null || $blog->visible == 0) {
            flash("Blog tidak ditemukan")->error();
            return back();
        }
        $similiar = \App\Blog::where(['visible'=>1,'category_id'=>$blog->category_id])->where('id','!=',$blog->id)->limit(4)->get();
        return view("article.article", compact(['blog','similiar']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail(decrypt($id));
        if ($blog != null) {
            $operasi = "Edit";
            $url = route('blog.update',$id);
            $method = "update";
            return view('article.admin.create',compact(['operasi','url','method','blog']));
        }
        flash("Blog tidak ditemukan")->error();
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail(decrypt($id));
        $reqArray = $request->all();
        $blog->thumbnail = array_key_exists('thumbnail',$reqArray)? $this->upload_image($request,$request->oldThumb) : $request->oldThumb;
        $blog->category_id = $request->category;
        $blog->visible = $request->visible;
        $blog->title = $request->title;
        $blog->subtitle = $request->subtitle;
        $blog->content = $request->content;
        $blog->slug = str_replace(" ","-",$request->title);
        $blog->save();
        flash("berhasil mengubah blog")->success();
        return redirect(route('blog.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = decrypt($id);
        $blog = Blog::findOrFail($id);
        $blog->delete();
        flash("Berhasil menghapus blog")->success();
        return redirect(route('blog.index'));
    }

    public function kategori_blog(Type $var = null)
    {
        $categories = \App\CategoryBlog::withCount('blogs')->orderBy('blogs_count','desc')->get();
        return view('article.admin.category', compact('categories'));
    }
    public function update_kategori_blog(Request $request,$id)
    {
        $ctg = \App\CategoryBlog::findOrFail(decrypt($id));
        if ($ctg != null) {
            $ctg->name = $request->name;
            $ctg->save();
            flash("berhasil update kategori")->success();
            return redirect(route("blog.ctg"));
        }
        flash("kategori tidak ditemukan!")->danger();
        return redirect(route("blog.ctg"));
    }

    public function store_kategori_blog(Request $request)
    {
        $ctg = \App\CategoryBlog::insert(['name'=>$request->name]);
        if ($ctg) {
            flash("berhasil menambah kategori blog")->success();
            return back();
        }
    }

    public function delete_kategori_blog($id)
    {
        $ctg = \App\CategoryBlog::findOrFail(decrypt($id));
        if ($ctg->get()!=null) {
            $ctg->delete();
            flash("berhasil menghapus kategori blog")->success();
            return back();
        }
    }
    public function update_ctg(Request $request)
    {
        $id = $request->id;
        $data["icon"] = $request->old_image;

        if ($request->hasFile("icon")) {
            $image = $request->file('icon');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('blog/icon-category'), $new_name);
            $delsrc = public_path().'/blog/icon-category/'.$request->old_image;
            if (is_file($delsrc)) {
                unlink($delsrc);
            }
            $data["icon"] = $new_name;
        }

        $data["title"] = $request->title;
        \App\CategoryBlog::where("id",$id)->update($data);
        flash("berhasil update kategori blog")->success();
        return "success";
    }
    

    public function upload_ajx(Request $request)
    {
        $img = $request->file('image')->store('images/blog');
        ImageOptimizer::optimize(base_path('public/').$img);

        return response()->json([
            'image' => my_asset($img)
        ]);
    }

    public function remove_ajx(Request $request)
    {
        $src = public_path().'/images/'.$request->src;
        if(unlink($src)){
            return response()->json('oke');
        }
    }

    public function upload_image(Request $request,$old=0)
    {
        // dd($old);
        $file = '';
        if ($request->hasFile('thumbnail')) {
            $file = $request->thumbnail;
            $name   = $file->getClientOriginalName();
            if($file->move(\base_path() ."/public/images/blog/thumbnail", $name)){
                ImageOptimizer::optimize(base_path('public/images/blog/thumbnail/').$name);
                if ($old != 0) {
                    unlink(public_path()."/".$old);
                }
                # code...
                return "images/blog/thumbnail/$name";
            }
            return 'images/placeholder.jpg';
        }
    }

    public function update_visibility(Request $request,$id)
    {
        $blog = Blog::findOrFail($id);
        $blog->visible = $request->visible;
        $blog->save();
        return "success";
    }

    public function update_banner(Request $request,$id)
    {
        $banner = \App\Banner::find($id);
        if ($banner == null) {
            $banner = new \App\Banner;
        }
        $banner->photo = $request->hasFile('banner') ? $request->banner->store('images/banners') : "";
        ImageOptimizer::optimize(base_path('public/').$banner->photo);
        $banner->url = "#blog";
        $banner->position = 1;
        $banner->published = 1;
        $banner->save();
        flash("berhasil update banner")->success();
        return redirect(route('blog.index'));
    }
}
