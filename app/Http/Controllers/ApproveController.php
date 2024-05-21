<?php

namespace App\Http\Controllers;

use App\Models\Bill;
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

        return redirect()->route('approve.index')->with('success', 'Cập nhật trạng thái thành công.');
    }
}
