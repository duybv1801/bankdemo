<?php

namespace App\Http\Controllers;

use App\Models\UserMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QueryController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $metas = UserMeta::query()->where('user_id', $userId)->get();
        return view('query', compact('metas'));
    }
}
