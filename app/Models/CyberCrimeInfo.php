<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CyberCrimeInfo extends Model
{
    use HasFactory;

    protected $table = "Cyber_Crime_Info";

    protected $fillable = [
        'CRIME_ID',
        'ACCUSED_NO',
        'FIR_NO',
        'YEAR',
        'SEC_OF_LAW',
        'CRIME_PS',
        'CRIME_DISTRICT',
        'CRIME_STATE',
        'CRIME_MO',
        'CRIME_MAJOR_HEAD',
        'CRIME_PROPERTY_LOST',
        'OFFENCE_PHONE',
        'OFFENCE_EMAIL',
        'OFFENCE_FACEBOOK',
        'OFFENCE_OTHER_SOCIAL_MEDIA',
        'OFFENCE_BANK_ACCOUNT',
        'OFFENCE_BANK_NAME',
        'OFFENCE_BANK_STATE',
        'OFFENCE_BANK_DISTRICT',
        'OFFENCE_IFSC_CODE',
        'REMARKS',
        'CRIME_CRTD_DATE',
        'CRIME_MDFD_DATE',
        'CRIME_CRTD_USER',
        'CRIME_MDFD_USER',
        'WALLET_INFO',
        'CRIME_MATERIAL_SEIZED',
        'CRIME_PERSON_CATEGORY',
        'CONFESSION_SEIZURE',
        'OTHER_DOCUMENTS',
        'SUB_CATEGORY',
        'fir_contents',
        'FIR_REG_NUM',
        'FIR_STATUS',
        'REG_DT',
        'MDFD_USER',
        'CHARGE_SHEET_REMARKS',
        'CONFESSION_STATEMENT',
        'REMAND_REPORT',
        'IR_STATUS',
        'IR_CONTENT',
        'FSL_REPORT',
        'SEIZURE',
        'IR_CONTENTS',
        'ARREST_STATUS',
        'ASONDATE',
        'CC_NO'
    ];
}
