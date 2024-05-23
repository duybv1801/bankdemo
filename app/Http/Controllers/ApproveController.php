<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\UserMeta;
use Illuminate\Http\Request;

class ApproveController extends Controller
{
    public function index()
    {
        $datas = Bill::with(['creator:id,name', 'receiver:id,name'])->get();

        return view('approve', compact('datas'));
    }

    public function edit($id)
    {
        $bill = Bill::with([
            'creator:id,name',
            'receiver:id,name'
        ])->findOrFail($id);

        $meta = $bill->creator->metas()->where('accout_type', $bill->fund)->select('accout_number')->first();
        return view('edit', compact('bill', 'meta'));
    }

    public function update(Request $request, $id)
    {
        $bill = Bill::findOrFail($id);
        $status = $request->input('status');
        $bill->status = $status;
        $bill->save();
        if ($status == 2) {
            $bill->approve_level = 1;
            $sender = UserMeta::where('accout_number', $request->sender)->first();
            $sender->surplus -= $bill->total_money;
            $receiver = UserMeta::where('accout_number', $request->receiver)->first();
            $receiver->surplus += $bill->money;
            $bill->save();
            $sender->save();
            $receiver->save();
        }
        return redirect()->route('approve.index')->with(['status' => 'success', 'message' => 'Duyệt thành công']);
    }
}
