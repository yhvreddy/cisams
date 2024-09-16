<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TotalPOH extends Model
{
    use HasFactory;

    protected $table = "Sample_Total_POH";

    protected $fillable = [
        'S No',
        'NCRP Ack No',
        'District',
        'Police Station',
        'Status',
        'Amount Lost',
        'Amount POH',
        'Bank',
        'Date of Action'
    ];
}
