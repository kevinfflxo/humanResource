<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Request as UpdatedRequest;
use App\Profile;
use App\Log;
use App\User;
use Image;
use Session;
use Storage;
use Auth;

class AdminNotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $updatedRequests = UpdatedRequest::orderBy('updated_at', 'desc')->get(['id', 'name', 'email']);
        return view('admin_notifications.index')->withUpdatedRequests($updatedRequests);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $updatedRequest = UpdatedRequest::find($id);
        return view('admin_notifications.show')->withUpdatedRequest($updatedRequest);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $updatedRequest = UpdatedRequest::find($id);
        return view('admin_notifications.edit')->withUpdatedRequest($updatedRequest);
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
        // update profile data
        $updatedRequest = UpdatedRequest::find($id);
        $profile = Profile::find($id);
        $user = User::find($id);

        $user->name = $updatedRequest->name;
        $profile->phone = $updatedRequest->phone;
        $profile->birthday = $updatedRequest->birthday;
        $profile->identity_card_number = $updatedRequest->identity_card_number;
        $profile->sex = $updatedRequest->sex;
        $profile->married = $updatedRequest->married;
        if ($updatedRequest->image != $profile->image) {
            // delete the old photo
            Storage::disk('photos')->delete($profile->image);
            Storage::disk('photos')->delete("origin-".$profile->image);
            $profile->image = $updatedRequest->image;
        }
        $user->email = $updatedRequest->email;
        $profile->address = $updatedRequest->address;
        $profile->on_board = $updatedRequest->on_board;
        $profile->off_board = $updatedRequest->off_board;
        $profile->save();
        $user->save();

        // delete request data
        $updatedRequest->delete();

        // trait
        $log = new Log;
        $arr = [
            'name' => $profile->user->name,
            'phone' => $profile->phone,
            'birthday' => $profile->birthday,
            'identity_card_number' => $profile->identity_card_number,
            'sex' => $profile->sex,
            'married' => $profile->married,
            'image' => $profile->image,
            'email' => $profile->user->email,
            'address' => $profile->address,
            'on_board' => $profile->on_board,
            'off_board' => $profile->off_board,
            'user_id' => $profile->id,
            'status' => 'update',
            'admin_id' => Auth::guard('admin')->user()->id
        ];
        $log->json = json_encode($arr);
        $log->save();

        Session::flash('success', "The user's profile has successfully been updated！");
        return redirect()->route("admin.notification.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $updatedRequest = UpdatedRequest::find($id);
        $profile = Profile::find($id);
        if ($updatedRequest->image != $profile->image) {
            Storage::disk('photos')->delete("origin-".$updatedRequest->image);
            Storage::disk('photos')->delete($updatedRequest->image);
        }
        $updatedRequest->delete();

        Session::flash('success', "This user's updated request has successfully been deleted");
        return redirect()->route("admin.notification.index");
    }
}
