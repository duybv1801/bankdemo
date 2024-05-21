<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class TransferController extends Controller
{
    public function index()
    {
        return view('transfer');
    }

    public function store(Request $request)
    {
        $request->validate([
            'money' => 'integer|required',
            'fee' => 'integer|required',
        ]);
        $data = $request->all();
        $data['creator_id'] = Auth::id();
        $data['total_money'] = $request['money'] + $request['fee'];

        try {
            $bill = Bill::create($data);
            if ($bill) {
                return redirect(route('dashboard'))->with(['status' => 'success', 'message' => 'Tạo thành công']);
            }
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            Log::error('Error creating bill: ' . $errorMessage);
            return redirect(route('dashboard'))->with(['status' => 'danger', 'message' => 'Có lỗi rồi']);
        }
    }
}
