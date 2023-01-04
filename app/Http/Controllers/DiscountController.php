<?php

namespace App\Http\Controllers;

use App\Models\discounts;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    private $discount;
    public function __construct(discounts $discount)
    {
        $this->discount = $discount;
    }
    public function index()
    {
        $discountss = $this->discount->paginate(5);
        return view('admin.discount.index', compact('discountss'));
    }

    public function create()
    {
        return view('admin.discount.add');
    }

    public function store(Request $request)
    {
       $this->discount->create([
        'code' => $request->code,
        'number'=> $request->number,
        'start_date' => $request->start_date,
        'end_date'=> $request->end_date
        // 'number'=> $request->number,
       ]);

       return redirect()->route('discount.index');
    }

    public function edit($id)
    {
        $discounts = $this->discount->find($id);
        return view('admin.discount.edit', compact('discounts'));
    }
    public function update($id, Request $request)
    {
       $this->discount->find($id)->update([
        'code' => $request->code,
        'number'=> $request->number,
        'start_date' => $request->start_date,
        'end_date'=> $request->end_date
        // 'number'=> $request->number,
       ]);

       return redirect()->route('discount.index');
    }

    public function delete($id){
        $this->discount->find($id)->delete();
       return redirect()->route('discount.index');

    }
}