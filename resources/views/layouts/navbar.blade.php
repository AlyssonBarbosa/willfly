<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <div class="container-fluid">
                <nav class="navbar navbar-dark navbar-expand-sm topnav-menu">
                    <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#topnav-menu-content" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
                        <span class="navbar-toggler-icon"></span>
                    </button> -->
                    <div class="col-sm-6 navbar-toggler" data-toggle="collapse" data-target="#topnav-menu-content">
                        <div class="dropdown mt-sm-0">
                            <a href="ui-dropdowns.html#" class=" dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ri-home-fill ri-2x"></i>
                            </a>

                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('billet.index') }}" aria-haspopup="true" aria-expanded="false">
                                    <i class="ri-money-dollar-circle-line"></i>Boletos
                                </a>
                                <a class="dropdown-item" href=" {{ route('billet.create') }} " id="topnav-components" aria-haspopup="true" aria-expanded="false">
                                    <i class="ri-add-circle-line"></i>Cadastro
                                </a>
                                <a class="dropdown-item" href="layouts-horizontal.html#" id="topnav-more" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ri-github-fill"></i>GitHub
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('billet.index') }}" aria-haspopup="true" aria-expanded="false">
                                    <i class="ri-money-dollar-circle-line"></i>Boletos
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href=" {{ route('billet.create') }} " id="topnav-components" aria-haspopup="true" aria-expanded="false">
                                    <i class="ri-add-circle-line"></i>Cadastro
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="layouts-horizontal.html#" id="topnav-more" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ri-github-fill"></i>GitHub
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>