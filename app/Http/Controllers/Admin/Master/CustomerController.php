<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Customer\CustomerResponse;

class CustomerController extends Controller
{

    protected $CustomerResponse ;
    public function __construct(CustomerResponse  $CustomerResponse )
    {
        $this->CustomerResponse  = $CustomerResponse ;
    }

    public function index(Request $request)
    {
        if($request->ajax()) {
            $result = $this->CustomerResponse->datatable();
                return DataTables::of($result)
                                ->addIndexColumn(['address'])

                                ->addColumn('delete', function ($delete) {
                                    return  '
                                                <button class="btn btn-danger btn-sm"
                                                        style="--bs-btn-padding-y: .25rem;
                                                        --bs-btn-padding-x: .5rem;
                                                        --bs-btn-font-size: .65rem;">
                                                    Delete
                                                </button>
                                            ';
                                })
                                ->rawColumns(['delete'])
                                ->escapeColumns(['delete'])
                                ->smart(true)
                                ->make();
        }
            return view('master.customer.index');
    }
}
