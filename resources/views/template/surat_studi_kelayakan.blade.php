<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studi Kelayakan BPMSPH</title>
</head>
<body style="font-family: Arial, sans-serif;">
    <div class="email-container" style="padding: 20px; background-color: #f9f9f9;">
        <div class="header" style="background-color: #0077b6; padding: 10px; text-align: center;">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSCoC6ZkD4uvDuCJfKOWs9HcoAT7zGiQ6NfuA&s" alt="" style='width: 120px; margin: 10px;'>
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS7LxvasEXsbtEQpoPQ9UNLVlFMpgkNz86-vw&s" alt="" style='width: 120px; margin: 10px;'>
        </div>
        <div class="header-title">
            <h1 style="color: white; text-align:center; padding-bottom: 5px; width: 100%; background-color: #0077b6;">STUDI KELAYAKAN BPMSPH</h1>
        </div>
        <div class="content" style="color: black;">
            <p>Yth. Bapak/Ibu {{ $studiKelayakan->nama_pengguna }},</p>
            <p>Terima kasih atas partisipasi Bapak/Ibu dalam proses Studi Kelayakan BPMSPH. Berikut ini adalah data yang telah kami terima:</p>
            <ul style="list-style-type: none; text-decoration:none;">
                <li>Nama Perusahaan/Instansi/Perorangan: {{ $studiKelayakan->nama_pengguna }}</li>
                <li>Alamat: {{ $studiKelayakan->alamat }}</li>
                <li>Hubungan dengan BPMSPH: {{ $studiKelayakan->hubungan }}</li>
                <li>Nama Pegawai Penghubung: {{ $studiKelayakan->nama_penghubung }}</li>
                <li>Nomor Telepon: {{ $studiKelayakan->no_telepon }}</li>
            </ul>
            <p>Anda bisa mengunduh dokumen Studi Kelayakan yang telah Anda buat dengan mengklik tombol di bawah:</p>
            <a href="{{ $downloadLink }}" style="background-color: #0077b6; color: white; padding: 10px; text-decoration: none; display: inline-block;">
                <img src="https://cdn-icons-png.flaticon.com/128/7403/7403934.png" alt="" style="width: 20px; height: 20px; vertical-align: middle;"> Download Dokumen
            </a>
        </div>
        <div class="footer" style="text-align: center; margin-top: 20px; font-size: 12px; color: gray;">
            <p>BPMSPH - Balai Pengujian Mutu dan Sertifikasi Produk Hewan</p>
        </div>
    </div>
</body>
</html>