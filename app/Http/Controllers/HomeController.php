<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Notifications\MedisoftNotification;
use Chatify\Facades\ChatifyMessenger as Chatify;
use Illuminate\Support\Str;
use Notification;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $error=0;
        $msg=null;
        if($request->email!=Auth::user()->email)
        {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phoneNumber' => 'required|regex:/(98)[0-9]{8}/',
            ]);
        }
        else
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phoneNumber' => 'required|regex:/(98)[0-9]{8}/',
        ]);
        if ($request->hasFile('avatar')) {
            // allowed extensions
            $allowed_images = Chatify::getAllowedImages();

            $file = $request->file('avatar');
            // check file size
            if ($file->getSize() < Chatify::getMaxUploadSize()) {
                if (in_array($file->getClientOriginalExtension(), $allowed_images)) {
                    // delete the older one
                    if (Auth::user()->avatar != config('chatify.user_avatar.default')) {
                        $avatar = Auth::user()->avatar;
                        if (Chatify::storage()->exists($avatar)) {
                            Chatify::storage()->delete($avatar);
                        }
                    }
                    // upload
                    $avatar = Str::uuid() . "." . $file->getClientOriginalExtension();
                    $update = User::where('id', Auth::user()->id)->update(['avatar' => $avatar]);
                    $file->storeAs(config('chatify.user_avatar.folder'), $avatar, config('chatify.storage_disk_name'));
                    $success = $update ? 1 : 0;
                } else {
                    $msg = "File extension not allowed!";
                    $error = 1;
                }
            } else {
                $msg = "File size you are trying to upload is too large!";
                $error = 1;
            }
        }
        if($error==1)
        {
            return redirect()->route('home')->with('warning',$msg);
        }
        else
        {
             $user->update(['name'=>$request->name,'email'=>$request->email,'phoneNumber'=>$request->phoneNumber]);
            return redirect()->route('home')->with('success','Profile updated successfully!'); 
        }
       
    }
    
    public function sendNotification(Request $request)
    {
        $user = User::find($request['id']);
  
        
        $details = [
            'greeting' => 'Hi '.$user->name,
            'body' => $request['disease'].' is spreading in your area as per the report submitted by our users. We recommend you to apply precaution measures.',
            'thanks' => 'Thank you for using Medisoft',
            'actionText' => 'Know about this disease',
            'actionURL' => url('https://openmd.com/search?q='.$request['disease']),
        ];
  
        Notification::send($user, new MedisoftNotification($details));
    }

    public function friendRequestNotification(Request $request)
    {
        $user = User::find($request['first_user']);
        $user2= User::find($request['second_user']);
        $details = [
            'greeting' => 'Hi '.$user->name,
            'body' => $user2->name.' has accepted your friend request.',
            'thanks' => 'Thank you for using Medisoft',
            'actionText' => 'Visit Medisoft',
            'actionURL' => url('/'),
        ];
        Notification::send($user, new MedisoftNotification($details));
        return redirect()->back()->with('success','You are now friends');
    }

    public function getNotifications()
    {
        $user=Auth::user();
        $notifications = $user->notifications->sortByDesc('created_at');
        return view('notification',compact('notifications'));
    }
    public function readNotifications()
    {
             $user=Auth::user();
            $notifications = $user->notifications;
            $notifications->markAsRead();
        return redirect()->route('notifications');
    }
    public function readNotificationsSingle($notificationId)
    {
        $user=Auth::user();
        $notification=$user->notifications->where('id',$notificationId);
        $notification->markAsRead();

        return redirect()->route('notifications');
    }

}
