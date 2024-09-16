<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalInformation extends Model
{
    use HasFactory;

    protected $table = "Sample_Additional_Information";

    protected $fillable = [
        'Acknowledgement_No',
        'State_Name',
        'District_Name',
        'Police_Station',
        'Crime_Aditional_Information',
        'Category',
        'Sub_Category',
        'Status',
        'Incident_Date',
        'Complaint_Date',
        'Last_Action_Taken_on',
        'Suspect_Name',
        'Suspect_Id_No',
        'Fraudulent_Amount',
        'Complainant_Name',
        'Complainant_Address'
    ];
}
