<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <div class="container-fluid">
                <nav class="navbar navbar-dark navbar-expand-lg topnav-menu">

                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav">

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('billet.index') }}" aria-haspopup="true" aria-expanded="false">
                                    <i class="ri-money-dollar-circle-line"></i>Boletos
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link" href=" {{ route('billet.create') }} " id="topnav-components" aria-haspopup="true" aria-expanded="false">
                                <i class="ri-add-circle-line"></i>Cadastro
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="layouts-horizontal.html#" id="topnav-more" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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