<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Address;
use Auth;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * View page for logged in user details which is mydetails
     */
    public function index(Request $request)
    {
        $myDetails = User::where('id',Auth::user()->id)->first();
        $totalAddress = Address::where('user_id',Auth::user()->id)->count();
        return view('user/mydetails')->with(
            [
                'myDetails' => $myDetails,
                'totalAddress' => $totalAddress,
            ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * For editdetail view page
     */
    public function editView(Request $request)
    {
        $myDetail = User::where('id',Auth::user()->id)->first();

        return view('user/editdetail')->with(
            [
                'myDetail' => $myDetail,
            ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * For update database value in user table
     */
    public function store(Request $request)
    {
        $myDetail = User::where('id', '=', $request->id)->first();
        $myDetail->name = $request->name;
        $myDetail->email = $request->email;
        $myDetail->save();

        return redirect()->route('home')->with('msg',"Successfully updated your details.");
    }

    /**
     * @param Request $request
     * @return array
     * For form validation of editdetail page
     */
    public function validateForm(Request $request)
    {
        $messages = [
            "name.required" => "Please enter name",
            "name.max" => "The name entered exceeds the maximum length ",
            "email.required" => "Please enter email address",
            "email.email" => "Please enter valid email address",
            "email.unique" => "Email already exist",
        ];
        $validateAtt = $request->validate([
            'name' => 'required|max:191',
            'email' => 'required|email|regex:^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$^|unique:address,email,' . $request->id,

        ], $messages);
        return $validateAtt;
    }

}
