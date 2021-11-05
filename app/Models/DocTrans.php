<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

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

    public static function saveImage($image, $foldername, $docid = null)
    {
        $imageExtension = $image->getClientOriginalExtension();
        $imageName = $image->getClientOriginalName();
        $imageName = pathinfo($imageName);
        $imageNameWE = preg_replace('/\s+/', '_', $imageName['filename']);
        $imageName = $imageNameWE . '.' . $imageExtension;

        $first = 1;
        $separator = '-';
        $docpath = '';
        if ($docid) {
            $docpath = '/' . $docid;
        }
        $foldername = str_replace(' ', '_', $foldername);

        while (file_exists(storage_path() . '/app/public/' . $foldername . $docpath . '/' . $imageName)) {
            preg_match('/(.+)' . $separator . '([0-9]+)$/', $imageName, $match);
            $imageName = isset($match[2]) ? $match[1] . $separator . ($match[2] + 1) : $imageNameWE . $separator . $first;
            $first++;
            $imageName = $imageName . '.' . $imageExtension;
        }

        $imagepath = storage_path() . '/app/public/' . $foldername . '/' . $docid;

        if ($image->move($imagepath, $imageName)) {
            $return_path = '/' . $foldername . $docpath . '/' . $imageName;
            return [
                'filename' => $imageName,
                'lurl' => URL::to('/') . "/storage" . $return_path
            ];
        }
        return false;
    }

    public static function storagePath($image)
    {
        return storage_path() . '/app/public/' . $image;
    }

    public static function public_path($path = '')
    {
        return env('PUBLIC_PATH', base_path('public')) . ($path ? '/' . $path : $path);
    }
}
