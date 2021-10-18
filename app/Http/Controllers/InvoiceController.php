<?php

namespace App\Http\Controllers;

use App\Models\DocMaster;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
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

        $result = DocMaster::where("isFinal", "N")->where("doctype", $docType)->orderBy('DocDate', 'DESC')->take(10)->get();
        return $result;

        // select DocId, DocDate, Info1, Info2, Info3, isFinal from doc_master 
        // where isFinal = 'N' and doctype = @doctype
        // order by docdate desc

        // @doctype = (Good Received, Purchase Invoice, Logistic Purchase)
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
        //
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
        //
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
