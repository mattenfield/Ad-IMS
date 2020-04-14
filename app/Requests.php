<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    protected $fillable = ['itemDescription', 'iventoryID', 'photoEvidenceUploadLink', 'uploaded', 'approved', 'requestbyname', 'requestbyID'];
}
