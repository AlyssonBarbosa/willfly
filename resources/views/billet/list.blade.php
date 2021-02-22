@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        @if($errors->any())
        @foreach($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            {{ $error }}
        </div>
        @endforeach
        @endif
        @if(session()->has('message'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('message') }}
        </div>
        @endif
        <div class="card">
            <div class="card-body  pt-0">
                <ul class="nav nav-tabs nav-tabs-custom mb-4">
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold p-3 active" href="ecommerce-orders.html#">Boletos</a>
                    </li>
                </ul>
                <div class="table-responsive text-center">
                    <table class="table table-centered datatable dt-responsive nowrap ">
                        <thead class="thead-light">
                            <tr>
                                <th> Codigo </th>
                                <th>Vencimento</th>
                                <th>Cliente</th>
                                <th>Valor</th>
                                <th>Status</th>
                                <th>Baixar</th>
                                <th style="width: 120px;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($billets as $key => $billet)
                            <tr>
                                <td><a href="javascript: void(0);" class="text-dark font-weight-bold"> {{ $billet->code }} </a> </td>
                                <td>
                                    {{ formatDateAndTime($billet->expiration, 'd/m/Y') }}
                                </td>
                                <td> {{ $billet->name }} </td>

                                <td>
                                    {{ formatBrl($billet->price) }}
                                </td>
                                <td>
                                    @if($billet->status != 'Cancelado')
                                    <div class="badge badge-soft-success font-size-12"> {{ $billet->status }} </div>
                                    @else
                                    <div class="badge badge-soft-danger font-size-12"> {{ $billet->status }} </div>
                                    @endif

                                </td>
                                <td>
                                    @if($billet->status != 'Cancelado')
                                    <a class="btn btn-light btn-rounded" target="_blank" href="https://sandbox.easypag.com.br/api/v1/invoices/{{ $billet->code }}/view/boleto">Baixar <i class="ri-download-2-fill"></i></a>
                                    @endif
                                </td>
                                <td>
                                    @if($billet->status != 'Cancelado')
                                    <form action="{{ route('billet.destroy', $billet->id) }}" id="destroy{{$billet->id}}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <a onclick="document.getElementById('destroy{{$billet->id}}').submit();" type="submit" class="text-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cancelar"><i class="ri-delete-bin-2-line"></i></i></a>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item {{ $billets->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $billets->previousPageUrl() }}" tabindex="-1">Anterior</a>
                            </li>
                            @for($i = 0; $i < $billets->lastPage(); $i++)
                                <li class="page-item {{ $billets->currentPage() == $i + 1 ? 'active' : '' }}"><a class="page-link" href="{{ $billets->url($i + 1) }}"> {{ $i + 1 }} </a></li>
                                @endfor
                                <li class="page-item {{ $billets->currentPage() == $billets->lastPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $billets->nextPageUrl() }}">Próximo</a>
                                </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection