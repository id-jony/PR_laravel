<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Consumer;
use App\Models\UsersTask;

use App\Models\Posm_delivery;

class ModalController extends Controller
{
    public function showleaders(Request $request)
    {

        $level = '';
        $top_users = [];

        foreach (UsersTask::All() as $UsersTask) {
            if ($UsersTask->start_date <= now() && $UsersTask->finish_date >= now()) {
                if ($UsersTask->category === 'top') {

                    $top_users = Consumer::whereDate('consumers.created_at', '>=', $UsersTask->start_date)
                    ->whereDate('consumers.created_at', '<=', $UsersTask->finish_date)
                    ->join('users', 'users.id', '=', 'consumers.ref_user_id')
                    ->select('consumers.ref_user_id', 'users.fio', 'users.city', DB::raw('count(consumers.id) as bonus'))
                    ->groupBy('consumers.ref_user_id')
                    ->orderBy('bonus', 'desc')
                    ->get();

                    $i = 1;
                    foreach ($top_users as $top_user) {
                        if ($top_user->ref_user_id != auth()->user()->id) {
                            $i++;
                        } else {
                            $level = $i;
                        }
                    }
                }
            }
        }

        return view('promoter.modal.leaders', [
            'level' => $level,
            'top_users' => $top_users,
            // 'posm_balance_all' => $posm_balance_all
        ]);
    }
}
