<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalInformation extends Model
{
    use HasFactory;

    protected $table = "Sample_Additional_Information";

    protected $fillable = [
        'Acknowledgement No',
        'Account No',
        'ATM ID',
        'Latitude',
        'Longitude',
        'ATM address',
        'District',
        'State',
        'Amount',
        'layers',
        'date of download'
    ];
}
