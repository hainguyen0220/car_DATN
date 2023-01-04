<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlogAddRequest;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Support\Facades\Log;


class BlogController extends Controller
{
    use StorageImageTrait;
    private $blog;
    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }

    public function index()
    {
        $blogs = $this->blog->paginate(5);
        return view('admin.blog.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blog.add');
    }

    public function store(BlogAddRequest $request)
    {
        try {
            $dataInsert = [
                'title' => $request->title,
                'content' => $request->content,

            ];
            $dataImageBlog = $this->storageTraitUpload($request, 'image', 'blog');

            if (!empty($dataImageBlog)) {
                $dataInsert['image'] = $dataImageBlog['file_path'];
            }
            $this->blog->create($dataInsert);
            return redirect()->route('blog.index');
        } catch (\Exception $exception) {
            Log::error('Lỗi : ' . $exception->getMessage() . '---Line: ' . $exception->getLine());
        }
    }

    public function edit($id)
    {
        $blog = $this->blog->find($id);
        return view('admin.blog.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {


        try {
            $datadataUpdate = [
                'title' => $request->title,
                'content' => $request->content,

            ];
            $dataImageBlog = $this->storageTraitUpload($request, 'image', 'blog');

            if (!empty($dataImageBlog)) {
                // $dataInsert['image_name'] = $dataImageBlog['file_name'];
                $datadataUpdate['image'] = $dataImageBlog['file_path'];
            }
            $this->blog->find($id)->create($datadataUpdate);
            return redirect()->route('blog.index');
        } catch (\Exception $exception) {
            Log::error('Lỗi : ' . $exception->getMessage() . '---Line: ' . $exception->getLine());
        }

    }

    public function delete($id){
        $this->blog->find($id)->delete();
       return redirect()->route('blog.index');

    }
}
