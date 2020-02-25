<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Profile;
use App\Transaction;
use App\Request as UpdatedRequest;
use App\User;
use Session;
use Image;
use Storage;

class AdminPagesController extends Controller
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
        $users = User::orderBy('updated_at', 'desc')->get(['id', 'name', 'email']);
        return view('admin_pages.index')->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // validate data
        $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required|numeric|',
            'birthday' => 'required|date',
            'identity_card_number' => 'required|regex:/^[A-Z]{1}[1-2]{1}[0-9]{8}$/|size:10|unique:profiles,identity_card_number',
            'sex' => 'required|between:0,2',
            'married' => 'required|boolean',
            'image' => 'required|image',
            'email' => 'required|email|max:255',
            'address' => 'required|max:255',
            'on_board' => 'required|date',
            'off_board' => 'nullable|date',
        ]);
        
        // post data
        $profile = new Profile;
        $profile->name = $request->name;
        $profile->phone = $request->phone;
        $profile->birthday = $request->birthday;
        $profile->identity_card_number = $request->identity_card_number;
        $profile->sex = $request->sex;
        $profile->married = $request->married;          
            // image process
        $image = $request->file('image');
        $filename = time().'.'.$image->extension();
        $location = storage_path('app/photos/'.$filename);
            // width, height
        Image::make($image)->resize(300, 420)->save($location);
        $profile->image = $filename;
        $profile->email = $request->email;
        $profile->address = $request->address;
        $profile->on_board = $request->on_board;
        $profile->off_board = $request->off_board;
        try { 
            $profile->save();
        } catch(\Illuminate\Database\QueryException $ex){ 
            $errors = $ex->getMessage(); 
            return redirect()->route('admin.create')->withErrors($errors);
        }

        Session::flash('success', 'The user profile was successfully saved！');
        return redirect()->route('admin.index');
    }   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = Profile::find($id);
        return view('admin_pages.show')->withProfile($profile);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = Profile::find($id);
        return view('admin_pages.edit')->withProfile($profile);
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
        // validate data
        $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required|numeric|',
            'birthday' => 'required|date',
            'identity_card_number' => "required|regex:/^[A-Z]{1}[1-2]{1}[0-9]{8}$/|size:10|unique:profiles,identity_card_number,$id",
            'sex' => 'required|between:0,2',
            'married' => 'required|boolean',
            'image' => 'sometimes|image',
            'email' => 'required|email|max:255',
            'address' => 'required|max:255',
            'on_board' => 'required|date',
            'off_board' => 'nullable|date',
        ]);

        // post data
        $profile = Profile::find($id);
        $profile->name = $request->name;
        $profile->phone = $request->phone;
        $profile->birthday = $request->birthday;
        $profile->identity_card_number = $request->identity_card_number;
        $profile->sex = $request->sex;
        $profile->married = $request->married;          
            // image process
        if ($request->hasFile('image')) {
            // add the new photo
            $image = $request->file('image');
            $filename = time().'.'.$image->extension();
            $location = storage_path('app/photos/'.$filename);
            Image::make($image)->resize(300, 420)->save($location);
            // update the database
            $oldFilename = $profile->image;
            $profile->image = $filename; 
            // delete the old photo
            Storage::disk('photos')->delete($oldFilename);
        }
        
        $profile->email = $request->email;
        $profile->address = $request->address;
        $profile->on_board = $request->on_board;
        $profile->off_board = $request->off_board;
        $profile->save();

        Session::flash('success', 'The user profile was successfully updated！');
        return redirect()->route("admin.show", $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $request = UpdatedRequest::find($id);
        if ($request != null) {
            $errors = "This user has updated request need to be checked！";
            return redirect()->route("admin.show", $id)->withErrors($errors);
        }

        $profile = Profile::find($id);
        // 記錄
        $transaction = new Transaction;
        $transaction->user_id = $profile->id;
        $transaction->name = $profile->user->name;
        $transaction->image = $profile->image;
        $transaction->email = $profile->user->email;
        $transaction->sex = $profile->sex;
        $transaction->identity_card_number = $profile->identity_card_number;
        $transaction->phone = $profile->phone;
        $transaction->address = $profile->address;
        $transaction->married = $profile->married;
        $transaction->birthday = $profile->birthday;
        $transaction->on_board = $profile->on_board;
        $transaction->off_board = $profile->off_board;
        $transaction->status_id = 3;
        $transaction->admin_id = Auth::guard('admin')->user()->id;
        $transaction->save();
        // 刪除profile
        $profile->delete();
        // 刪除user
        $user = User::find($id);
        $user->delete();

        Session::flash('success', 'The user profile was successfully deleted');
        return redirect()->route('admin.index');
    }
}
