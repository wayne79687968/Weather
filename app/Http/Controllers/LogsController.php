<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    public function index()
    {
        return view('admin.logs.index');
    }

    public function getWeatherLog()
    {
        $account = $_GET['account'];
        $datas = Log::orderBy('created_at', 'DESC');
        $logs = [];
        if ('' != $account) {
            $datas = $datas->where('account', '=', $account);
        }
        $per_page = 3;
        $page = intval($_GET['page']) ?? 1;
        $datas = $datas->paginate($per_page);

        foreach ($datas as $data) {
            $logs[] = [
                'account'    => $data->account,
                'gps'        => $data->gps,
                'content'    => $data->content,
                'created_at' => $data->created_at,
            ];
        }

        return json_encode([
            'error'   => false,
            'message' => '成功查詢匯入紀錄',
            'data'    => [
                'page'    => $page,
                'last_page' => $datas->lastPage(),
                'logs'    => $logs
            ],
        ]);

    }
}
