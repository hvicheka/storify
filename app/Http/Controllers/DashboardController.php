<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Story;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyAdmin;
use App\Mail\NewStoryNotification;

class DashboardController extends Controller
{
    private $paginate = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //DB::enableQueryLog();
        $sql = Story::where('status',1);
        $type = request()->input('type');
        if(in_array($type,['short','long'])){
            $sql->where('type',$type);
        }
        $stories = $sql->with('user')
                    ->orderBy('id','DESC')
                    ->paginate($this->paginate);
        return view('dashboard.index',[
            'stories' => $stories
        ]);
    }

    public function show(Story $activeStory){  
        //dd($story);
        return view('dashboard.show',[
            'story' => $activeStory
        ]);
    }

    public function email(){
        // Mail::raw('This is the test mail', function ($message) {
        //     //$message->from('john@johndoe.com', 'John Doe');
        //     //$message->sender('john@johndoe.com', 'John Doe');
        //     $message->to('admin@localhost.com', 'John Doe');
        //     //$message->cc('john@johndoe.com', 'John Doe');
        //     //$message->bcc('john@johndoe.com', 'John Doe');
        //     //$message->replyTo('john@johndoe.com', 'John Doe');
        //     $message->subject('New story as added');
        //     //$message->priority(3);
        //     //$message->attach('pathToFile');
            
        // });
        //Mail::send( new NotifyAdmin('The title of story'));
        Mail::send( new NewStoryNotification('The title of story'));
    }
}
