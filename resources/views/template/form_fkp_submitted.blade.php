<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { padding: 20px; }
        .header { margin-bottom: 20px; }
        .content { margin-bottom: 20px; }
        .footer { margin-top: 20px; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Form FKP - {{ $fkpForm->subject }}</h2>
        </div>
        
        <div class="content">
            <p>Yth. {{ $fkpForm->employee_name }},</p>
            
            <p>Berikut adalah detail form FKP yang telah disubmit:</p>
            
            <ul>
                <li>Jenis Pesan: {{ $fkpForm->message_type }}</li>
                <li>NIP: {{ $fkpForm->employee_id }}</li>
                <li>Departemen: {{ $fkpForm->department }}</li>
                <li>Jabatan: {{ $fkpForm->position }}</li>
            </ul>

            <p>Form FKP lengkap dapat dilihat pada file PDF yang terlampir.</p>
        </div>
        
        <div class="footer">
            <p>Email ini dikirim secara otomatis. Mohon tidak membalas email ini.</p>
        </div>
    </div>
</body>
</html>