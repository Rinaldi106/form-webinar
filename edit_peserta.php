<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Dashboard Admin</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Swara Senayan</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Data Webinar</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="peserta.php">Data Peserta</a>
                        <a class="collapse-item" href="narasumber.php">Data Narasumber</a>
                    </div>
                </div>
            </li>

    

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                <h3>Edit Data Peserta</h3>
                <?php
                // Membuat koneksi ke database
                $koneksi = mysqli_connect("127.0.0.1", "root", "", "dbwebinar");

                // Memeriksa koneksi
                if (!$koneksi) {
                    die("Koneksi gagal: " . mysqli_connect_error());
                }

                // Menerima ID peserta dari GET request
                $id_peserta = isset($_GET['id']) ? $_GET['id'] : null;

                // Query untuk mengambil data peserta berdasarkan ID
                $query = "SELECT * FROM registrasi_webinar WHERE id = ?";
                $stmt = mysqli_prepare($koneksi, $query);
                mysqli_stmt_bind_param($stmt, "i", $id_peserta);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $data = mysqli_fetch_assoc($result);

                // Menutup statement dan koneksi
                mysqli_stmt_close($stmt);
                mysqli_close($koneksi);
                ?>

                <form action="update_peserta.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap:</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo isset($data['nama_lengkap']) ? $data['nama_lengkap'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="nomor_wa">Nomor Whatsapp:</label>
                        <input type="text" class="form-control" id="nomor_wa" name="nomor_wa" value="<?php echo isset($data['nomor_wa']) ? $data['nomor_wa'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($data['email']) ? $data['email'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="norek">Nomor Rekening:</label>
                        <input type="text" class="form-control" id="norek" name="norek" value="<?php echo isset($data['norek']) ? $data['norek'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="bank">Bank:</label>
                        <select class="form-control" id="bank" name="bank" required>
                            <option value="">Pilih Bank</option>
                            <option value="BCA" <?php echo isset($data['bank']) && $data['bank'] == 'BCA' ? 'selected' : ''; ?>>BCA</option>
                            <option value="BNI" <?php echo isset($data['bank']) && $data['bank'] == 'BNI' ? 'selected' : ''; ?>>BNI</option>
                            <option value="BRI" <?php echo isset($data['bank']) && $data['bank'] == 'BRI' ? 'selected' : ''; ?>>BRI</option>
                            <option value="Mandiri" <?php echo isset($data['bank']) && $data['bank'] == 'Mandiri' ? 'selected' : ''; ?>>Mandiri</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="usia">Usia:</label>
                        <input type="number" class="form-control" id="usia" name="usia" value="<?php echo isset($data['usia']) ? $data['usia'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin:</label>
                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" <?php echo isset($data['jenis_kelamin']) && $data['jenis_kelamin'] == 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
                            <option value="Perempuan" <?php echo isset($data['jenis_kelamin']) && $data['jenis_kelamin'] == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pendidikan">Pendidikan:</label>
                        <select class="form-control" id="pendidikan" name="pendidikan" required>
                            <option value="">Pilih Pendidikan</option>
                            <option value="SD" <?php echo isset($data['pendidikan']) && $data['pendidikan'] == 'SD' ? 'selected' : ''; ?>>SD</option>
                            <option value="SMP" <?php echo isset($data['pendidikan']) && $data['pendidikan'] == 'SMP' ? 'selected' : ''; ?>>SMP</option>
                            <option value="SMA" <?php echo isset($data['pendidikan']) && $data['pendidikan'] == 'SMA' ? 'selected' : ''; ?>>SMA</option>
                            <option value="Diploma" <?php echo isset($data['pendidikan']) && $data['pendidikan'] == 'Diploma' ? 'selected' : ''; ?>>Diploma</option>
                            <option value="Sarjana" <?php echo isset($data['pendidikan']) && $data['pendidikan'] == 'Sarjana' ? 'selected' : ''; ?>>Sarjana</option>
                            <option value="Magister" <?php echo isset($data['pendidikan']) && $data['pendidikan'] == 'Magister' ? 'selected' : ''; ?>>Magister</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="">Pilih Status</option>
                            <option value="Belum Menikah" <?php echo isset($data['status']) && $data['status'] == 'Belum Menikah' ? 'selected' : ''; ?>>Belum Menikah</option>
                            <option value="Menikah" <?php echo isset($data['status']) && $data['status'] == 'Menikah' ? 'selected' : ''; ?>>Menikah</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alamat_rumah">Alamat Rumah:</label>
                        <textarea class="form-control" id="alamat_rumah" name="alamat_rumah" required><?php echo isset($data['alamat_rumah']) ? $data['alamat_rumah'] : ''; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="kecamatan">Kecamatan:</label>
                        <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="<?php echo isset($data['kecamatan']) ? $data['kecamatan'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="kab_kota">Kabupaten/Kota:</label>
                        <input type="text" class="form-control" id="kab_kota" name="kab_kota" value="<?php echo isset($data['kab_kota']) ? $data['kab_kota'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="provinsi">Provinsi:</label>
                        <input type="text" class="form-control" id="provinsi" name="provinsi" value="<?php echo isset($data['provinsi']) ? $data['provinsi'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="kode_pos">Kode Pos:</label>
                        <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="<?php echo isset($data['kode_pos']) ? $data['kode_pos'] : ''; ?>" required>
                    </div>
                    <button type="button" class="btn btn-secondary" onclick="location.href='peserta.php';">Batal</button>
                    <button type="submit" class="btn btn-primary">Update Data</button>
                </form>


            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Swara Senayan 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div the="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>