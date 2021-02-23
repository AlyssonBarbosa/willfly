<!-- Jquery -->
<script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap -->
<script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Metis menu -->
<script src="{{ asset('libs/metismenu/metisMenu.min.js') }}"></script>

<!-- Simples Bar -->
<script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>

<!-- Waves -->
<script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>

<!-- twitter-bootstrap-wizard js -->
<script src="{{ asset('libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>
<script src="{{ asset('libs/twitter-bootstrap-wizard/prettify.js')}}"></script>

<!-- Checkout -->
<script src="{{ asset('js/pages/ecommerce-checkout.init.js') }}"></script>

<!-- Sweet Alerts js -->
<script src="{{ asset('libs/sweetalert2/sweetalert2.min.js') }}"></script>

<!-- Sweet alert init js-->
<script src="{{ asset('js/pages/sweet-alerts.init.js') }}"></script>

<!-- Custom scripts -->
<script src="{{ asset('js/app.js') }}"></script>

<script src="{{ asset('js/custom.js') }}"></script>

<script src="{{ asset('js/cep.js') }}"></script>

@if(session()->has('message'))
<script>
    function message(icon, title, text) {
        Swal.fire({
            icon: icon,
            title: title,
            text: text,
        })
    }
    message('success', 'Sucesso', 'Operação realizada com sucesso!');
</script>
@endif