<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PTWarrants extends Model
{
    use HasFactory;

    protected $table = "Sample_PT_Warrants";

    protected $fillable = [
        'NICK_NAME',
        'FIR_NO',
        'SOURCE',
        'SECTION',
        'POLICE_STATION',
        'DISTINCT_SHO',
        'UNIT',
        'STATE',
        'ARRESTED_CRIME',
        'ARRESTED_FIR',
        'ARRESTED_PS',
        'ARRESTED_DISTRICT',
        'ARRESTED_STATE',
        'MONTH',
        'YEAR',
        'NOTE_NO',
        'ASONDATE',
        'IO_Name',
        'reported_date',
        'PT_EXECUTED',
        'DATE_OF_PT_WARRANT_EXECUTION',
        'NAME_OF_JAIL',
        'Arrest_State_Jail',
        'JAIL_STATE',
        'PERIOD_OF_REMAND_DAYS',
        'REMARKS',
        'MDFD_DATE',
        'MDFD_USER',
        'TYPE_OF_PRODUCTION',
        'PT_IO_NAME',
        'PT_IO_PHONE',
        'Jail_Status',
        'Case_Assigned_To_Unit',
        'Whether_Accused_Brought_To_Telangana',
        'NO_Of_PT_EXECUTED'
    ];
}
