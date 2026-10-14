<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Si - BAHALAB - Digitalisasi Bahan Habis Pakai Laboratorium" />
    <title>Si - BAHALAB</title>
    <link rel="icon" href="assets/img/logo.png" type="image/png">
    <link href="css/trendy.css?v=<?= filemtime('css/trendy.css') ?>" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
</head>
<body>

<div class="sidebar-overlay"></div>

<!-- SIDEBAR -->
<aside class="sidebar">
    <div class="sidebar-brand">
        <img src="assets/img/logo.png" alt="Logo">
        <div class="brand-text">
            Si - BAHALAB
            <span>Laboratorium Kesehatan</span>
        </div>
    </div>

    <div class="sidebar-section">Pengurus Barang Pembantu</div>
    <ul class="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link" href="penerimaan.php">
                <i class="fas fa-inbox nav-icon"></i>
                Penerimaan BHP
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="sbbk.php">
                <i class="fas fa-file-invoice nav-icon"></i>
                SBBK
            </a>
        </li>
    </ul>

    <div class="sidebar-section">Laboratorium</div>
    <ul class="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link" href="stock.php">
                <i class="fas fa-boxes nav-icon"></i>
                Stok BHP
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="bhp-masuk.php">
                <i class="fas fa-arrow-down nav-icon"></i>
                BHP Masuk
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="bhp-keluar.php">
                <i class="fas fa-arrow-up nav-icon"></i>
                BHP Keluar
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pengajuan.php">
                <i class="fas fa-clipboard-list nav-icon"></i>
                Pengajuan BHP
            </a>
        </li>
    </ul>

    <div class="sidebar-section">Modul</div>
    <ul class="sidebar-nav">
        <li class="nav-item nav-parent" data-submenu="hpv">
            <a class="nav-link nav-parent-toggle" href="javascript:void(0)">
                <i class="fas fa-dna nav-icon"></i>
                HPV DNA
                <i class="fas fa-chevron-down nav-arrow"></i>
            </a>
            <ul class="sidebar-subnav" id="submenu-hpv">
                <li class="nav-item">
                    <a class="nav-link" href="hpv-dna.php">
                        <i class="fas fa-tachometer-alt nav-icon"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="payment-hpv.php">
                        <i class="fas fa-file-invoice-dollar nav-icon"></i>
                        Payment
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item nav-parent" data-submenu="tb">
            <a class="nav-link nav-parent-toggle" href="javascript:void(0)">
                <i class="fas fa-lungs nav-icon"></i>
                TB
                <i class="fas fa-chevron-down nav-arrow"></i>
            </a>
            <ul class="sidebar-subnav" id="submenu-tb">
                <li class="nav-item">
                    <a class="nav-link" href="tb.php">
                        <i class="fas fa-tachometer-alt nav-icon"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="payment-tb.php">
                        <i class="fas fa-file-invoice-dollar nav-icon"></i>
                        Payment
                    </a>
                </li>
            </ul>
        </li>
    </ul>

    <div class="sidebar-section">Pengaturan</div>
    <ul class="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link" href="users.php">
                <i class="fas fa-users-cog nav-icon"></i>
                Manajemen User
            </a>
        </li>
    </ul>

    <div class="sidebar-footer">
        <div class="small">Inovasi:</div>
        Agus, S.Si., M.MKes., M.Si.<br>
        <a href="https://www.instagram.com/ridhooe_/" target="_blank" rel="noopener" class="sidebar-insta-link">
            M. Jamaludin Ridho, A.Md.T., S.Tr.T.
        </a>
    </div>
</aside>

<!-- TOP HEADER -->
<header class="top-header">
    <button class="sidebar-toggle" aria-label="Toggle sidebar">
        <i class="fas fa-bars"></i>
    </button>
    <div class="brand-mobile">Si - BAHALAB</div>

    <div class="header-greeting">
        <button class="theme-toggle" aria-label="Toggle theme">
            <i class="fas fa-moon"></i>
        </button>
        <div class="user-avatar">
            <?= strtoupper(substr($_SESSION['nama'] ?? 'U', 0, 1)) ?>
        </div>
        <div>
            <div class="user-name"><?= htmlspecialchars($_SESSION['nama'] ?? 'User') ?></div>
        </div>
        <a href="logout.php" class="btn btn-outline btn-sm">
            <i class="fas fa-sign-out-alt"></i>
        </a>
    </div>
</header>

<!-- MAIN CONTENT -->
<main class="main-content">
    <div class="page-content">
        <div class="toast-container"></div>

        <?= $content ?? '' ?>

    </div>
</main>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="js/trendy.js"></script>

<script>
$(document).ready(function() {
    $('#dataTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Indonesian.json'
        }
    });
});
</script>

</body>
</html>