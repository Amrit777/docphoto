<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocMaster extends Model
{
    use HasFactory;

    protected $table = "doc_master";
    public $timestamps = false;

    protected $fillable = [
        'DocID',
        'DocType',
        'DocDate',
        'Info1',
        "Info2",
        "Info3",
        "isSync",
        "SyncDate",
        "isFinal",
        "FinalDate",
        "CreateID",
        "CreateDate",
        "CreateIP",
        "Info4"
    ];
}