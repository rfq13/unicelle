<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog;
use ImageOptimizer;

class blogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::all();
        return view('article.admin.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $operasi = "Tulis";
        $content = "Mulai menulis di sini";
        return view('article.admin.create',compact(['operasi','content']));
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
        $blog->category_id = $request->category;
        $blog->visible = $request->visible;
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->save();
        flash("berhasil menambah blog")->success();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        if ($blog != null) {
            return view("article.article", compact('blog'));
        }
        flash("Blog tidak ditemukan")->error();
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = decrypt($id);
        $blog = Blog::findOrFail($id);
        if ($blog != null) {
            return view("article.edit-article", compact('blog'));
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
        $blog = Blog::findOrFail($id);
        $blog->category_id = $request->category;
        $blog->visible = $request->visible;
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->save();
        flash("berhasil mengubah blog")->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        if ($blog != null) {
            $blog->destroy;
            flash("Berhasil menghapus blog")->success();
            return back();
        }
        flash("Blog tidak ditemukan")->danger();
        return back();
    }

    public function kategori_blog(Type $var = null)
    {
        $categories = \App\CategoryBlog::all();
        return view('article.admin.category', compact('categories'));
    }
    public function edit_kategori_blog(Type $var = null)
    {
        $ctg = \App\CategoryBlog::where("id",$id)->first();
        return $ctg;
    }
    public function create_kategori_blog(Type $var = null)
    {
        # code...
    }

    public function add_ctg(Request $request)
    {
        $icon = "placeholder-rect.jpg";
        if ($request->hasFile('icon')) {
            $image = $request->file('icon');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('blog/icon-category'), $new_name);
            $icon = $new_name;
        }
        $data = [
            "title" => $request->title,
            "icon" => $icon
        ];
        $ctg = \App\CategoryBlog::insert($data);
        if ($ctg) {
            flash("berhasil menambah kategori blog")->success();
            return "success";
        }
    }

    public function delete_ctg($id)
    {
        $id = explode("," , $id);
        $ctg = \App\CategoryBlog::whereIn('id',$id);
        if ($ctg->get()!=null) {
            foreach ($ctg->get() as $key => $cb) {
                $src = public_path().'/blog/icon-category/'.$cb->icon;
                \App\CategoryBlog::find($cb->id)->delete();
                if (is_file($src)) {
                    unlink($src);
                }
            }
            flash("berhasil menghapus kategori blog")->success();
            return "deleted";
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
}
