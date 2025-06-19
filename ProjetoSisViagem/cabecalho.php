<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sistema de Pacotes de Viagens</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
      table.dataTable thead .sorting:after,
      table.dataTable thead .sorting_asc:after,
      table.dataTable thead .sorting_desc:after,
      table.dataTable thead .sorting:before,
      table.dataTable thead .sorting_asc:before,
      table.dataTable thead .sorting_desc:before {
        content: none !important;
      }

      body {
        background-color: #f8f9fa;
      }

      .navbar {
        background-color: #2196f3 !important;
      }

      .navbar .navbar-brand,
      .navbar .nav-link,
      .navbar .nav-link.dropdown-toggle {
        color: #fff !important;
      }

      .navbar .nav-link:hover,
      .navbar .nav-link:focus,
      .navbar .nav-link.dropdown-toggle:hover,
      .navbar .nav-link.dropdown-toggle:focus {
        color: #e3f2fd !important;
      }

      .dropdown-menu {
        background-color: #2196f3;
      }

      .dropdown-menu .dropdown-item {
        color: #fff;
      }

      .dropdown-menu .dropdown-item:hover,
      .dropdown-menu .dropdown-item:focus {
        background-color: #e3f2fd;
        color: #000 !important;
      }

      .navbar-nav.me-auto > li.nav-item {
        border-right: 1px solid #fff;
        padding-right: 15px;
        margin-right: 15px;
      }

      .navbar-nav.me-auto > li.nav-item:last-child {
        border-right: none;
        margin-right: 0;
        padding-right: 0;
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="principal.php">Sistema de Pacotes de Viagens</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link" href="principal.php">Inicio</a></li>
            <li class="nav-item"><a class="nav-link" href="destinos.php">Destinos</a></li>
            <li class="nav-item"><a class="nav-link" href="pacotes.php">Pacotes</a></li>
            <li class="nav-item"><a class="nav-link" href="vendas.php">Vendas</a></li>
            <li class="nav-item"><a class="nav-link" href="clientes.php">Clientes</a></li>
            <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
          </ul>

          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle d-flex align-items-center"
                href="#"
                id="userDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <i class="bi bi-person-circle" style="font-size: 1.5rem"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="alterar_dados.php">Alterar Dados</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item text-danger" href="#" id="logoutButton">Sair</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <main class="container">