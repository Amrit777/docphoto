<?php

namespace App\Http\Controllers;

use App\DataTables\InvoiceDataTable;
use App\Models\DocMaster;
use App\Models\DocTrans;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type, Request $request)
    {

        $docType = null;
        if ($type == 'purchase') {
            $docType = 'Purchase Invoice';
        }
        if ($type == 'logistic') {
            $docType = 'Logistic Purchase';
        }
        if ($type == 'do') {
            $docType = 'Good Received';
        }

        if (!empty($docType)) {

            if ($request->ajax()) {
                $search = $request->input('search.value');
                $data = DocMaster::select('*')->where("isFinal", "N")->where("DocType", $docType)
                    ->orderBy('DocDate', 'DESC');

                // if filter
                if (!empty($search)) {
                    $data = $data->where('DocID', 'LIKE', '%' . $search . '%');
                    $data = $data->orWhere('Info1', 'LIKE', '%' . $search . '%');
                }

                $totalData = $data->count();
                $totalFiltered = $totalData;

                $limit = ($request->length) ? $request->length : 10;
                $start = ($request->start) ? $request->start : 0;
                $data = $data->skip($start)->take($limit)->get();

                return Datatables::of($data)
                    ->setOffset($start)
                    ->with(['recordsTotal' => $totalData, "recordsFiltered" => $totalFiltered, 'start' => $start])
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('invoice.detail', $row->DocID) . '" class="edit btn btn-primary btn-sm">View</a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        } else {
            return redirect()->route('home');
        }
        return view('invoice.list', ['docType' =>  $docType, 'type' => $type]);
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
        $data = DocMaster::where("DocID", $id)->first();

        if (!empty($data)) {
            $doctransdata = DocTrans::where('DocID', $id)->first();
            $docType = null;
            if ($data->DocType == 'Purchase Invoice') {
                $docType = 'purchase';
            }
            if ($data->DocType == 'Logistic Purchase') {
                $docType = 'logistic';
            }
            if ($data->DocType == 'Good Received') {
                $docType = 'do';
            }
            return view(
                'invoice.update',
                [
                    'model' =>  $data,
                    'type' => $docType,
                    'transData' => $doctransdata,
                    'lurl' => !empty($data->trans) ? $data->trans->Iurl : ""
                ]
            );
        }
        \Session::flash('error', "Invalid Data Provided!");
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $data = DocMaster::where("DocID", $id)->first();
        if (!empty($data)) {
            $result = DB::select(
                "SET NOCOUNT ON; exec s_get_detail_data ?;",
                [
                    $id
                ]
            );

            if (!empty($result) && isset($result[0]->dataindex) && !($result[0]->dataindex < 0)) {
                $uploadedImage = '';
                if ($request->hasFile('image')) {
                    $uploadedImage = DocTrans::saveImage($request->image, $data->DocType, $id);
                    if (empty($uploadedImage)) {
                        \Session::flash('error', "Something went wrong while saving data. Please try again.");
                        return back();
                    }
                }

                $check  = DocTrans::where('DocID', $id)->where('VisionID', $result[0]->visionid)->first();

                $insertData = [
                    'DataIndex' => $result[0]->dataindex,
                    'DataUrl' => URL::to('/'),
                    'FileName' => !empty($uploadedImage) ? $uploadedImage['filename'] : (!empty($check) ? $check->FileName : ""),
                    'Keterangan' => $request->filled('Keterangan') ? $request->Keterangan : "",
                    'CreateID' => Auth::user()->employee_id,
                    'CreateDate' => Carbon::now()->toDateTimeString(),
                    'isSync' => 'Y',
                    'Iurl' => !empty($uploadedImage) ? $uploadedImage['lurl'] : (!empty($check) ? $check->Iurl : "")
                ];

                if (!empty($check)) {
                    DocTrans::where('DocID', $id)->where('VisionID', $result[0]->visionid)->update(
                        $insertData
                    );
                } else {
                    $insertData['DocID'] =  $id;
                    $insertData['VisionID'] =  $result[0]->visionid;
                    $insertModel = new DocTrans();
                    $insertModel->create($insertData);
                }
                \Session::flash('success', "Record updated successfully");
                return back();
            }
        }
        \Session::flash('error', "Invalid Data Provided!");
        return back();
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
