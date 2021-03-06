@extends('layouts.app')
@section('content')


@if(!$errors->any())
<div id="preloader">
    <div class="row"  style="margin-top:5%;">
        <div class="col-12">
            <div class="text-center">
                <img src="{{asset('img/logo-icon.png')}}" class="img-fluid" alt="">
            </div>
        </div>
    </div>

    <div id="status">
        <div class="spinner">
            <i class="ri-loader-line spin-icon"></i>
        </div>
    </div>
</div>
@endif
<div class="row text-center mb-4 request" id="loading">
    <div class="col-md-12">
        <div class="spinner-grow text-primary" role="status">
            <span class="sr-only"></span>
        </div>
        <div class="spinner-grow text-secondary" role="status">
            <span class="sr-only"></span>
        </div>
        <div class="spinner-grow text-success" role="status">
            <span class="sr-only"></span>
        </div>
        <div class="spinner-grow text-danger" role="status">
            <span class="sr-only"></span>
        </div>
        <div class="spinner-grow text-warning" role="status">
            <span class="sr-only"></span>
        </div>
        <div class="spinner-grow text-info" role="status">
            <span class="sr-only"></span>
        </div>
        <div class="spinner-grow text-dark" role="status">
            <span class="sr-only"></span>
        </div>
    </div>
</div>
@if($errors->any())
@foreach($errors->all() as $error)
<div class="alert alert-danger" role="alert">
    {{ $error }}
</div>
@endforeach
@endif
<div class="alert alert-danger erro_request" id="erro_request" role="alert"> </div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div id="checkout-nav-pills-wizard" class="twitter-bs-wizard">
                    <ul class="twitter-bs-wizard-nav">
                        <li class="nav-item">
                            <a href="#billing-info" class="nav-link" id="billing" data-toggle="tab">
                                <span class="step-number">01</span>
                                <span class="step-title">Pessoais</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#shipping-info" class="nav-link" id="shipping" data-toggle="tab">
                                <span class="step-number">02</span>
                                <span class="step-title">Dados Boleto</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#payment-info" class="nav-link" id="payment" data-toggle="tab">
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
                                                    <label for="name">Nome/Razão Social <span class="required-span">*</span> </label>
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" autofocus required>
                                                    <div class="invalid-feedback">
                                                        Campo obrigatório!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group mb-4">
                                                    <label for="cpf_cnpj">CPF/CNPJ <span class="required-span">*</span></label>
                                                    <input type="text" class="form-control" value="{{ old('cpf_cnpj') }}" name="cpf_cnpj" id="cpf_cnpj" required>
                                                    <div class="invalid-feedback">
                                                        Campo obrigatório!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group mb-4">
                                                    <label for="cep">CEP <span class="required-span">*</span></label>
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
                                                    <label for="rua">Logradouro <span class="required-span">*</span></label>
                                                    <input name="public_place" type="text" class="form-control" id="rua" size="60" value="{{ old('public_place') }}" required />
                                                    <div class="invalid-feedback">
                                                        Campo obrigatório!
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group mb-4">
                                                    <label for="cidade">Cidade <span class="required-span">*</span></label>
                                                    <input name="city" type="text" id="cidade" class="form-control" size="40" required value="{{ old('city') }}" />
                                                </div>
                                            </div>

                                            <div class="col-lg-1">
                                                <div class="form-group mb-4">
                                                    <label for="uf">UF <span class="required-span">*</span></label>
                                                    <input name="uf" type="text" id="uf" size="2" class="form-control" required value="{{ old('uf') }}" />
                                                    <div class="invalid-feedback">
                                                        Campo obrigatório!
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-2">
                                                <div class="form-group mb-4">
                                                    <label for="numero">Numero <span class="required-span">*</span></label>
                                                    <input name="number" type="text" id="numero" class="form-control" required value="{{ old('number') }}" />
                                                    <div class="invalid-feedback">
                                                        Campo obrigatório!
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group mb-4">
                                                    <label for="complemento">Complemento <span class="required-span">*</span></label>
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
                                    <div class="col-lg-3">
                                        <div class="form-group mb-8">
                                            <label for="complemento">Valor <span class="required-span">*</span></label>
                                            <input name="price" type="text" value="{{ old('price') }}" id="valor" class="form-control" required />
                                            <div class="invalid-feedback">
                                                Campo obrigatório!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-4">
                                            <label for="complemento">Juros</label>
                                            <input name="fees" value="{{ old('fees') }}" data-parsley-minlength="0" data-parsley-maxlength="1" type="text" id="fees" class="form-control" placeholder="de 0 a 1" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-">
                                            <label for="expiration">Data de Vencimento <span class="required-span">*</span></label>
                                            <input id="expiration" type="date" value="{{ old('expiration') }}" name="expiration" class="form-control" required>
                                            <div class="invalid-feedback">
                                                Campo obrigatório!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group mb-4">
                                            <label for="instructions">Instruções</label>
                                            <input id="instructions" max="100" value="{{ old('instructions') }}" name="instructions" type="text" class="form-control">
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
                                                <button class="btn btn-success" id="register" type="submit"> Gerar Boleto </button>
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
@endsection

@section('scripts')
<!-- Parsley -->
<script src="{{ asset('libs/parsleyjs/parsley.min.js') }}"></script>

<!-- Form Validation -->
<script src="{{ asset('js/pages/form-validation.init.js') }}"></script>

<!-- form mask -->
<script src="{{ asset('libs/inputmask/jquery.inputmask.min.js') }}"></script>

<!-- Mask jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

<!-- form mask init -->
<script src="{{ asset('js/pages/form-mask.init.js') }}"></script>

<script src="{{ asset('js/mask.js') }}"></script>

@if($errors->any())
<script>
    function message(icon, title, text) {
        Swal.fire({
            icon: icon,
            title: title,
            text: text,
        })
    }
    message('error', 'Ops...', 'Verifique os erros que aconteceram');
</script>
@endif
@endsection