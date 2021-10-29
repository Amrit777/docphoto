<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocTrans extends Model
{
    use HasFactory;

    protected $table = "doc_trans";
    public $timestamps = false;

    protected $fillable = [
        'DocID',
        'VisionID',
        'DataIndex',
        'DataUrl',
        "FileName",
        "Keterangan",
        "CreateID",
        "CreateDate",
        "CreateIp",
        "isSync",
        "Iurl",
        "isAdminCheck",
        "AdminCheckID",
        "AdminCheckDate",
        'isAuditorCheck',
        'AuditorCheckID',
        'AuditorCheckDate'
    ];
}
