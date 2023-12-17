@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">   
        <div class="col-lg-12 grid-margin stretch-card">
            <button type="button" class="btn btn-danger btn-fw">
                <a class="nav-link"
                    href="{{ route('admin.inscricoes.extrair-listagem') }}">
                    EXTRAIR LISTAGEM POR EVENTO
                </a>
            </button>
        </div>    
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" style="overflow-x: auto;">
                    <h4 class="card-title">Inscrições</h4>
                    </p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th> Nome </th>
                                <th> Gênero </th>
                                <th> Ativa </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inscricoes as $inscricao)
                                <tr>
                                    <td class="py-1">
                                       
                                    </td>
                                    <td>
                                      
                                    </td>
                                    <td>
                                     
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
