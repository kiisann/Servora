<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Masuk - Servora Worker</title>
    <link rel="stylesheet" href="../../public/css/style-worker.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<div class="dashboard-container">

    <!-- ========================
         SIDEBAR
    ======================== -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo-icon">S</div>
            <h2>Servora</h2>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-title">Menu Freelancer</div>

            <a href="dashboard.php" class="nav-item">
                <i class='bx bxs-dashboard'></i>
                Dashboard
            </a>
            <a href="jelajahi_jasa.php" class="nav-item">
                <i class='bx bx-compass'></i>
                Jelajahi Jasa
            </a>
            <a href="kelola_jasa.php" class="nav-item">
                <i class='bx bx-store'></i>
                Kelola Jasa
            </a>
            <a href="tambah_jasa.php" class="nav-item">
                <i class='bx bx-plus-circle'></i>
                Tambah Jasa
            </a>
            <a href="pesanan_masuk.php" class="nav-item active">
                <i class='bx bx-package'></i>
                Pesanan Masuk
            </a>
            <a href="riwayat.php" class="nav-item">
                <i class='bx bx-history'></i>
                Riwayat
            </a>
            <a href="profil.php" class="nav-item">
                <i class='bx bx-user'></i>
                Profil
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-profile-small">
                <img src="https://i.pravatar.cc/150?img=47" alt="Avatar Pengguna">
                <div class="user-info">
                    <div class="name">Pengguna Servora</div>
                    <div class="role">Freelancer</div>
                </div>
            </div>
        </div>
    </aside>

    <!-- ========================
         TOP NAVBAR
    ======================== -->
    <header class="top-navbar">
        <div class="navbar-left">
            <button class="menu-toggle" onclick="toggleSidebar()" title="Toggle Menu">
                <i class='bx bx-menu'></i>
            </button>
            <div class="search-bar">
                <i class='bx bx-search'></i>
                <input type="text" placeholder="Cari pesanan...">
            </div>
        </div>
        <div class="navbar-right">
            <button class="icon-btn" title="Notifikasi">
                <i class='bx bx-bell'></i>
            </button>
            <img src="https://i.pravatar.cc/150?img=47" alt="Profil" class="profile-avatar">
        </div>
    </header>

    <!-- ========================
         MAIN CONTENT
    ======================== -->
    <main class="main-content">
        <div class="content-wrapper">

            <!-- Page Header -->
            <div class="orders-page-header">
                <div class="orders-page-header-left">
                    <h1>Pesanan Masuk</h1>
                    <p>Kelola dan pantau status seluruh pesanan.</p>
                </div>
                <div class="orders-search">
                    <i class='bx bx-search'></i>
                    <input type="text" id="searchOrder" placeholder="Cari pesanan..." oninput="filterOrders()">
                </div>
            </div>

            <!-- Table Card -->
            <div class="orders-table-wrap">

                <!-- Tab Filter -->
                <div class="tab-filter" id="tabFilter">
                    <button class="tab-item active" onclick="setTab(this, 'semua')">Semua</button>
                    <button class="tab-item" onclick="setTab(this, 'berlangsung')">Berlangsung</button>
                    <button class="tab-item" onclick="setTab(this, 'selesai')">Selesai</button>
                    <button class="tab-item" onclick="setTab(this, 'dibatalkan')">Dibatalkan</button>
                </div>

                <!-- Table -->
                <table class="orders-table" id="ordersTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Jasa</th>
                            <th>Client</th>
                            <th>Status</th>
                            <th style="text-align:right;">Harga</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="ordersBody">

                        <tr data-status="berlangsung" data-search="desain poster feed instagram andi">
                            <td><span class="order-id">ORD-1024</span></td>
                            <td><span class="order-name">Desain Poster &amp; Feed Instagram</span></td>
                            <td>Andi P.</td>
                            <td><span class="badge info">Berlangsung</span></td>
                            <td class="order-price-cell" style="text-align:right;">Rp50.000</td>
                            <td class="order-date">2026-04-28</td>
                            <td>
                                <a href="#" class="order-action-link" onclick="openDetail('ORD-1024')">Detail</a>
                            </td>
                        </tr>

                        <tr data-status="menunggu" data-search="bantuan coding web rina">
                            <td><span class="order-id">ORD-1025</span></td>
                            <td><span class="order-name">Bantuan Coding Web</span></td>
                            <td>Rina S.</td>
                            <td><span class="badge warning">Menunggu</span></td>
                            <td class="order-price-cell" style="text-align:right;">Rp150.000</td>
                            <td class="order-date">2026-04-29</td>
                            <td>
                                <a href="#" class="order-action-link" onclick="openDetail('ORD-1025')">Detail</a>
                            </td>
                        </tr>

                        <tr data-status="selesai" data-search="penerjemahan jurnal bagus">
                            <td><span class="order-id">ORD-1026</span></td>
                            <td><span class="order-name">Penerjemahan Jurnal</span></td>
                            <td>Bagus W.</td>
                            <td><span class="badge success">Selesai</span></td>
                            <td class="order-price-cell" style="text-align:right;">Rp35.000</td>
                            <td class="order-date">2026-04-25</td>
                            <td>
                                <a href="#" class="order-action-link" onclick="openDetail('ORD-1026')">Detail</a>
                            </td>
                        </tr>

                        <tr data-status="selesai" data-search="konsultasi spss mega">
                            <td><span class="order-id">ORD-1027</span></td>
                            <td><span class="order-name">Konsultasi SPSS</span></td>
                            <td>Mega L.</td>
                            <td><span class="badge success">Selesai</span></td>
                            <td class="order-price-cell" style="text-align:right;">Rp80.000</td>
                            <td class="order-date">2026-04-22</td>
                            <td>
                                <a href="#" class="order-action-link" onclick="openDetail('ORD-1027')">Detail</a>
                            </td>
                        </tr>

                        <tr data-status="dibatalkan" data-search="slide powerpoint yoga">
                            <td><span class="order-id">ORD-1028</span></td>
                            <td><span class="order-name">Slide PowerPoint</span></td>
                            <td>Yoga T.</td>
                            <td><span class="badge danger">Dibatalkan</span></td>
                            <td class="order-price-cell" style="text-align:right;">Rp65.000</td>
                            <td class="order-date">2026-04-20</td>
                            <td>
                                <a href="#" class="order-action-link" onclick="openDetail('ORD-1028')">Detail</a>
                            </td>
                        </tr>

                        <tr data-status="berlangsung" data-search="desain logo brand tika">
                            <td><span class="order-id">ORD-1029</span></td>
                            <td><span class="order-name">Desain Logo &amp; Brand Identity</span></td>
                            <td>Tika M.</td>
                            <td><span class="badge info">Berlangsung</span></td>
                            <td class="order-price-cell" style="text-align:right;">Rp120.000</td>
                            <td class="order-date">2026-04-30</td>
                            <td>
                                <a href="#" class="order-action-link" onclick="openDetail('ORD-1029')">Detail</a>
                            </td>
                        </tr>

                        <tr data-status="menunggu" data-search="edit video reel sari">
                            <td><span class="order-id">ORD-1030</span></td>
                            <td><span class="order-name">Edit Video Reel TikTok</span></td>
                            <td>Sari A.</td>
                            <td><span class="badge warning">Menunggu</span></td>
                            <td class="order-price-cell" style="text-align:right;">Rp75.000</td>
                            <td class="order-date">2026-05-01</td>
                            <td>
                                <a href="#" class="order-action-link" onclick="openDetail('ORD-1030')">Detail</a>
                            </td>
                        </tr>

                    </tbody>
                </table>

                <!-- Empty state (hidden by default) -->
                <div class="empty-state" id="emptyState" style="display:none;">
                    <i class='bx bx-package'></i>
                    <p>Tidak ada pesanan ditemukan.</p>
                </div>

            </div><!-- end orders-table-wrap -->

        </div><!-- end content-wrapper -->
    </main>

