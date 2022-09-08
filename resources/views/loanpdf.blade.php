<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Application Mark Down</title>
</head>
<body>
<p>Dear {{ $user['name'] }},</p> 
    <p>Your Loan has been Approved. See Details Below:</p>
    <br>
    <table style="border:1px solid black;border-collapse:collapse;">
        <tr style="border:1px solid black;">
            <th style="border:1px solid black;">Loan Approved Date</th>
            <th style="border:1px solid black;">Interest Rate</th>
            <th style="border:1px solid black;">Total Outstanding</th>
            <th style="border:1px solid black;">Total EMIs</th>
            <th style="border:1px solid black;">Monthly EMI</th>
            <th style="border:1px solid black;">EMI Due Date</th>
        </tr>

        <tr style="border:1px solid black;">
            <td style="border:1px solid black;">{{ now()->toDateString() }}</td>
            <td style="border:1px solid black;">{{ $loan_intrest_rate }}%</td>
            <td style="border:1px solid black;">Rs.{{ $loanemi*$loan_tenure }}</td>
            <td style="border:1px solid black;">{{ $loan_tenure }}</td>
            <td style="border:1px solid black;">Rs.{{ $loanemi }}</td>
            <td style="border:1px solid black;">{{ now()->addMonth(1)->toDateString() }}</td>
        </tr>
    </table>
</body>
</html>