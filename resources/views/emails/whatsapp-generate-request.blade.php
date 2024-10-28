<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Whatsapp</title>
</head>

<body style="font-family: Bookman Old Style, sans-serif; line-height: 1.5; padding: 20px; color: #000;">
    <div style="max-width: 690px; margin: 0 auto;  padding:0px 0px;">
        <table style="width: 100%; margin-bottom: 0px;vertical-align: top;">
            <tr>
                <td style="vertical-align: middle;line-height: 1.2;">
                    <strong style="font-size: 14px;color:#c45911;font-style: italic;">DEVENDER
                        SINGH</strong><br />
                    <strong style="font-size: 14px;color:#0070c0;font-style: italic;">SUPERINTENDENT
                        OF POLICE</strong><br />
                    <strong style="font-size: 14px;color:#0070c0;font-style: italic;">HYDERABAD</strong>
                </td>
                <td style="vertical-align: middle;">
                    <img src="{{ $logo }}" alt="Logo" style="width: 115px; height: 104px;" />
                </td>
                <td style="text-align: right;vertical-align: middle;line-height: 1.2;">
                    <strong style="font-size: 14px;color:#0070c0;font-style: italic;">TELANGANA
                        STATE</strong><br />
                    <strong style="font-size: 14px;color:#0070c0;font-style: italic;">CYBER
                        SECURITY BUREAU</strong><br />
                    <span style="font-size: 12px;color:#0070c0;font-style: italic;">Email
                        ID:
                        legal1-t4c@tspolice.gov.in </span><br>

                </td>
            </tr>
        </table>
        <table style="width: 100%;">
            <tr>
                <td>
                    <span style="color: #606060;font-size: 14px;font-size: italic;font-weight: bold;">L.No.
                        {{ $data->CRIME_ID ?? '' }}
                    </span>
                </td>
                <td style="text-align: right;">
                    <span style="color: #606060;font-size: 14px;font-size: italic;font-weight: bold;">Date:
                        {{ date('d-m-Y') }}</span>
                </td>
            </tr>
        </table>
        <h2 style="text-align: center; font-size: 14px; font-weight: bold; margin-bottom: 0px;margin-top: 0;">
            <span style="border-bottom: 1px solid #333;">Notice U/s 94
                Bharatiya Nagarik Suraksha Sanhita, 2023.</span>
        </h2>

        <div style="font-family: Bookman Old Style, sans-serif; line-height: 1.3;color: #333; ">
            <p style="font-family: Bookman Old Style, sans-serif; line-height: 1.3;color: #333;font-size: 14px; ">
                To<br>
                WhatsApp LLC,<br>
                1601 Willow Road,<br>
                Menlo Park, California 94025,<br>
                United States of America.
            </p>

            <p
                style="font-family: Bookman Old Style, sans-serif; line-height: 1.3;color: #333;font-size: 14px;margin-bottom: 0; ">
                Sir,
            </p>

            <p
                style="font-family: Bookman Old Style, sans-serif; line-height: 1.3;color: #333;font-size: 14px; text-indent: 60px;margin-bottom: 0;">
                <strong>Sub:
                    -</strong> Request to provide the WhatsApp Records of the criminals WhatsApp account-Reg.
            </p>
            <p
                style="font-family: Bookman Old Style, sans-serif; line-height: 1.3;color: #333;font-size: 14px; text-indent: 60px;margin-top: 0;margin-bottom: 0;">
                <strong>Ref:
                    - </strong> FIR NO. {{ ($data->FIR_NO ?? '') . '/' . ($data->YEAR ?? '') }} of CCPS, Hyderabad
                Commissionerate U/s {{ $data->SEC_OF_LAW ?? '' }}
                Act-2008.</strong>
            </p>
            <div style="text-align: center;font-size: 14px;color: #000;">***</div>

            <p
                style="font-family: Bookman Old Style, sans-serif; line-height: 1.3;color: #333;font-size: 14px; text-indent: 60px;margin-top: 0;margin-bottom: 0;">
                It is to inform you that the following WhatsApp accounts are being used by cybercriminal to lure
                innocent people. The victim received a call from following WhatsApp account supposedly from a courier
                service, claiming a parcel contained illegal items linked to their identity. They were coerced into
                transferring money to resolve the issue. The victim was passed to various individuals, each with
                official-sounding titles, who collected personal information and forced financial transactions. They
                were threatened with arrest if they didn't comply. The victim complied due to fear. After realizing it
                was a fraud, they contacted the Cyber Crime Helpline. The scam involved fabricated identities,
                intimidation, and monetary transfers under false pretences.</p>

            <p
                style="font-family: Bookman Old Style, sans-serif; line-height: 1.3;color: #000;font-size: 16px; text-indent: 60px;margin-top: 16px;">
                <strong>WhatsApp number: &nbsp;&nbsp; + 91XXXXXXXX</strong>
            </p>

            <p
                style="font-family: Bookman Old Style, sans-serif; line-height: 1.3;color: #333;font-size: 14px; text-indent: 60px;margin-top: 0;margin-bottom: 16px;">
                In view of this, it is requested to provide the following of the above-said WhatsApp account records for
                further investigation.</p>

            <div>
                <ol style="padding-top: 0;padding-bottom: 0;padding-left:80px;">
                    <li
                        style="font-family: Bookman Old Style, sans-serif;
                            line-height: 1.3;color: #000;font-size: 14px;margin-bottom: 2px;font-weight: bold;">
                        User Registration (Subscriber) details.
                    </li>
                    <li
                        style="font-family: Bookman Old Style, sans-serif;
                            line-height: 1.3;color: #000;font-size: 14px;margin-bottom: 2px;font-weight: bold;">
                        IP Log details from 01-03-2024 to till date.
                    </li>
                    <li
                        style="font-family: Bookman Old Style, sans-serif;
                            line-height: 1.3;color: #000;font-size: 14px;margin-bottom: 2px;font-weight: bold;">
                        Profile details.
                    </li>
                    <li
                        style="font-family: Bookman Old Style, sans-serif;
                            line-height: 1.3;color: #000;font-size: 14px;margin-bottom: 2px;font-weight: bold;">
                        Groups he owns.
                    </li>
                    <li
                        style="font-family: Bookman Old Style, sans-serif;
                            line-height: 1.3;color: #000;font-size: 14px;margin-bottom: 2px;font-weight: bold;">
                        Payment Details.
                    </li>
                    <li
                        style="font-family: Bookman Old Style, sans-serif;
                            line-height: 1.3;color: #000;font-size: 14px;margin-bottom: 2px;font-weight: bold;">
                        Groups he participates and group contacts.
                    </li>
                    <li
                        style="font-family: Bookman Old Style, sans-serif;
                            line-height: 1.3;color: #000;font-size: 14px;margin-bottom: 2px;font-weight: bold;">
                        Device details.
                    </li>
                    <li
                        style="font-family: Bookman Old Style, sans-serif;
                            line-height: 1.3;color: #000;font-size: 14px;margin-bottom: 2px;font-weight: bold;">
                        Symmetric contacts details
                    </li>
                    <li
                        style="font-family: Bookman Old Style, sans-serif;
                            line-height: 1.3;color: #000;font-size: 14px;margin-bottom: 2px;font-weight: bold;">
                        Call logs (Audio and video)
                    </li>
                    <li
                        style="font-family: Bookman Old Style, sans-serif;
                            line-height: 1.3;color: #000;font-size: 14px;margin-bottom: 2px;font-weight: bold;">
                        Message logs.
                    </li>
                    <li
                        style="font-family: Bookman Old Style, sans-serif;
                        line-height: 1.3;color: #000;font-size: 14px;margin-bottom: 2px;font-weight: bold;">
                        Location Information.
                    </li>

                </ol>
            </div>
            <p
                style="font-family: Bookman Old Style, sans-serif; line-height: 1.3;color: #333;font-size: 14px; text-indent: 60px;margin-top: 0;margin-bottom: 16px;">
                Your cooperation in addressing this issue at the earliest would be highly appreciated.</p>
        </div>

        <table style="width: 100%;">
            <tr>
                <td style="text-align: right;float: right;">
                    <div style="width: 220px;text-align: center;">
                        <!-- <img src="sign.jpg" alt
                                style="width: 220px;height: auto;"> -->
                        <div style="height: 40px;"></div>
                        <span style="color: #000;font-size: 14px;font-style: italic;font-weight: bold;">Superintendent
                            of Police</span><br>
                        <span style="color: #000;font-size: 14px;font-style: italic;font-weight: bold;">TGCSB</span>
                    </div>
                </td>
            </tr>
        </table>

    </div>
</body>

</html>
