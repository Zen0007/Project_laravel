<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan Yaman & Gelenyu</title>
    <style>
        :root {
            --primary-color: #4A5568;
            --accent-color: #D4AF37; /* Warna Emas */
            --bg-color: #F7FAFC;
            --text-color: #2D3748;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            max-width: 600px;
            width: 90%;
            background: #ffffff;
            margin: 40px auto;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            border: 1px solid rgba(212, 175, 55, 0.2);
            text-align: center;
            box-sizing: border-box;
        }

        .header h1 {
            font-family: 'Georgia', serif;
            font-size: 2.5rem;
            color: var(--accent-color);
            margin-bottom: 5px;
        }

        .header p {
            font-style: italic;
            color: #718096;
            margin-top: 0;
        }

        .divider {
            height: 2px;
            width: 80px;
            background-color: var(--accent-color);
            margin: 25px auto;
        }

        .couple-names {
            font-family: 'Georgia', serif;
            font-size: 2.2rem;
            font-weight: bold;
            color: var(--primary-color);
            margin: 30px 0;
        }

        .couple-names span {
            display: block;
            font-size: 1.5rem;
            color: var(--accent-color);
            margin: 10px 0;
        }

        .details {
            background: #FFFDF5;
            padding: 20px;
            border-radius: 10px;
            border: 1px dashed var(--accent-color);
            margin: 30px 0;
        }

        .details h3 {
            margin-top: 0;
            color: var(--primary-color);
        }

        .event-info {
            margin: 15px 0;
            font-size: 1.1rem;
        }

        .btn {
            display: inline-block;
            background-color: var(--accent-color);
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 25px;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        }

        .btn:hover {
            background-color: #B8952E;
            transform: translateY(-2px);
        }

        .footer {
            font-size: 0.9rem;
            color: #A0AEC0;
            margin-top: 40px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <p>The Wedding of</p>
            <div class="divider"></div>
        </div>

        <div class="couple-names">
            Yaman
            <span>&</span>
            Gelenyu
        </div>

        <p>Tanpa mengurangi rasa hormat, kami mengundang Bapak/Ibu/Saudara/i untuk menghadiri hari bahagia kami.</p>

        <div class="details">
            <h3>Acara Pernikahan</h3>
            
            <div class="event-info">
                <strong>📅 Hari / Tanggal:</strong><br>
                Sabtu, 12 Desember 2026
            </div>
            
            <div class="event-info">
                <strong>⏰ Waktu:</strong><br>
                09.00 WIB - Selesai
            </div>
            
            <div class="event-info">
                <strong>📍 Lokasi:</strong><br>
                Gedung Pertemuan Indah<br>
                Jl. Mawar No. 123, Kota Bahagia
            </div>
        </div>

        <p>Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir memberikan doa restu.</p>

        <!-- Link Google Maps (Ganti URL dengan lokasi asli nanti) -->
        <a href="https://maps.google.com" target="_blank" class="btn">Buka Lokasi Map</a>

        <div class="footer">
            <p>Kami yang berbahagia,<br><strong>Yaman & Gelenyu</strong></p>
        </div>
    </div>

</body>
</html>