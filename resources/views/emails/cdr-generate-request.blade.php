<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CDR</title>
    <style>
        .tss-table,
        .tss-table td {
            border: 1px solid #333;
            text-align: center;
            font-size: 14px;
            line-height: 1;
        }
    </style>
</head>

<body style="font-family: Bookman Old Style, sans-serif; line-height: 1.5; padding: 20px; color: #000;">
    <div style="max-width:900px; margin: 0 auto;  padding:10px 0px;">
        <table style="width: 100%; margin-bottom: 20px;vertical-align: top;">
            <tr>
                <td style="vertical-align: middle;line-height: 1.2;text-align: center;">
                    <strong style="font-size: 14px;color:#000;">GOVERNMENT OF
                        TELANGANA</strong><br />
                    <strong style="font-size: 14px;color:#000;"> (POLICE
                        DEPARTMENT)</strong>
                </td>

            </tr>
        </table>

        <table style="width: 100%;">
            <tr>
                <td style="text-align: right;line-height: 1;">
                    <span style="color: #000;font-size: 14px;line-height: 1;">CCPS(HQRS)
                        TGCSB</span><br>
                    <span style="color: #000;font-size: 14px;line-height: 1;">Date:
                        {{ date('d.m.Y') }}</span>

                </td>
            </tr>
        </table>

        <div style="font-family: Bookman Old Style, sans-serif; line-height: 1.3;color: #333; ">
            <p
                style="font-family: Bookman Old Style, sans-serif; line-height: 1.3;color: #333;font-size: 14px;font-weight: bold; ">
                To<br>
                The Superintendent of Police,<br>
                Telangana State Cyber Security Bureau,</br>
                Hyderabad.
            </p>

            <h2 style="text-align: center; font-size: 14px; font-weight: bold; margin-bottom: 10px;">
                <span style="border-bottom: 1px solid #333;">//Through Proper Channel//</span>
            </h2>

            <p
                style="font-family: Bookman Old Style, sans-serif; line-height: 1.3;color: #333;font-size: 14px;font-weight: bold; ">
                Sir,
            </p>

            <p
                style="font-family: Bookman Old Style, sans-serif; line-height: 1.3;color: #333;font-size: 14px; text-indent: 60px;margin-bottom: 0;">
                <strong>Sub:
                    -</strong> Request to furnish Call Data Records (CDRs) -Reg.
            </p>
            <p
                style="font-family: Bookman Old Style, sans-serif; line-height: 1.3;color: #333;font-size: 14px; text-indent: 60px;margin-top: 0;">
                <strong>Ref:
                    - </strong> Cr. No. {{ $crimeInfo->SEC_OF_LAW ?? '-' }}.
            </p>


            <p
                style="font-family: Bookman Old Style, sans-serif; line-height: 1.3;color: #333;font-size: 14px; text-indent: 60px;">
                With reference to the above subject, it is requested to address a letter to the concerned service
                provider to furnish <strong>Call Data Records (CDRs)</strong> of below mentioned mobile number for
                further investigation of case vide reference cited above. </p>

            <table class="tss-table" style="width: 100%;border-collapse: collapse;">
                <tr>
                    <td>S. No (1) </td>
                    <td>Request type (2)</td>
                    <td>Mobile No./IMEI/Tower Data(3)</td>
                    <td>From Date (4)</td>
                    <td>To Date (5)</td>
                    <td>TSP (Telecom Provider) (6)</td>
                    <td>TSP Circle (7)</td>
                    <td>Crime No./NCRP ACK No. (8)</td>
                    <td>Year (9)</td>
                    <td>Police Station (10) </td>
                    <td>Section of Law (11)</td>
                    <td>Head of Crime (12)</td>
                    <td>Nick Name (13)</td>
                    <td>Comments (Brief facts of the case) (14)</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Furnish Call Data Records</td>
                    <td>
                        <ol style="padding: 0 0 0 20px;">
                            <li>866149064350364</li>
                            <li>866807068987040</li>
                            <li>359648711864747</li>
                        </ol>
                    </td>
                    <td>13.06.2023</td>
                    <td>13.06.2024</td>
                    <td>-</td>
                    <td>-</td>
                    <td>{{ $crimeInfo->CRIME_ID ?? $data['FIR_NO'] }}</td>
                    <td>{{ $crimeInfo->YEAR ?? '-' }}</td>
                    <td>{{ $data['Police_Station'] ?? ($data['Police Station'] ?? '-') }}</td>
                    <td>{{ $crimeInfo->SEC_OF_LAW ?? '-' }}</td>
                    <td>Trading</td>
                    <td></td>
                    <td>Mentioned below</td>
                </tr>
                <tr>
                    <td colspan="14" style="text-align: left;">
                        Note:
                        <ol style="padding: 0 0 0 20px;">
                            <li>Request type (Col No.2): MSISDN, MSISDN & CAF, MSISDN & SDR, Only CAF, Only SDR, IMEI,
                                Towerdata and ISD data</li>
                            <li>TSP Circle (Col No.7): The name of the TSP Circle from which we fetch CDR Data. Bx.
                                Airtel, AP Circle.</li>
                            <li>Name of the Mobile User (Col No.13): Specify the name of the mobile user and crime
                                linkage (relationship with Respondent/ Accused/suspect / Complainant).</li>
                        </ol>
                    </td>
                </tr>
            </table>


        </div>

        <table style="width: 100%;">
            <tr>
                <td style="text-align: right;float: right;">
                    <div style="width: 140px;text-align: center;">
                        <p style="color: #000;font-size: 14px;">Yours faithfully, </p>
                        <div style="height: 20px;"></div>
                        <span style="color: #000;font-size: 14px;">Inspector of police,</span><br>
                        <span style="color: #000;font-size: 14px;">CCPS, HQRS.</span>
                    </div>
                </td>
            </tr>
        </table>

    </div>
</body>

</html>
