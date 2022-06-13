<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use App\Models\Presentation;
use App\Models\UsersTask;
use App\Models\Posm;
use App\Models\Posm_delivery;
use App\Models\Consumer;
use App\Models\Education;

use function Psy\debug;

class AccountController extends Controller
{
    public function index()
    {

        $tasks = UsersTask::all();
        $level = '';
        $top_users = [];

        foreach ($tasks as $task) {
            if ($task->start_date <= now() && $task->finish_date >= now()) {
                if ($task->category === 'chart') {
                    $task->count_task = Consumer::where('ref_user_id', auth()->user()->id)
                        ->whereDate('consumers.created_at', '>=', $task->start_date)
                        ->whereDate('consumers.created_at', '<=', $task->finish_date)
                        ->count();
                }
                if ($task->category === 'top') {
                    $top_users = Consumer::whereDate('consumers.created_at', '>=', $task->start_date)
                        ->whereDate('consumers.created_at', '<=', $task->finish_date)
                        ->join('users', 'users.id', '=', 'consumers.ref_user_id')
                        ->select('consumers.ref_user_id', DB::raw('count(consumers.id) as bonus'))
                        ->groupBy('consumers.ref_user_id')
                        ->orderBy('bonus', 'desc')
                        ->get();

                    $i = 1;
                    foreach ($top_users as $top_user) {
                        if ($top_user->ref_user_id != auth()->user()->id) {
                            $i++;
                        } else {
                            $medal = $i;
                        }
                    }
                }
            }
        }

        $posm_deliveries = Posm_delivery::where('user_id', auth()->user()->id)
            ->whereNotNull('consumer_id')
            ->latest()
            ->get();

        $posm_balances = Posm_delivery::where('user_id', auth()->user()->id)
            ->select(DB::raw('sum(count) as sum, posm_id'))
            ->groupBy('posm_id')
            ->get();

        $posm_balance_all = Posm_delivery::where('user_id', auth()->user()->id)
            ->sum('count');



        // Log::debug($posm_balances);

        return view('promoter.account', [
            'user' => auth()->user(),
            'tasks' => $tasks,
            'posm_deliveries' => $posm_deliveries,
            'posm_balances' => $posm_balances,
            'posm_balance_all' => $posm_balance_all,
            'medal' => $medal,
        ]);
    }

    public function presentations()
    {

        $new_category = Presentation::where('category', 'new')->get();
        $all_category = Presentation::where('category', 'all')->get();

        return view('promoter.presentations', compact('new_category'), compact('all_category'));
    }

    public function educations()
    {

        $new_category = Education::where('category', 'new')->get();
        $all_category = Education::where('category', 'all')->get();

        return view('promoter.educations', compact('new_category'), compact('all_category'));
    }

    public function questions($id)
    {

        return view('promoter.questions', [
            'id' => $id,
        ]);
    }

    public function questionsajax($id)
    {
        $education = Education::where('id', $id)->first();
        $questions = json_decode($education->questions, true);
        return response()->json($questions, 200);
    }
}
