<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrderExport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UpdateMessageTrait;
use App\Models\GiveCarBack;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\log;
use Throwable;
use Yajra\Datatables\Datatables;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    use UpdateMessageTrait;
    public function getIndex(Request $request)
    {
        return view('admin.dashboard');
    }

    public function showData()
    {
        $order = Order::with('account.user_info')->get();
        return Datatables::of($order)
            ->addColumn('details_url', function ($order) {
                return route('order.detail', ['id' => $order->id]);
            })->make(true);
    }

    public function getOrderDetail($id)
    {
        $orderDetails = OrderDetail::with(['car' => function ($query) {
            $query->withTrashed();
        }, 'token_give_car_back'])->where('order_id', $id)->get();
        return Datatables::of($orderDetails)->addColumn('action', function ($orderDetails) {
            $token_give_car_back = $orderDetails->token_give_car_back->id ?? 0;
            if ($orderDetails->status == 0 && $this->isTokenCarBack($token_give_car_back)) {
                return '<a href="' . route('update.order.detail', $orderDetails->id) . '" class="btn btn-xs btn-warning">
                <i class="glyphicon glyphicon-edit"></i>
                Xác nhận trả
                </a>';
            }
        })
            ->editColumn('status', function ($orderDetails) {
                if ($orderDetails->status == 2) {
                    return '<span class="text-danger">Hết hạn thuê</span>';
                }
                if ($orderDetails->status == 1) {
                    return '<span class="text-success">Đã trả ô tô</span>';
                }
                return '<span class="text-primary-800">Đang thuê</span>';
            })
            ->rawColumns(['status', 'action'])

            ->make(true);
    }

    public function updateOrderDetail(Request $request, $id)
    {
        $idAccount = Auth::guard('account')->user()->id ?? session('admin')->id;
        if (!$idAccount) {
            return route('login');
        }
        try {
            OrderDetail::where('id', $id)->update(['status' => Order::STATUS_CAR_PAID]);
            GiveCarBack::where('order_detail_id', $id)->first()->delete();
            $this->updateSuccessMessage($request, __('message.confirm-successful'));
            return back();
        } catch (Throwable $e) {
            log::channel('admin_log')->error($e->getMessage());
            return back();
        }
    }

    public function isTokenCarBack($token)
    {
        if ($token) return true;
        return false;
    }

    public function exportOrder(Request $request)
    {
        $request->validate(
            [
                'date_start' => 'required|date',
                'date_end' => 'required|date|after_or_equal:date_start',
            ],
            [
                'date_end.after_or_equal' => 'Ngày kết thúc phải lớn hơn ngày bắt đầu'
            ]
        );
        $data = $request->only('date_start', 'date_end');
        $results = Order::with(['order_detail.car'=> function ($query) {
            $query->withTrashed();
        }, 'account.user_info'])->searchWithDate($data)->get();
        $dataExport = array();
        foreach ($results as $result) {
            foreach ($this->formatExportExcel($result) as $order) {
                array_push($dataExport, $order);
            }
        }
        try {
            return Excel::download(new OrderExport($dataExport), 'order-' . $data['date_start'] . '-' . $data['date_end'] . '.xlsx');
        } catch (Throwable $e) {
            log::channel('admin_log')->error($e->getMessage());
            return back();
        }
    }

    public function formatExportExcel($examResultItem)
    {
        $dataExport = array();
        foreach ($examResultItem->order_detail as $order_detail) {
            $status = ($order_detail->status == Order::STATUS_BORROW) ? 'Đang thuê' : (($order_detail->status == Order::STATUS_CAR_PAID) ? 'Đã trả ô tô' : 'Hết hạn thuê');
            $data =  [
                $examResultItem->id,
                $examResultItem->account->user_info->full_name ?? $examResultItem->account->username,
                $examResultItem->account->email,
                $order_detail->car->car_name,
                $order_detail->quantity,
                $status,
                $order_detail->date_order,
            ];

            array_push($dataExport,  $data);
        }
        return $dataExport;
    }
}
