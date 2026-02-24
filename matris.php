<?php
// Başlangıç değerleri
$boyut = isset($_POST['boyut']) ? trim($_POST['boyut']) : '';
$sekil = isset($_POST['sekil']) ? $_POST['sekil'] : 'dis_cerceve';
$hataMesaji = '';
$gecerliGiris = false;

$sekilIsimleri = [
    'dis_cerceve'      => 'Dış Çerçeve',
    'arti'             => 'Tam Ortadan Artı (+)',
    'x_isareti'        => 'Köşeden Köşeye X',
    'baklava'          => 'İçte Baklava Dilimi',
    'satranc'          => 'Satranç Tahtası',
];

// Validasyon
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($boyut === '' || !ctype_digit($boyut)) {
        $hataMesaji = 'Lütfen geçerli bir tamsayı giriniz.';
    } else {
        $boyutTamSayi = (int)$boyut;

        if ($boyutTamSayi < 5) {
            $hataMesaji = 'Değer 5\'ten büyük veya ona eşit olmalıdır.';
        } elseif ($boyutTamSayi > 25) {
            $hataMesaji = 'Değer 25\'ten küçük veya ona eşit olmalıdır.';
        } elseif ($boyutTamSayi % 2 === 0) {
            $hataMesaji = 'Lütfen sadece tek sayı giriniz.';
        } else {
            $gecerliGiris = true;
            $boyut = $boyutTamSayi;
        }
    }
}
?>
<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <title>Matris Çiz</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous">

    <style>
        body {
            min-height: 100vh;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
        }

        .sayfa-kapsayici {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .form-bolumu-kapsayici {
            padding-top: 2rem;
            padding-bottom: 1rem;
        }

        .matris-dis-kapsayici {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .matris-icerik-kapsayici {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            /* Ekrana taşmadan sığması için maksimum boyutlar */
            max-width: min(90vw, 90vh);
            max-height: min(90vw, 90vh);
            width: 100%;
        }

        .bilgi-satiri {
            font-size: 0.95rem;
            margin-bottom: 0.5rem;
            text-align: center;
            white-space: nowrap;
        }

        .matris-tablo-kapsayici {
            width: 100%;
            height: 100%;
        }

        .matris-tablo {
            display: grid;
            width: 100%;
            height: 100%;
            border-collapse: collapse;
        }

        .matris-hucre {
            border: 1px solid #dee2e6;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #ffffff;
            color: #212529;
            aspect-ratio: 1 / 1; /* Kare hücre */
            padding: 0.15rem;
            text-align: center;
            /* Boyuta göre dinamik yazı boyutu */
            font-size: clamp(0.35rem,
                calc(1.8vw / max(var(--hucre-sayisi, 5), 5) + 0.3rem),
                0.85rem);
        }

        .matris-hucre.aktif {
            background-color: #0d6efd;
            color: #ffffff;
        }

        @media (max-width: 576px) {
            .form-kart {
                margin-inline: 0.5rem;
            }
        }
    </style>
</head>
<body>

<div class="sayfa-kapsayici">

    <!-- Form Bölümü -->
    <div class="container-fluid form-bolumu-kapsayici">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card shadow-sm form-kart">
                    <div class="card-body">
                        <h2 class="card-title mb-4 text-center">Matris Çiz</h2>

                        <form method="post" action="">
                            <div class="row g-3 align-items-end">
                                <div class="col-12 col-md-4">
                                    <label for="boyut" class="form-label mb-1">
                                        Boyut (Sadece Tek Sayı):
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control <?php echo $hataMesaji ? 'is-invalid' : ''; ?>"
                                        id="boyut"
                                        name="boyut"
                                        placeholder="Örn: 11"
                                        value="<?php echo htmlspecialchars($boyut, ENT_QUOTES, 'UTF-8'); ?>"
                                    >
                                    <?php if ($hataMesaji): ?>
                                        <div class="invalid-feedback d-block">
                                            <?php echo htmlspecialchars($hataMesaji, ENT_QUOTES, 'UTF-8'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="col-12 col-md-4">
                                    <label for="sekil" class="form-label mb-1">
                                        Çizilecek Şekil:
                                    </label>
                                    <select name="sekil" id="sekil" class="form-select">
                                        <?php foreach ($sekilIsimleri as $anahtar => $ad): ?>
                                            <option value="<?php echo $anahtar; ?>"
                                                <?php echo $sekil === $anahtar ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($ad, ENT_QUOTES, 'UTF-8'); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-12 col-md-4 d-grid">
                                    <button type="submit" class="btn btn-primary">
                                        Şekli Çiz
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Matris Bölümü -->
    <div class="matris-dis-kapsayici">
        <?php if ($gecerliGiris): ?>
            <?php $secilenModAdi = $sekilIsimleri[$sekil] ?? ''; ?>
            <div class="matris-icerik-kapsayici" style="--hucre-sayisi: <?php echo (int)$boyut; ?>;">
                <div class="bilgi-satiri text-muted">
                    Seçilen Mod:
                    <strong><?php echo htmlspecialchars($secilenModAdi, ENT_QUOTES, 'UTF-8'); ?></strong>
                    |
                    Boyut:
                    <strong><?php echo (int)$boyut . ' x ' . (int)$boyut; ?></strong>
                </div>

                <div class="matris-tablo-kapsayici">
                    <div
                        class="matris-tablo"
                        style="grid-template-columns: repeat(<?php echo (int)$boyut; ?>, 1fr);"
                    >
                        <?php
                        $merkez = (int)(($boyut + 1) / 2);
                        $yaricap = $merkez - 1;

                        for ($satir = 1; $satir <= $boyut; $satir++) {
                            for ($sutun = 1; $sutun <= $boyut; $sutun++) {

                                $aktifMi = false;

                                switch ($sekil) {
                                    case 'dis_cerceve':
                                        $aktifMi = ($satir == 1 || $satir == $boyut || $sutun == 1 || $sutun == $boyut);
                                        break;

                                    case 'arti':
                                        $aktifMi = ($satir == $merkez || $sutun == $merkez);
                                        break;

                                    case 'x_isareti':
                                        $aktifMi = ($satir == $sutun) || ($satir + $sutun == $boyut + 1);
                                        break;

                                    case 'baklava':
                                        $mesafe = abs($satir - $merkez) + abs($sutun - $merkez);
                                        $aktifMi = ($mesafe <= $yaricap);
                                        break;

                                    case 'satranc':
                                        $aktifMi = (($satir + $sutun) % 2 === 0);
                                        break;

                                    default:
                                        $aktifMi = false;
                                        break;
                                }

                                $hucreSinifi = 'matris-hucre';
                                if ($aktifMi) {
                                    $hucreSinifi .= ' aktif';
                                }
                                ?>
                                <div class="<?php echo $hucreSinifi; ?>">
                                    <?php echo $satir . ',' . $sutun; ?>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- Geçersiz girişte sadece bilgilendirici küçük bir metin gösterilebilir (zorunlu değil) -->
            <div class="text-muted small text-center">
                Geçerli bir boyut girip şekil seçtikten sonra matris burada görünecektir.
            </div>
        <?php endif; ?>
    </div>

</div>
</body>
</html>

