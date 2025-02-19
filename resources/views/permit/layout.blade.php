<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            width: 100%;
        }

        .header-main {
            margin: 0 20% 20%;
            width: 500px;
            position: relative;
        }

        .content-main {
            margin: 0 auto;
            width: 800px;

        }

        .header {
            float: left;
            width: 100%;
            padding: 15px;

        }

        .content {
            margin-top: -60px;
            float: left;
            padding: 15px;
        }

        .header-logo {
            position: absolute;

            top: 15px;

        }

        .header-logo img {
            width: 100px;

        }

        .header-content {
            position: absolute;

            text-align: center;
            width: 500px;
        }

        .content-item {
            position: absolute;
            left: 150px;
        }

        .input-group input {
            margin-bottom: -5px;

            border: none;
            border-bottom: 1px solid #333;
        }

        .flex-container {
            margin: 0px;
        }


        .romans-font {
            font-family: "Times New Roman", Times, serif;
            padding: 0px;
            margin: 3px;
        }

        .signature {
            margin-top: 80px;
            margin-left: 100px;
            position: relative;
        }

        .signature-img {
            width: 200px;
            position: absolute;
            top: -80px;
            left: 00px;
        }

        .pmo {
            margin-top: 120px;
            margin-left: 100px;
            position: relative;
        }

        .pmo-txt {
            position: absolute;
            left: -90px;
            top: -40px;
        }

        .pmo-head {
            position: absolute;
            left: 50px;
            top: 20px;
        }
    </style>
</head>

<body>
    <div class="header-main">
        <div class="header header-logo">

            <img src="{{ $logo }}" alt="LOGO">
        </div>
        <div class="header header-content">
            <div class="content-item">
                <h3 class="romans-font">
                    <strong>SAINT MICHAEL COLLEGE OF CARAGA</strong>
                </h3>
                <p style="padding: 0px; margin:0px">
                    Brgy. 4, Nasipit, Agusan del Norte, Caraga Region <br />
                    Tel. Nos. ( 085 ) 343-3251; ( 085 ) 283-3113
                </p>
                <h4 style="padding: 0px; margin:5px"><strong>PROPERTY MANAGMENT OFFICE</strong></h4>
                <h4 class="romans-font">PERMIT TO USE FORM (Requestor's Copy)</h4>
            </div>
        </div>
    </div>
    <div class="content-main">
        <div class="content">

            <table>
                <tr>
                    <td colspan="3">
                        <div class="input-group" style="margin-bottom: 2px">
                            <label>DATE FILLED:</label>
                            <input type="text"
                                value="{{ \Carbon\Carbon::parse($details->date_filled)->format('F j, Y') }}">
                        </div>
                    </td>

                </tr>
                <tr>
                    <td colspan="2">
                        <div class=" input-group">
                            <label>NAME:</label>
                            <input type="text"
                                value="{{ Str::ucfirst($users->firstname ?? '?') }} {{ Str::ucfirst($users->middlename ?? '') }} {{ Str::ucfirst($users->lastname ?? '') }}">
                        </div>
                    </td>
                    <td colspan="2">
                        <div class="  input-group">
                            <label>POSITION:</label>
                            <input type="text" value="{{ Str::ucfirst($users->positionDetails->position_name) }}">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="input-group" style="margin-bottom: 2px">
                            <label>DEPT:</label>
                            <input type="text"
                                value="{{ Str::ucfirst($users->departmentDetails->department_name) }}">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="input-group" style="margin-bottom: 2px; ">
                            <label><span> {{ $venueString }}</span></label>

                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="input-group" style="margin-bottom: 2px">
                            <label>PURPOSE:</label>
                            <input type="text" value=" {{ Str::ucfirst($details->purpose) }}">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class=" input-group">
                            <label>INSIDE THE SCHOOL:
                                @if ($details->school_premises == 1)
                                    [1]
                                @else
                                    [0]
                                @endif
                            </label>

                        </div>
                    </td>
                    <td colspan="2">
                        <div class="  input-group">
                            <label>OUTSIDE THE SCHOOL:
                                @if ($details->school_premises == 0)
                                    [1]
                                @else
                                    [0]
                                @endif
                            </label>

                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="1">
                        <div class=" input-group" style="margin-bottom: 2px">
                            <label>DATE OF USAGE:</label>
                            <input type="text" style="width: 70px"
                                value="{{ \Carbon\Carbon::parse($details->date_from)->format('F j') }}">
                        </div>
                    </td>
                    <td colspan="1">
                        <div class=" input-group" style="margin-bottom: 2px">
                            <label>TO:</label>
                            <input type="text" style="width: 100px"
                                value="{{ \Carbon\Carbon::parse($details->date_to)->format('F j') }}">
                        </div>
                    </td>
                    <td colspan="1">
                        <div class=" input-group" style="margin-bottom: 2px">
                            <label>DATE RETURN:</label>
                            <input type="text" style="width: 100px"
                                value="{{ \Carbon\Carbon::parse($details->date_return)->format('F j, Y') }}">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="1">
                        <div class=" input-group" style="margin-bottom: 2px">
                            <label>TIME OF USAGE:</label>
                            <input type="text" style="width: 70px"
                                value="{{ \Carbon\Carbon::parse($details->time_from)->format('h:i A') }}">
                        </div>
                    </td>
                    <td colspan="1">
                        <div class=" input-group" style="margin-bottom: 2px">
                            <label>TO:</label>
                            <input type="text" style="width: 100px"
                                value="{{ \Carbon\Carbon::parse($details->time_to)->format('h:i A') }}">
                        </div>
                    </td>
                    <td colspan="1">
                        <div class=" input-group" style="margin-bottom: 2px">
                            <label>TIME RETURN:</label>
                            <input type="text" style="width: 100px"
                                value="{{ \Carbon\Carbon::parse($details->time_return)->format('h:i A') }}">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="input-group" style="margin-bottom: 0px;">
                            <label>FACILITIES TO BE USED:</label>
                            <span>{{ $itemsString }}</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="input-group" style="margin-bottom: 2px">
                            <label>REMARKS:</label>
                            <input type="text">
                        </div>
                    </td>
                </tr>
            </table>
            <div class="signature">
                <img class="signature-img" src="{{ $signature }}" alt="Signature">
                <label style="border-top:1px solid #333"><strong>Signature over Printed Name</strong></label>
            </div>
            <div class="pmo">
                <label class="pmo-txt">Verified by:</label>
                <img class="signature-img" src="{{ $tmo_logo }}" alt="Signature">
                <label class="pmo-name" style="border-bottom:1px solid #333"><strong>ENGR. MANUEL F.
                        JAMINAL</strong></label>
                <label class="pmo-head"><strong>PMO HEAD</strong></label>
            </div>
        </div>
    </div>
</body>

</html>
