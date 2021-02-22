<!doctype html>
<html lang="pt-BR">

<head>

    <meta charset="utf-8" />
    <title> Cadastro </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="José Alysson" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

    <link rel="stylesheet" href="{{asset('libs/twitter-bootstrap-wizard/prettify.css') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link href="{{ asset('css/custom.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    <link href="{{ asset('libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!--  -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

</head>

<body data-topbar="dark" data-layout="horizontal">
    @include('layouts.navbar')
    <!-- Begin page -->
    <div id="layout-wrapper">
        @if(!$errors->any())
            <div id="preloader">
                <div id="status">
                    <div class="spinner">
                        <i class="ri-loader-line spin-icon"></i>
                    </div>
                </div>
            </div>
        @endif
        <div class="page-content">
            <div class="container-fluid">
                @if($errors->any())
                @foreach($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
                @endforeach
                @endif
                @if(session()->has('mensagem'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('mensagem') }}
                </div>
                @endif
                <div class="alert alert-danger erro_request" id="erro_request" role="alert">  </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div id="checkout-nav-pills-wizard" class="twitter-bs-wizard">
                                    <ul class="twitter-bs-wizard-nav">
                                        <li class="nav-item">
                                            <a href="#billing-info" class="nav-link" data-toggle="tab">
                                                <span class="step-number">01</span>
                                                <span class="step-title">Pessoais</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#shipping-info" class="nav-link" data-toggle="tab">
                                                <span class="step-number">02</span>
                                                <span class="step-title">Dados Boleto</span>
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="#payment-info" class="nav-link" data-toggle="tab">
                                                <span class="step-number">03</span>
                                                <span class="step-title">Confirmar</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <form method="POST" action="{{ route('billet.store') }}" id="formu" class="needs-validation" novalidate>
                                        @csrf
                                        <div class="tab-content twitter-bs-wizard-tab-content">
                                            <div class="tab-pane active" id="billing-info">
                                                <div>
                                                    <div>
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <div class="form-group mb-4">
                                                                    <label for="name">Nome/Razão Social</label>
                                                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                                                    <div class="invalid-feedback">
                                                                        Campo obrigatório!
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="form-group mb-4">
                                                                    <label for="cpf_cnpj">CPF/CNPJ</label>
                                                                    <input type="text" class="form-control" value="{{ old('cpf_cnpj') }}" name="cpf_cnpj" id="cpf_cnpj" required>
                                                                    <div class="invalid-feedback">
                                                                        Campo obrigatório!
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="form-group mb-4">
                                                                    <label for="cep">CEP</label>
                                                                    <input name="cep" type="text" class="form-control" id="cep" size="10" value="{{ old('cep') }}" maxlength="9" placeholder="99999-999" onblur="pesquisacep(this.value);" required />
                                                                    <div class="invalid-feedback">
                                                                        Campo obrigatório!
                                                                    </div>
                                                                    <div id="erro_cep" style="color: red;"></div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-4">
                                                                    <label for="rua">Logradouro</label>
                                                                    <input name="public_place" type="text" class="form-control" id="rua" size="60" value="{{ old('public_place') }}" required />
                                                                    <div class="invalid-feedback">
                                                                        Campo obrigatório!
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div class="form-group mb-4">
                                                                    <label for="cidade">Cidade</label>
                                                                    <input name="city" type="text" id="cidade" class="form-control" size="40" required value="{{ old('city') }}" />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-1">
                                                                <div class="form-group mb-4">
                                                                    <label for="uf">UF</label>
                                                                    <input name="uf" type="text" id="uf" size="2" class="form-control" required value="{{ old('uf') }}" />
                                                                    <div class="invalid-feedback">
                                                                        Campo obrigatório!
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-2">
                                                                <div class="form-group mb-4">
                                                                    <label for="numero">Numero</label>
                                                                    <input name="number" type="text" id="numero" class="form-control" required value="{{ old('number') }}" />
                                                                    <div class="invalid-feedback">
                                                                        Campo obrigatório!
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-8">
                                                                <div class="form-group mb-4">
                                                                    <label for="complemento">Complemento</label>
                                                                    <input name="complement" type="text" id="complemento" class="form-control" value="{{ old('complement') }}" required />
                                                                    <div class="invalid-feedback">
                                                                        Campo obrigatório!
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>


                                            </div>
                                            <div class="tab-pane" id="shipping-info">
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <div class="form-group mb-8">
                                                            <label for="complemento">Valor</label>
                                                            <input name="price" type="text" id="valor" class="form-control" required />
                                                            <div class="invalid-feedback">
                                                                Campo obrigatório!
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <div class="form-group mb-4">
                                                            <label for="complemento">Juros %</label>
                                                            <input name="fees" value="{{ old('fees') }}" type="text" id="fees" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="form-group mb-4">
                                                            <label for="expiration">Data de Vencimento</label>
                                                            <input id="expiration" type="date" value="{{ old('expiration') }}" name="expiration" class="form-control" required>
                                                            <div class="invalid-feedback">
                                                                Campo obrigatório!
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7">
                                                        <div class="form-group mb-4">
                                                            <label for="instructions">Instruções</label>
                                                            <input id="instructions" value="{{ old('instructions') }}" name="instructions" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="payment-info">
                                                <div class="row justify-content-center">
                                                    <div class="col-lg-6">
                                                        <div class="text-center">
                                                            <div class="mb-4">
                                                                <i class="mdi mdi-check-circle-outline text-success display-4"></i>
                                                            </div>
                                                            <div>
                                                                <h5>Lembre-se de conferir suas informações</h5>
                                                                <button class="btn btn-success" type="submit"> Gerar Boleto </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </form>
                                </div>

                                <ul class="pager wizard twitter-bs-wizard-pager-link">
                                    <li class="previous"><a href="#">Voltar</a></li>
                                    <li class="next"><a href="#">Próximo</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- end row -->
        </div>
        <!-- End Page-content -->
    </div>
    <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- JAVASCRIPT -->
    <!-- JAVASCRIPT -->
    <script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('libs/select2/js/select2.min.js') }}"></script>

    <!-- twitter-bootstrap-wizard js -->
    <script src="{{ asset('libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>

    <script src="{{ asset('libs/twitter-bootstrap-wizard/prettify.js')}}"></script>
    <!-- ecommerce-checkout init -->
    <script src="{{ asset('js/pages/ecommerce-checkout.init.js') }}"></script>

    <script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>

    <script src="{{ asset('js/pages/form-validation.init.js') }}"></script>

    <!-- form mask -->
    <script src="{{ asset('libs/inputmask/jquery.inputmask.min.js') }}"></script>

    <!-- <script src="{{ asset('mask/dist/jquery.mask.js') }}"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

    <!-- form mask init -->
    <script src="{{ asset('js/pages/form-mask.init.js') }}"></script>

    <script src="{{ asset('js/pages/form-validation.init.js') }}"></script>

    <script src="{{ asset('js/app.js') }}"></script>

    <script src="{{ asset('js/cep.js') }}"></script>

    <script src="{{ asset('js/mask.js') }}"></script>

</body>

</html>