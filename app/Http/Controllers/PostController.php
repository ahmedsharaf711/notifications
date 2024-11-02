<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Notifications\CreatePost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use User as GlobalUser;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $post = Post::create([
            'title' => $request->title,
            'body' => $request->body
        ]);
        $user = Auth::user()->name;
        $users = User::where('id', '!=', Auth::user()->id)->get();
        Notification::send($users , new CreatePost($post->id ,Auth::user()->id, $post->title ));
        return redirect()->route()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $post = Post::find($id);
        

  $id = DB::table('notifications')
            ->where('data->post_id', '=', $id) // استبدل $userId بالمعرف الفعلي
            ->pluck('id');
            
            
            DB::table('notifications')->where('id', '='  , $id) ->update(['read_at' => now()]);
            return $post;
    }

    public function markAsRead()
    {
        $user = User::find(Auth::user()->id);
        foreach($user->unreadNotifications as $notification)
        {
           $notification->markAsRead();
        }
        return 'mark as read';
    }


    public function delete()
    {
        $user = User::find(Auth::user()->id);
        foreach($user->unreadNotifications as $notification)
        {
           $notification->delete();
        }
        return 'all deleted';
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
