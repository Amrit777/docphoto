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
            return view('invoice.update', ['model' =>  $data, 'type' => $docType]);
        } else {
            return redirect()->route('home');
        }
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
        // exec s_get_detail_data 'LP190200146'
        $result = DB::select(
            "SET NOCOUNT ON; exec s_get_detail_data ?;",
            [
                $id
            ]
        );

        if (!empty($result) && isset($result[0]->dataindex) && ($result[0]->dataindex < 0)) {
            // insert to doc_trans

            // @docid as docid,@visionid as visionid, @dataindex as dataindex,  @filename as filename, 
            // @dataurl as dataurl, @lurl as lurl


            $insertModel = new DocTrans();
            $insertModel->DocID = $result[0]->docid;
            $insertModel->VisionID = $result[0]->visionid;
            $insertModel->DataIndex = $result[0]->dataindex;
            $insertModel->DataUrl = $result[0]->dataurl; // will be changed according to file uploaded
            $insertModel->FileName = $result[0]->filename;
            $insertModel->Keterangan = $request->filled('Info4') ? $request->Info4 : "";
            $insertModel->CreateID = Auth::user()->employee_id;
            $insertModel->CreateDate = Carbon::now()->toString();
            $insertModel->isSync = 'Y';
            $insertModel->Iurl = $result[0]->lurl;
            $insertModel->save();
            // insert into doc_trans
            // (docid, visionid, dataindex, dataurl, filename, CreateDate, issync, iurl, 
            // select @docid, @visionid, @dataindex, @dataurl, @filename, getdate(), 'Y', @lurl


            print_r($result);
            die("fff");
            if (!empty($result) && isset($result[0]->iserr)) {
                if ($result[0]->iserr == 'Y') {
                    return $this->failed(["errors" => $result[0]->errmsg]);
                } elseif ($result[0]->iserr == 'N') {
                    return $this->success("Invited successfully");
                }
            }
            print_r($id);
            die("fff");
            return $id;
        }
        // something went wrong as Doc ID is not there in the DB, return home.
        // return view('invoice.update', ['model' =>  $data, 'type' => $docType]);
        return redirect()->route('home');
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
