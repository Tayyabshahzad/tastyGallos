<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

        <table border="1" width="900" align="center">

            <tr>
                <th colspan="4">
                    <br>
                              Earning Detail From
                                 {{ \Carbon\Carbon::parse($emailContent['from_date'])->format('d-M-Y') }}
                                      To
                                 {{ \Carbon\Carbon::parse($emailContent['to_date'])->format('d-M-Y') }}
                    <br>
                    <br>
                </th>


            </tr>


            <tr>
                <th colspan="2">
                    Online Orders
                </th>

                <th colspan="2">
                    Cash Orders
                </th>
            </tr>

            <tr >
                <td align="left">
                    Total Amount
                </td>

                <td align="right">
                   {{ $emailContent['totalOnline']}} ZAR
                </td>

                <td>
                    Total Amount
                </td>

                <td align="right">
                    {{ $emailContent['totalCash']}} ZAR
                </td>
            </tr>


            <tr align="center">
                <td align="left">
                    Gateway Fee
                </td>

                <td align="right">
                    0 ZAR
                </td>

                <td align="left">
                    Gateway Fee
                </td>

                <td align="right">
                    0 ZAR
                </td>
            </tr>


            <tr align="center">
                <td align="left">
                    Remaining
                </td>

                <td align="right">
                    {{ $emailContent['remaining_after_gateWay']}} ZAR
                </td>

                <td align="left">
                    Remaining
                </td>

                <td align="right">
                    {{ $emailContent['remaining_after_gateWay_in_cash']}} ZAR
                </td>
            </tr>


            <tr align="center">
                <td align="left">
                    Admin Commission (Online Orders)
                </td>

                <td align="right">
                    {{ $emailContent['comissionOnline']}} ZAR
                </td>

                <td align="left">
                    Admin Commission (COC)
                </td>

                <td align="right">
                    {{ $emailContent['comissionCash']}} ZAR
                </td>
            </tr>

            <tr align="center">
                <td align="left">
                    Net Amount Due To Franchise
                </td>

                <td align="right">
                    {{ $emailContent['netAmountDueFranchiseOnline']}} ZAR
                </td>

                <td align="left">
                    Net Amount Due To Franchise
                </td>

                <td align="right">
                    {{ $emailContent['netAmountDueFranchiseCash']}} ZAR
                </td>
            </tr>


            <tr align="center">
                <td colspan="4"> <br>
                    SUMMARY OF PAYABLE FROM   {{ \Carbon\Carbon::parse($emailContent['from_date'])->startOfDay()->format('d-M-Y') }}  To
                     {{ \Carbon\Carbon::parse($emailContent['to_date'])->startOfDay()->format('d-M-Y') }}
                        <br><br>
                </td>
            </tr>
            <tr align="center">
                <td colspan="2" align="left">
                    Total Amount Due To Franchise (Online Order)
                </td>

                <td  colspan="2" align="right">
                    {{ $emailContent['netAmountDueFranchiseCash']}} ZAR
                </td>
            </tr>

            <tr align="center">
                <td colspan="2" align="left">
                    Franchise Owing Admin Comission (Cash On Collection Orders)
                </td>

                <td  colspan="2" align="right">
                    {{ $emailContent['comissionCash']}} ZAR
                </td>
            </tr>

            <tr align="center">
                <td colspan="2" align="left">
                    Remaining Amount Due To Franchise
                </td>

                <td  colspan="2" align="right">
                    {{ $emailContent['remaningAmountDueFranchise']}} ZAR
                </td>
            </tr>




        </table>
</body>
</html>
