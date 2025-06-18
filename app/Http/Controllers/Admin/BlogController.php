<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('admin.blogs.index', compact('blogs'));
    }
    public function create()
    {
        return view('admin.blogs.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|max:255',
            'content' => 'required',
            'image'   => 'nullable|image|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img/blogs'), $imageName);
        }


        Blog::create([
            'title'   => $request->title,
            'slug'    => Str::slug($request->title),
            'summary' => $request->summary,
            'content' => $request->content,
            'image'   => $imageName,
            'status'  => $request->status ?? 0,
            'author_id' => null,
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Thêm bài viết thành công');
    }
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'   => 'required|max:255',
            'content' => 'required',
            'image'   => 'nullable|image|max:2048',
        ]);

        $blog = Blog::findOrFail($id);

        // Xử lý ảnh
        if ($request->hasFile('image')) {
            if ($blog->image && File::exists(public_path('img/blogs/' . $blog->image))) {
                File::delete(public_path('img/blogs/' . $blog->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/blogs'), $imageName);
        } else {
            $imageName = $blog->image;
        }

        // Cập nhật dữ liệu
        $blog->update([
            'title'    => $request->title,
            'slug'     => Str::slug($request->title),
            'summary'  => $request->summary,
            'content'  => $request->content,
            'status'   => $request->status ?? 0,
            'image'    => $imageName,
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Cập nhật thành công');
    }
    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.show', compact('blog'));
    }
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        // Xoá ảnh nếu có
        if ($blog->image && File::exists(public_path('img/blogs/' . $blog->image))) {
            File::delete(public_path('img/blogs/' . $blog->image));
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Đã chuyển vào thùng rác');
    }
    public function trash()
    {
        $blogs = Blog::onlyTrashed()->latest()->paginate(10);
        return view('admin.blogs.trash', compact('blogs'));
    }
    public function restore($id)
    {
        $blog = Blog::onlyTrashed()->findOrFail($id);
        $blog->restore();

        return redirect()->route('admin.blogs.trash')->with('success', 'Khôi phục thành công');
    }
    public function forceDelete($id)
    {
        $blog = Blog::onlyTrashed()->findOrFail($id);

        if ($blog->image && File::exists(public_path('img/blogs/' . $blog->image))) {
            File::delete(public_path('img/blogs/' . $blog->image));
        }

        $blog->forceDelete();

        return redirect()->route('admin.blogs.trash')->with('success', 'Đã xoá vĩnh viễn');
    }
}
