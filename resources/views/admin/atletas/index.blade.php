@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" style="overflow-x: auto;">
                    <h4 class="card-title">Atletas</h4>
                    </p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th> Nome </th>
                                <th> Celular </th>
                                <th> Email </th>
                                <th> CPF </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($atletas as $atleta)
                                <tr>
                                    <td class="py-1">
                                        {{$atleta->nome}}
                                    </td>
                                    <td>
                                      {{ date("d/m/Y", strtotime( $atleta->nome))}}
                                    </td>
                                    <td>
                                      {{ date("d/m/Y", strtotime( $atleta->celular))}}
                                    </td>
                                    <td> 
                                      {{ date("d/m/Y", strtotime( $atleta->cpf))}}
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
