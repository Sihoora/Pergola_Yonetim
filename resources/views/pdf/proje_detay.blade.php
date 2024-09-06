
<!DOCTYPE html>
<html>
<head>
    <title>Proje Detayları</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif; /* Türkçe karakter desteği için uygun yazı tipi */
            margin: 0;
            padding: 0;
            color: #333;
            line-height: 1.6;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header img {
            max-height: 100px; /* Logoyu biraz küçülterek alan açıyoruz */
            margin-bottom: 10px;
        }

        h1, h2, h3, h4 {
            color: #555;
            margin-bottom: 20px;
        }

        .content {
            padding: 0 20px; /* İçeriğe biraz daha boşluk bırakarak sayfa genişliğini artırıyoruz */
        }

        .section-title {
            font-size: 20px; /* Başlık fontunu küçülterek alan kazanıyoruz */
            color: #0066cc;
            border-bottom: 2px solid #0066cc;
            padding-bottom: 10px;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .info-table, .product-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .info-table th, .product-table th {
            background-color: #f2f2f2;
            padding: 10px;
            text-align: left;
            font-size: 14px; /* Font boyutunu küçülterek alan kazanıyoruz */
            border-bottom: 1px solid #ddd;
        }

        .info-table td, .product-table td {
            padding: 10px;
            font-size: 12px; /* Font boyutunu küçülterek içerik sığdırıyoruz */
            border-bottom: 1px solid #ddd;
        }

        .product-table th, .product-table td {
            text-align: center;
        }

        .footer {
            text-align: center;
            font-size: 10px; /* Altbilgi fontunu küçültüyoruz */
            color: #999;
            margin-top: 50px;
            position: fixed;
            bottom: 0px;
            width: 100%;
        }
    </style>
</head>
<body>

    <!-- Header (Logo) -->
    <div class="header">
        <img src="https://i.imgur.com/pK5pgii.png" alt="Logo">
        <h1>Proje Detayları</h1>
    </div>

    <!-- Content -->
    <div class="content">

        <!-- Proje Bilgileri -->
        <div class="section">
            <h2 class="section-title">Proje Bilgileri</h2>
            <table class="info-table">
                <tr>
                    <th>Proje Adı:</th>
                    <td>{{ $proje->proje_adi }}</td>
                </tr>
                <tr>
                    <th>Müşteri:</th>
                    <td>{{ $proje->musteri }}</td>
                </tr>
                <tr>
                    <th>Proje Süreci:</th>
                    <td>{{ $proje->surec }}</td>
                </tr>
            </table>
        </div>

        <!-- Ürün Bilgileri -->
        <div class="section">
            <h2 class="section-title">Ürün Bilgileri</h2>
            <table class="product-table">
                <thead>
                    <tr>
                        <th>Ürün Adı</th>
                        <th>Ral Kodu</th>
                        <th>Kumaş Cinsi</th>
                        <th>Kumaş Profil Ral</th>
                        <th>Led Model</th>
                        <th>Motor Model</th>
                        <th>Kumanda</th>
                        <th>Flanş</th>
                        <th>Arka Çelik</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($proje->urunler as $urun)
                    <tr>
                        <td>{{ $urun->urun_name }}</td>
                        <td>{{ $urun->ral_kodu }}</td>
                        <td>{{ $urun->kumas_cinsi }}</td>
                        <td>{{ $urun->kumas_profil_ral }}</td>
                        <td>{{ $urun->led_model }}</td>
                        <td>{{ $urun->motor_model }}</td>
                        <td>{{ $urun->kumanda }}</td>
                        <td>{{ $urun->flans }}</td>
                        <td>{{ $urun->arka_celik }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <!-- Footer (Sayfa numarası) -->
    <div class="footer">
        <p>Sayfa {PAGE_NUM}</p>
    </div>

</body>
</html>
