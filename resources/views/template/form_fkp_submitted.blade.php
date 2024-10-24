<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan FKP BPMSPH</title>
</head>
<body>
    <div class="email-container" style="padding: 20px; background-color: #f9f9f9;">
        <div class="header" style="background-color: #0077b6; padding: 10px; text-align: center;">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSCoC6ZkD4uvDuCJfKOWs9HcoAT7zGiQ6NfuA&s" alt="" style='width: 120px; margin: 10px;'>
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS7LxvasEXsbtEQpoPQ9UNLVlFMpgkNz86-vw&s" alt="" style='width: 120px; margin: 10px;'>
        </div>
        <div class="header-title">
            <h1 style="color: white; text-align:center; padding-bottom: 5px; width: 100%; background-color: #0077b6;">Konsultasi dan Partisipasi K3 BPMSPH</h1>
        </div>
        <div class="content" style="color: black;">
            <p>Yth. Bapak/Ibu {{ $fkpForm->employee_name }},</p>
            <p>Terima kasih atas partisipasi Bapak/Ibu dalam proses Konsultasi dan Partisipasi K3 BPMSPH. Berikut ini adalah data yang telah kami terima:</p>
            <ul style="list-style-type: none; text-decoration:none;">
                <li>Jenis Pesan: {{ $fkpForm->message_type }}</li>
                <li>NIP: {{ $fkpForm->employee_id }}</li>
                <li>Catatan: {{ $fkpForm->notes }}</li>
                <li>Pelaksana: {{ $fkpForm->executor }}</li>
            </ul>

            <p>Form FKP lengkap dapat dilihat pada file PDF yang terlampir.</p>
        </div>
        <div class="footer" style="text-align: center; margin-top: 20px; font-size: 12px; color: gray;">
            <p>BPMSPH - Balai Pengujian Mutu dan Sertifikasi Produk Hewan</p>
        </div>
    </div>
</body>
</html>