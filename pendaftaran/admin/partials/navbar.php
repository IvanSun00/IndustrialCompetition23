<style>
    #logNavbar:hover {
        color: #ff3b3b;
    }
    body{
        color: #1c1840;	
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #281c65;">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">
                <img src="assets/img/logo%20ic.png" alt="" height="35" class="d-inline-block align-text-top">
                <span style="vertical-align: middle;">Admin IC 2023</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link homeNavbar" aria-current="page" href="home.php"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pendaftarNavbar" href="pendaftar.php"><i class="fas fa-user-check"></i> Pendaftar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link adminNavbar" href="new_admin.php"><i class="fas fa-user-plus"></i> Add Admin</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link " id="logNavbar" href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
