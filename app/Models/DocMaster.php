<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocMaster extends Model
{
    use HasFactory;

    protected $table = "doc_master";

    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'DocDate',
        'DocId',
        'Info1',
        "Info2",
        "Info3",
        "isFinal"
    ];
}
