<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Presonertask;
use App\Models\Task;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PresonertaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        // Initialize collections to avoid null errors
        $tasks = collect(); 
        $task_data = collect(); 
        $pin_data = collect(); 
        $ass_data = collect();
      

        if ($request->has('date') && $request->filled('date')) {
            $date = $request->input('date');

            // Fetch tasks for the given date
            $tasks = Presonertask::whereDate('date', $date)->get();

            // Extract related data
            $task_data = Task::whereIn('id', $tasks->pluck('task_id'))->get();
            $pin_data = User::whereIn('id', $tasks->pluck('pin_no'))->get();
            $ass_data = User::whereIn('id', $tasks->pluck('ass_id'))->get();
            
            // Extract role_ids from assignees (ass_data)
            $role_ids = $ass_data->pluck('role_id')->unique();
            
            
        }

        return view('presonertasks.index', compact('tasks', 'task_data', 'pin_data', 'ass_data'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    public function assaignTask()
    {
        $tasks = Task::all();
        $users = User::where('role_id', 4)->select('id', 'first_name', 'last_name')->get();
        return view('presonertasks.create', compact('tasks', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'task_id' => 'required',
            'pin_no' => 'required',
            'date' => 'required|date',
            'start_at' => 'required',
            'end_at' => 'required',
            'ass_id' => 'required',
        ]);

        Presonertask::create($request->all());
        return back()->with('status', 'Task assigned successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Presonertask::findOrFail($id);
        $tasks = Task::all();
        $users = User::where('role_id', 4)->select('id', 'first_name', 'last_name')->get();

        return view('presonertasks.edit', compact('task', 'tasks', 'users'));
    }



    public function evaluation()
    {
        $preasonartaskData = 'No task found';
        return view('presonertasks.evaluate', compact('preasonartaskData'));
    }

    public function evaluationData(Request $request)
    {
        $currentDate = Carbon::now()->toDateString();
        $preasonartask = Presonertask::where('pin_no', $request->pin_no)
            ->where('date', $currentDate)
            ->first();
        if (!$preasonartask) {
            $preasonartaskData = 'No task found';
        }else{
            $task_data = Task::where('id', $preasonartask->task_id)->get();
            $prisonar_data = User::where('id', $request->pin_no)->get();
            $preasonartaskData = [
                'task_data' => $task_data,
                'prisonar_data' => $prisonar_data,
                'prisonar_task' => $preasonartask,
            ];
        }

        return view('presonertasks.evaluate', compact('preasonartaskData'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'task_id' => 'required',
            'pin_no' => 'required',
            'date' => 'required|date',
            'start_at' => 'required',
            'end_at' => 'required',
            'description' => 'nullable|string',
            'remarks' => 'nullable|string',
            'task_status' => 'nullable|string',
        ]);
    
        $task = Presonertask::findOrFail($id);
        $task->update($request->all());

        return back()->with('status', 'Task modifyed successfully');
    }


    public function updateEval(Request $request, $id)
    {
        $request->validate([
            'marks' => 'required',
            'task_status' => 'required',
        ]);

        $task = Presonertask::findOrFail($id);
        $task->update($request->all());

        return back()->with('status', 'Task evaluation Submited successfully');
    }



    public function report(Request $request){
        // Initialize collections to avoid null errors
        $tasks = collect(); 
        $task_data = collect(); 
        $pin_data = collect(); 
        $ass_data = collect();
      

        if ($request->has('date') && $request->filled('date')) {
            $date = $request->input('date');

            // Fetch tasks for the given date
            $tasks = Presonertask::whereDate('date', $date)->get();

            // Extract related data
            $task_data = Task::whereIn('id', $tasks->pluck('task_id'))->get();
            $pin_data = User::whereIn('id', $tasks->pluck('pin_no'))->get();
            $ass_data = User::whereIn('id', $tasks->pluck('ass_id'))->get();
            
            // Extract role_ids from assignees (ass_data)
            $role_ids = $ass_data->pluck('role_id')->unique();
            
            
        }

        return view('presonertasks.report', compact('tasks', 'task_data', 'pin_data', 'ass_data'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}