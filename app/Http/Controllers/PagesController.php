<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\Request as UpdatedRequest;
use Image;
use Session;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.index');
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userRequest = UpdatedRequest::find($id);
        if ($userRequest != null) {
            $statusRequest = true;
            return view('pages.show')->withStatusRequest($statusRequest);
        }

        $profile = Profile::find($id);
        return view('pages.show')->withProfile($profile);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userRequest = UpdatedRequest::find($id);
        if ($userRequest != null) {
            return redirect()->route('user.show', $id);
        }

        $profile = Profile::find($id);
        return view('pages.edit')->withProfile($profile);
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
        $profile = Profile::find($id);
        if (!isset($profile->image)) {
            $request->validate([
                'name' => 'required|max:255',
                'phone' => 'required|numeric|',
                'birthday' => 'required|date',
                'identity_card_number' => "required|regex:/^[A-Z]{1}[1-2]{1}[0-9]{8}$/|size:10|unique:profiles,identity_card_number,$id",
                'sex' => 'required|in:1,2',
                'married' => 'required|boolean',
                'image' => 'required|image',
                'email' => 'required|email|max:255',
                'address' => 'required|max:255',
                'on_board' => 'required|date',
                'off_board' => 'nullable|date',
            ]);
        } else {
            $request->validate([
                'name' => 'required|max:255',
                'phone' => 'required|numeric|',
                'birthday' => 'required|date',
                'identity_card_number' => "required|regex:/^[A-Z]{1}[1-2]{1}[0-9]{8}$/|size:10|unique:profiles,identity_card_number,$id",
                'sex' => 'required|in:1,2',
                'married' => 'required|boolean',
                'image' => 'sometimes|image',
                'email' => 'required|email|max:255',
                'address' => 'required|max:255',
                'on_board' => 'required|date',
                'off_board' => 'nullable|date',
            ]);
        }

        // post request data
        $userRequest = new UpdatedRequest;
        $userRequest->id = $id;
        $userRequest->name = $request->name;
        $userRequest->phone = $request->phone;
        $userRequest->birthday = $request->birthday;
        $userRequest->identity_card_number = $request->identity_card_number;
        $userRequest->sex = $request->sex;
        $userRequest->married = $request->married;          
            // image process
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time().'.'.$image->extension();
            $location = storage_path('app/photos/'.$filename);
            Image::make($image)->resize(300, 420)->save($location);
            $userRequest->image = $filename;
        } else {
            $userRequest->image = $profile->image;
        }

        $userRequest->email = $request->email;
        $userRequest->address = $request->address;
        $userRequest->on_board = $request->on_board;
        $userRequest->off_board = $request->off_board;
        $userRequest->save();

        Session::flash('success', "Your updated request has successfully been submitted！");
        return redirect()->route("user.show", $id);
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
