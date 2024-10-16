<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CyberAccuPersonalData extends Model
{
    use HasFactory;

    protected $table = 'Cyber_Accu_Personal_Data';

    protected $fillable = [
        'ACCUSED_NO',
        'FULNAME',
        'ALIAS',
        'PARENTAGE',
        'AGE',
        'H_NO',
        'LOCALITY',
        'AREA',
        'PERSON_PS',
        'PERSON_DISTRICT',
        'PERSON_STATE',
        'PERSON_COUNTRY',
        'ACCU_BANK_ACCOUNT',
        'ACCU_BANK_NAME',
        'ACCU_BANK_STATE',
        'ACCU_BANK_DISTRICT',
        'ACCU_EMAIL',
        'ACCU_FACEBOOK',
        'ACCU_OTHER_SOCIAL_MEDIA',
        'REMARKS',
        'ACCU_CRTD_DATE',
        'ACCU_MDFD_DATE',
        'ACCU_CRTD_USER',
        'ACCU_MDFD_USER',
        'ACCU_OTP_CODE',
        'MODULE',
        'GENDER',
        'AADHAR_NO',
        'PASSPORT_NO',
        'H_NO_T',
        'LOCALITY_T',
        'AREA_T',
        'PERSON_PS_T',
        'PERSON_DISTRICT_T',
        'PERSON_STATE_T',
        'PERSON_COUNTRY_T',
        'LAT',
        'LONG',
        'LAT_T',
        'LONG_T',
        'WALLET_INFO',
        'SOURCE',
        'Occupation',
        'dateBirth',
        'voterId',
        'drivingL',
        'Education',
        'languages',
        'stateVisit',
        'countryVisit',
        'mandal2',
        'mandal',
        'bank_ifsc',
        'wallet_name',
        'wallet_id',
        'fir_reg_num',
        'PHOTO_STATUS',
        'PERSON_TYPE',
        'PD_ACT',
        '_KEY_IN',
        '_key_out',
        '_score',
        'FULNAME_clean',
        'PARENTAGE_clean',
        '_Similarity_FULNAME',
        '_Similarity_PARENTAGE',
        'unique_id'
    ];
}
