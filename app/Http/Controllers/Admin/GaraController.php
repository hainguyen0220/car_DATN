<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UpdateMessageTrait;
use App\Models\Gara;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Support\Facades\Log;

class GaraController extends Controller
{

    const DEFAULT_PAGINATE = 15;
    use UpdateMessageTrait;

    public function listGara(Request $request)
    {

        $searchParams = [
            'gara_name' => $request->input('gara_name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
        ];

        $garas = Gara::withFilter($searchParams)
            ->orderByDesc('created_at')
            ->paginate(self::DEFAULT_PAGINATE);

        return view('admin.gara.table_gara')->with(
            [
                'garas' => $garas
            ]
        );
    }

    public function showCreateGara()
    {
        return view('admin.gara.create_gara');
    }

    public function createGara(Request $request)
    {

        $request->validate(
            [
                'gara_name' => 'required|min:3|max:255|unique:gara,name',
                'email' => 'required|email|min:8|max:255|unique:gara',
                'address' => 'max:255',
            ],
        );

        $data = $request->only('gara_name', 'email', 'address', 'describle');

        try {

            $author = new Gara();
            $author->name = $data['gara_name'];
            $author->email = $data['email'];
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


    public function showUpdateGara($id)
    {

        $gara = Gara::find($id);

        session()->put('id_gara_update', $id);

        return view('admin.gara.update_gara')
            ->with(compact('gara'));
    }

    public function updateGara(Request $request)
    {
        $id = session()->get('id_gara_update');
        if (!$id) {

            $this->updateFailMessage($request, __('message.update-fail'));

            return back();
        }

        $request->validate(
            [
                'gara_name' => 'required|min:3|max:255|unique:gara,name,' . $id,
                'email' => 'required|email|min:8|max:255|unique:gara,email,' . $id,
                'address' => 'max:255',
            ],
        );

        $data = $request->only('gara_name', 'email', 'address', 'describle');

        try {
            Gara::where('id', $id)->update([
                'name' => $data['gara_name'],
                'email' => $data['email'],
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
