<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Beneficiary Invitation</title>
</head>
<body>
    <h1>You've been invited to be a beneficiary</h1>
    
    <p>Dear {{ $beneficiaryName }},</p>
    
    <p>You have been invited by {{ $userName }} to be a beneficiary in their Digital Legacy Vault.</p>
    
    <p>Please click the link below to accept the invitation:</p>
    
    <a href="{{ $invitationLink }}">{{ $invitationLink }}</a>
    
    <p>This invitation was sent on {{ $currentDate }}.</p>
    
    <p>Thank you for being part of this important process.</p>
    
    <p>Best regards,<br>Digital Legacy Vault Team</p>
</body>
</html>
