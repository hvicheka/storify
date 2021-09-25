<?php

namespace App\Http\Controllers;


use App\Story;
use App\Http\Requests\StoryRequest;
use Illuminate\Support\Facades\Mail;

use App\Mail\NewStoryNotification;

class StoriesContoller extends Controller
{
    private $paginate = 10;

    public function __construct(){
        $this->authorizeResource(Story::class,'story');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $stories = Story::where('user_id',auth()->user()->id)
                    ->orderBy('id','DESC')
                    ->paginate($this->paginate);
        return view('stories.index',[
            'stories' => $stories
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('create');
        $story = new Story;
        return view('stories.create',[
            'story' => $story
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoryRequest $request)
    {
        $story = auth()->user()->stories()->create($request->all());
        Mail::send( new NewStoryNotification($story->title));
        return redirect()->route('stories.index')->with('status', 'Story Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Story $story){
        return view('stories.show',[
            'story' => $story
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Story $story)
    {
        return view('stories.edit',[
            'story' => $story
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Story $story
     * @return \Illuminate\Http\Response
     */
    public function update(StoryRequest $request, Story $story)
    {
        // $this->authorize('update',$story);
        $story->update( $request->all() );
        return redirect()->route('stories.index')->with('status', 'Story Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Story $story)
    {
        $story->delete();
        return redirect()->route('stories.index')->with('status', 'Story Deleted Successfully');
    }
}
