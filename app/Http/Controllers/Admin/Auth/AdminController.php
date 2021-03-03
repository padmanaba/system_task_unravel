<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Items;
use App\Transaction;
use Response;
use DataTables;
use Validator;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('admin:auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function items(Request $request)
    {
        if ($request->ajax()) {
            $data = Items::get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $view = '<a href="'.url('admin/view_item/'.$row->id).'" class="edit btn btn-primary btn-sm" style="margin-right:10px;">View</a>';
                           $edit = '<a href="'.url('admin/edit_item/'.$row->id).'" class="edit btn btn-secondary btn-sm edit_item" style="margin-right:10px;">Edit</a>';
                           $delete = '<a href="'.url('admin/delete_item/'.$row->id).'" class="edit btn btn-danger btn-sm">Delete</a>';


                            return $view.$edit.$delete;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }


        return view('admin.items.view');
    }


    public function add_item(Request $request)
    {

        if(!$_POST)
        {
            return view('admin.items.add');
        }
        else
        {
            $rules = array(
                'item_name'        => 'required',
                'status'        => 'required',
                'item_description'     => 'required',
                'item_amount'     => 'required|integer',
                'item_image'            => 'required|mimes:jpg,jpeg,png,gif|max:1024',
                );


                $niceNames = array(
                    'status'        => 'status',
                    'item_name'     => 'itemname',
                    'item_image'    => 'itemimage',
                    'item_amount'    => 'Amount',
                    'item_description'            =>  'description',

                    );
            // Edit Rider Validation Custom Fields message
        $messages =array(
                    'required'            => ':attribute is required.',
                    );
        $validator = Validator::make($request->all(), $rules,$messages);

        $validator->setAttributeNames($niceNames);

        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput(); // Form calling with Errors and Input values
        }

        else
        {
            $item =  new Items;

            $item->item_name = $request->item_name;
            $item->item_description = $request->item_description;
            $item->status = $request->status;
            $item_image = $request->file('item_image');
            $item->item_amount = $request->item_amount;


            $path = dirname($_SERVER['SCRIPT_FILENAME']).'/images/items/';

            if(!file_exists($path)) {
                mkdir(dirname($_SERVER['SCRIPT_FILENAME']).'/images/items/', 0777, true);
            }
            if($item_image){
                $item_image_extension      =   $item_image->getClientOriginalExtension();
                $item_image_filename       =   'item_image' . time() . '.' . $item_image_extension;

                 $success = $item_image->move('images/items/', $item_image_filename);

                if(!$success)
                    return back()->withError('Failed to Upload');
                 $item->item_image       =url('images/items').'/'.$item_image_filename;
            }
            $item->save();

            return Redirect('admin/items');

        }

        }

    }

    public function view_item(Request $request)
    {
        $item = Items::find($request->id);

        return view('admin.items.list',compact('item'));
    }

    public function edit_item(Request $request)
    {

        if(!$_POST)
        {
            $item = Items::find($request->id);
            return view('admin.items.edit',compact('item'));
        }
        else
        {
            $rules = array(
                'item_name'        => 'required',
                'status'        => 'required',
                'item_description'     => 'required',
                'item_amount'     => 'required|integer',

                );


                $niceNames = array(
                    'status'        => 'status',
                    'item_name'     => 'itemname',
                    'item_amount'    => 'Amount',
                    'item_description'            =>  'description',

                    );
            // Edit Rider Validation Custom Fields message
        $messages =array(
                    'required'            => ':attribute is required.',
                    );
        $validator = Validator::make($request->all(), $rules,$messages);

        $validator->setAttributeNames($niceNames);

        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput(); // Form calling with Errors and Input values
        }

        else
        {
            $item =  Items::find($request->id);

            $item->item_name = $request->item_name;
            $item->item_description = $request->item_description;
            $item->status = $request->status;
            $item_image = $request->file('item_image');
            $item->item_amount = $request->item_amount;


            $path = dirname($_SERVER['SCRIPT_FILENAME']).'/images/items/';

            if(!file_exists($path)) {
                mkdir(dirname($_SERVER['SCRIPT_FILENAME']).'/images/items/', 0777, true);
            }
            if($item_image){
                $item_image_extension      =   $item_image->getClientOriginalExtension();
                $item_image_filename       =   'item_image' . time() . '.' . $item_image_extension;

                 $success = $item_image->move('images/items/', $item_image_filename);

                if(!$success)
                    return back()->withError('Failed to Upload');
                 $item->item_image       =url('images/items').'/'.$item_image_filename;
            }
            $item->save();

            return Redirect('admin/items');

        }

        }

    }

    public function delete_item(Request $request)
    {
        $item = Items::find($request->id)->delete();
        return Redirect('admin/items');
    }



    // Customers

    public function customers(Request $request)
    {
        if ($request->ajax()) {
            $data = User::get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $view = '<a href="'.url('admin/view_customer/'.$row->id).'" class="edit btn btn-primary btn-sm" style="margin-right:10px;">View</a>';


                            return $view;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }


        return view('admin.customers.view');
    }

    public function view_customer(Request $request)
    {
        $user = User::find($request->id);

        return view('admin.customers.list',compact('user'));
    }


     // Customers

     public function transactions(Request $request)
     {
         if ($request->ajax()) {
             $data = Transaction::with('user','item')->get();
             return Datatables::of($data)
                     ->addIndexColumn()
                     ->addColumn('action', function($row){
                            $view = '<a href="'.url('admin/view_transaction/'.$row->id).'" class="edit btn btn-primary btn-sm" style="margin-right:10px;">View</a>';


                             return $view;
                     })
                     ->rawColumns(['action'])
                     ->make(true);
         }


         return view('admin.transactions.view');
     }

     public function view_transaction(Request $request)
     {
         $transaction = Transaction::with('user','item')->find($request->id);

         return view('admin.transactions.list',compact('transaction'));
     }

}