</div><!-- end dashboard-container -->

<!-- Detail Modal -->
<div id="detailModal" style="
  display:none; position:fixed; inset:0;
  background:rgba(0,0,0,0.4); z-index:500;
  align-items:center; justify-content:center;">
    <div style="
      background:#fff; border-radius:16px; padding:28px 32px;
      max-width:440px; width:90%;
      box-shadow:0 20px 60px rgba(0,0,0,0.15);">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
            <h3 style="font-size:16px;font-weight:700;color:#1e293b;" id="modalOrderId">Detail Pesanan</h3>
            <button onclick="closeDetail()" style="background:none;border:none;font-size:20px;color:#64748b;cursor:pointer;">
                <i class='bx bx-x'></i>
            </button>
        </div>
        <div id="modalContent"></div>
        <div style="display:flex;gap:10px;justify-content:flex-end;margin-top:24px;">
            <button onclick="closeDetail()" class="btn-secondary">Tutup</button>
            <button class="btn-primary" id="modalActionBtn" onclick="closeDetail()">
                <i class='bx bx-check'></i> Tandai Selesai
            </button>
        </div>
    </div>
</div>

<script>
  let activeTab = 'semua';

  // Sidebar toggle
  function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
  }

  // Tab filter
  function setTab(btn, tab) {
    activeTab = tab;
    document.querySelectorAll('.tab-item').forEach(t => t.classList.remove('active'));
    btn.classList.add('active');
    filterOrders();
  }

  // Combined filter: tab + search
  function filterOrders() {
    const keyword = document.getElementById('searchOrder').value.toLowerCase();
    const rows = document.querySelectorAll('#ordersBody tr');
    let visible = 0;

    rows.forEach(row => {
      const status = row.dataset.status;
      const searchText = row.dataset.search;

      // Tab match: "berlangsung" tab shows berlangsung+menunggu
      let tabMatch = false;
      if (activeTab === 'semua') tabMatch = true;
      else if (activeTab === 'berlangsung') tabMatch = (status === 'berlangsung' || status === 'menunggu');
      else tabMatch = (status === activeTab);

      const kwMatch = !keyword || searchText.includes(keyword);

      if (tabMatch && kwMatch) {
        row.style.display = '';
        visible++;
      } else {
        row.style.display = 'none';
      }
    });

    document.getElementById('emptyState').style.display = visible === 0 ? 'block' : 'none';
  }

  // Detail modal data
  const orderData = {
    'ORD-1024': { jasa: 'Desain Poster & Feed Instagram', client: 'Andi Pratama', harga: 'Rp50.000', tanggal: '2026-04-28', status: 'Berlangsung', statusClass: 'info', deadline: '2026-05-05' },
    'ORD-1025': { jasa: 'Bantuan Coding Web', client: 'Rina Suryani', harga: 'Rp150.000', tanggal: '2026-04-29', status: 'Menunggu', statusClass: 'warning', deadline: '2026-05-06' },
    'ORD-1026': { jasa: 'Penerjemahan Jurnal', client: 'Bagus Wibowo', harga: 'Rp35.000', tanggal: '2026-04-25', status: 'Selesai', statusClass: 'success', deadline: '2026-04-27' },
    'ORD-1027': { jasa: 'Konsultasi SPSS', client: 'Mega Lestari', harga: 'Rp80.000', tanggal: '2026-04-22', status: 'Selesai', statusClass: 'success', deadline: '2026-04-24' },
    'ORD-1028': { jasa: 'Slide PowerPoint', client: 'Yoga Tama', harga: 'Rp65.000', tanggal: '2026-04-20', status: 'Dibatalkan', statusClass: 'danger', deadline: '-' },
    'ORD-1029': { jasa: 'Desain Logo & Brand Identity', client: 'Tika Maulidya', harga: 'Rp120.000', tanggal: '2026-04-30', status: 'Berlangsung', statusClass: 'info', deadline: '2026-05-10' },
    'ORD-1030': { jasa: 'Edit Video Reel TikTok', client: 'Sari Ananda', harga: 'Rp75.000', tanggal: '2026-05-01', status: 'Menunggu', statusClass: 'warning', deadline: '2026-05-07' },
  };

  function openDetail(orderId) {
    const d = orderData[orderId];
    if (!d) return;

    document.getElementById('modalOrderId').textContent = 'Detail Pesanan — ' + orderId;

    const btnAction = document.getElementById('modalActionBtn');
    if (d.status === 'Selesai' || d.status === 'Dibatalkan') {
      btnAction.style.display = 'none';
    } else {
      btnAction.style.display = 'inline-flex';
    }

    document.getElementById('modalContent').innerHTML = `
      <table style="width:100%;font-size:14px;border-collapse:collapse;">
        <tr>
          <td style="padding:8px 0;color:#64748b;width:40%;">Nama Jasa</td>
          <td style="padding:8px 0;font-weight:600;color:#1e293b;">${d.jasa}</td>
        </tr>
        <tr>
          <td style="padding:8px 0;color:#64748b;">Client</td>
          <td style="padding:8px 0;color:#1e293b;">${d.client}</td>
        </tr>
        <tr>
          <td style="padding:8px 0;color:#64748b;">Harga</td>
          <td style="padding:8px 0;font-weight:700;color:#1e293b;">${d.harga}</td>
        </tr>
        <tr>
          <td style="padding:8px 0;color:#64748b;">Tanggal Pesan</td>
          <td style="padding:8px 0;color:#1e293b;">${d.tanggal}</td>
        </tr>
        <tr>
          <td style="padding:8px 0;color:#64748b;">Deadline</td>
          <td style="padding:8px 0;color:#1e293b;">${d.deadline}</td>
        </tr>
        <tr>
          <td style="padding:8px 0;color:#64748b;">Status</td>
          <td style="padding:8px 0;">
            <span class="badge ${d.statusClass}">${d.status}</span>
          </td>
        </tr>
      </table>`;

    const modal = document.getElementById('detailModal');
    modal.style.display = 'flex';
  }

  function closeDetail() {
    document.getElementById('detailModal').style.display = 'none';
  }

  // Close on backdrop click
  document.getElementById('detailModal').addEventListener('click', function(e) {
    if (e.target === this) closeDetail();
  });
</script>

</body>
</html>
