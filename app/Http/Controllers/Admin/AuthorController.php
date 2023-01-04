<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UpdateMessageTrait;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class AuthorController extends Controller
{
    const DEFAULT_PAGINATE = 15;
    use UpdateMessageTrait;

    public function listAuthor(Request $request)
    {

        $searchParams = [
            'author_name' => $request->input('author_name'),
            'year_birth' => $request->input('year_birth'),
            'address' => $request->input('address'),
        ];

        $authors = Author::withFilter($searchParams)
            ->orderByDesc('created_at')
            ->paginate(self::DEFAULT_PAGINATE);


        return view('admin.author.table_author')->with(
            [
                'authors' => $authors
            ]
        );
    }

    public function showCreateAuthor()
    {
        return view('admin.author.create_author');
    }

    public function createAuthor(Request $request)
    {

        $request->validate(
            [
                'author_name' => 'required|min:3|max:255',
                'address' => 'max:255',
            ],
        );

        $data = $request->only('author_name', 'year_birth','address','describle');
    
        try {

            $author = new Author();
            $author->full_name = $data['author_name'];
            $author->dob = $data['year_birth'];
            $author->address = $data['address'];
            $author->describle = $data['describle'];
            $author->save();

            $this->updateSuccessMessage($request, __('message.create-successful'));

            return back();
        } catch (Throwable $e) {

            log::channel('admin_log')->info($e->getMessage());

            $this->updateFailMessage($request, __('message.create-fail'));

            return back();
        }
    }

    
    public function showUpdateAuthor($id)
    {

        $author = Author::find($id);
        
        session()->put('id_author_update',$id);

        return view('admin.author.update_author')
            ->with(compact('author'));
    }

    public function updateAuthor(Request $request)
    {
        $id = session()->get('id_author_update');
        if (!$id) {

            $this->updateFailMessage($request, __('message.update-fail'));

            return back();
        }

        $request->validate(
            [
                'author_name' => 'required|min:3|max:255',
                'address' => 'max:255'
            ],
        );

        $data = $request->only('author_name', 'year_birth','address','describle');
    
        try {
            Author::where('id', $id)->update([
                'full_name' => $data['author_name'],
                'dob' => $data['year_birth'],
                'address' => $data['address'],
                'describle' => $data['describle']
            ]);

            $this->updateSuccessMessage($request, __('message.update-successful'));

            return back();

        } catch (Throwable $e) {

            log::channel('admin_log')->info($e->getMessage());

            $this->updateFailMessage($request, __('message.update-fail'));

            return back();
        }


    }
}
