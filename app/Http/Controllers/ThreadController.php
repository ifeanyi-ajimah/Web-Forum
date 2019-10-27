<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;
use Auth;

class ThreadController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index1','index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index1()
    {
        $threadCount = Thread::count();
        // dd($threadCount);
        $threads = Thread::paginate(15);
        return view('welcome',compact('threads','threadCount'));
    }


    public function index()
    {

        $threadCount = Thread::count();
        $threads = Thread::paginate(15);
        return view('thread.index',compact('threads', 'threadCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('thread.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        'subject' => 'required|string|max:40',
        'type' => 'required|string|max:100',
        'thread' => 'required|string|max:250',
         ]);
        $data = $request->except(['_token']);
        $data['user_id'] = Auth::id();
        Thread::forceCreate($data);
        //auth()->user()->threads()->create($data);

        return redirect()->back()->with('status', 'Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show( $thread)
    {
        $threads = Thread::paginate(15);
        $threadCount = Thread::count();
        $thread = Thread::find($thread);
        return view('thread.show',compact('thread','threadCount','threads'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit( $thread)
    {
        $thread = Thread::findOrfail($thread);
        return view('thread.edit',compact('thread'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'subject' => 'required|string|max:40',
            'type' => 'required|string|max:100',
            'thread' => 'required|string|max:250',

             ]);
        $data = $request->except(['_token']);
        $thread = Thread::find($id);

        // if(auth()->user()->id !== $data['user_id'] ){
        //     abort(401, 'unauthorized');
        // }
        $this->authorize('update', $data['user_id']);

        $thread->update($data);
        return redirect()->route('thread.show',$thread->id)->with('status','UPDATED');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {
        // if(auth()->user()->id !== $thread->user_id){
        //     abort(401, 'unauthorized');
        // }

        $this->authorize('delete', $thread); //using policy to authorise
        $thread->delete();
        return redirect()->route('thread.index')->with('status','Deleted');
    }

    public function markAsSolution(Request $request)
    {

        $thread = Thread::find($request->threadId);
        $thread->solution = $request->solutionId;
        $thread->update();
        // if(request()->ajax()){
        //     return response()->json(['data' => 'Saved']);
        // }
        if($thread->update()){
           // return back()->with('status','Marked As Solution');
           return response()->json(['data' => 'Saved']);
        }

    }
}
