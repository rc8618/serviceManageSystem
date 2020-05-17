<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Address;
use App\Country;
use Auth;

class AddressManageController extends Controller
{
    /**
     * Listing funcrion for the Address Management
     */
    public function index(Request $request)
    {
        $viewAddress = Address::where('user_id', Auth::user()->id)->get();

        $columns = [
            'index' => '#',
            'name' => 'Name',
            'email' => 'Email',
            'created_at' => 'Created At',
            'action' => 'Action'
        ];

        $index = 1;
        return view('address/index')->with(
            [
                'viewAddress' => $viewAddress,
                'columns' => $columns,
                'index' => $index,
            ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Function for the view page of add new address
     */
    public function addView()
    {
        $country = Country::all();
        return view('address/addEdit')->with('country', $country);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * For add and edit database value of address
     */
    public function store(Request $request)
    {

        $this->validateForm($request);

        if ($request->id) {
            //For edit address
            $address = Address::where('id', '=', $request->id)->first();
            $msg = "Address updated Successfully.";
        } else {
            //For new address
            $address = new Address;
            $msg = "Address added Successfully.";
        }
        $address->name = $request->name;
        $address->user_id = Auth::user()->id;
        $address->email = $request->email;
        $address->street = $request->street;
        $address->phone_no = $request->phone_no;
        $address->country_id = $request->country_id;

        //Encode data of checkbox in json for store in the database
        $address->services = json_encode($request->services);
        $address->save();

        return redirect()->route('addressIndex')->with('msg', $msg);

    }

    /**
     * @param Request $request
     * @return array
     * For form validation of add and edit address form
     */
    public function validateForm(Request $request)
    {
        $messages = [
            "name.required" => "Please enter name",
            "name.max" => "The name entered exceeds the maximum length ",
            "email.required" => "Please enter email address",
            "email.email" => "Please enter valid email address",
            "email.unique" => "Email already exist",
            "street.required" => "Please enter street",
            "street.max" => "The street entered exceeds the maximum length ",
            "phone_no.required" => "Please enter phone no",
            "phone_no.digits" => "Phone no must be in 10 digits",
            "phone_no.numeric" => "Please enter valid phone No.",
            "country_id.required" => "Please select country",
            "country_id.not_in" => "Please select country",
            "services.required" => "Please select service",
        ];
        $validateAtt = $request->validate([
            'name' => 'required|max:191',
            'email' => 'required|email|regex:^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$^|unique:address,email,' . $request->id,
            'street' => 'required|max:191',
            'phone_no' => 'required|numeric|digits:10',
            'country_id' => 'required|not_in:0',
            'services' => 'required|array|min:1',

        ], $messages);
        return $validateAtt;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * For edit view page
     */
    public function editView(Request $request)
    {
        $addressDetail = Address::where('id', $request->id)->first();

        //If id is not getting than display 404 page
        if (!isset($addressDetail)){
            return view('errors/404');
        }

        //Decode data from json for services checkboxes
        $addressServices = json_decode($addressDetail->services);
        $country = Country::all();
        return view('address/addEdit')->with(['addressDetail' => $addressDetail, 'country' => $country, 'addressServices' => $addressServices]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * For delete particular address
     */
    public function delete(Request $request)
    {
        $deleteAddress = Address::find($request->id)->delete();
        return redirect()->route('addressIndex')->with('msg', "Address deleted Successfully.");
    }
}
