@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
            <button type="button" class="btn btn-danger btn-fw"><a class="nav-link"
                    href="{{ route('admin.campeonato.novo') }}">ADICONAR CAMPEONATO</a></button>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" style="overflow-x: auto;">
                    <h4 class="card-title">Campeonatos</h4>
                    </p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th> Nome </th>
                                <th> Data Inicial Inscrições </th>
                                <th> Data Final Inscrições </th>
                                <th> Data do Campeonato </th>
                                <th> Valor </th>
                                <th> Local </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($campeonatos as $campeonato)
                                <tr>
                                    <td class="py-1">
                                        {{$campeonato->nome}}
                                    </td>
                                    <td>
                                      {{ date("d/m/Y", strtotime( $campeonato->data_inicio_inscricao))}}
                                    </td>
                                    <td>
                                      {{ date("d/m/Y", strtotime( $campeonato->data_final_inscricao))}}
                                    </td>
                                    <td> 
                                      {{ date("d/m/Y", strtotime( $campeonato->data_campeonato))}}
                                    </td>
                                    <td> R$ {{  number_format( $campeonato->valor, 2, ',', '.')}}</td>
                                    <td> {{$campeonato->local}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
