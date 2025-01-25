<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <style>
    body {
      font-family: "Oswald", serif;
      margin: 0;
      padding: 0;
      overflow-x: hidden;
    }
    .sidebar {
      height: 100vh;
      position: fixed;
      top: 0;
      left: -250px; /* Sidebar tersembunyi sepenuhnya */
      z-index: 1000;
      background-color: #f8f9fa;
      border-right: 1px solid #dee2e6;
      transition: left 0.3s ease; /* Transisi halus */
      width: 250px; /* Lebar sidebar */
    }
    .sidebar.show {
      left: 0; /* Sidebar muncul setelah toggle ditekan */
    }

    @media (max-width: 768px) {
      .sidebar {
        width: 200px; /* Lebar lebih kecil untuk layar kecil */
      }
    }

    .sidebar a {
      font-size: 1rem;
      text-decoration: none;
      padding: 10px 20px;
      display: block;
      color: #000;
    }
    .sidebar a:hover {
      background-color: #e9ecef;
      border-radius: 4px;
    }
    .sidebar-header {
      padding: 15px;
      display: flex;
      align-items: center;
      border-bottom: 1px solid #dee2e6;
    }
    .sidebar-header img {
      height: 40px;
    }
    .sidebar-header span {
      margin-left: 10px;
      font-size: 1.2rem;
      font-weight: bold;
    }
    .content {
      margin-left: 0;
      padding: 0;
      transition: margin-left 0.3s ease;
    }
    .content.shifted {
      margin-left: 250px; /* Sesuaikan dengan lebar sidebar */
    }
    .toggle-btn {
      position: fixed;
      top: 15px;
      left: 15px;
      z-index: 1100;
      background-color: #f8f9fa;
      border: none;
      padding: 10px;
      border-radius: 4px;
      cursor: pointer;
    }
    .toggle-btn:focus {
      outline: none;
    }
    .content video {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh; 
      object-fit: cover; 
      z-index: -1; 
    }
  </style>
</head>
<body>
  <button class="toggle-btn" id="toggleSidebar">☰</button>

  <div class="sidebar" id="sidebar">
    <div class="sidebar-header mt-5">
      <img src="/img/logo.png" alt="Logo">
      <span>BMS Universitas Tanjungpura</span>
    </div>
    <nav>
      <a class="text-success" href="/"><i class="fas fa-home"></i> Home</a>
      <a class="text-danger" href="login-admin"><i class="fas fa-user-cog"></i> Admin</a>
      <a class="text-warning" href="login-bendahara"><i class="fas fa-coins"></i> Bendahara</a>
      <a class="text-success" href="login-teknisi"><i class="fas fa-tools"></i> Teknisi</a>
      <a class="text-warning" href="login-pelaporan"><i class="fas fa-file-alt"></i> Pelaporan</a>
      <a class="text-danger" href="login-penyelia"><i class="fas fa-user-tie"></i> Penyelia</a>
      <a class="text-success" href="login-kepala"><i class="fas fa-user"></i> Kepala Lab</a>
      <a class="text-danger" href="login-pencetak"><i class="fas fa-print"></i> Cetak</a>
    </nav>
    
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('show');
      content.classList.toggle('shifted');
    });
  </script>
</body>
</html>
