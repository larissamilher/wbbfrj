@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <div class="d-xl-flex justify-content-between align-items-start"> 
            <h2 class="text-dark font-weight-bold mb-2">Sobre os Campeonatos </h2>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tab-content tab-transparent-content">
                <div class="tab-pane fade show active" id="business-1" role="tabpanel" aria-labelledby="business-tab">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                            <div class="card-body text-center">
                                <h2 class="mb-2 text-dark font-weight-normal">Campeonatos</h2>
                                <h3 class="mb-4 font-weight-bold">{{$retorno['campeonatos']}}</h3>
                                
                            </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                            <div class="card-body text-center">
                                <h2 class="mb-2 text-dark font-weight-normal">Categorias</h2>
                                <h3 class="mb-4 font-weight-bold">{{$retorno['categorias']}}</h3>
                            </div>
                            </div>
                        </div>
                    
                    </div>

                    <div class="row">
                        
                        <div class="col-xl-6 col-lg-6 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                            <div class="card-body text-center">
                                <h2 class="mb-2 text-dark font-weight-normal">Atletas Inscritos</h2>
                                <h3 class="mb-4 font-weight-bold">{{$retorno['atletasComIsncricao']}}</h3>
                            </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                            <div class="card-body text-center">
                                <h2 class="mb-2 text-dark font-weight-normal">Atletas não Inscritos</h2>
                                <h3 class="mb-4 font-weight-bold">{{$retorno['atletasSemInscricao']}}</h3>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                            <div class="card-body text-center">
                                <h2 class="mb-2 text-dark font-weight-normal">Inscrições Totais</h2>
                                <h3 class="mb-4 font-weight-bold">{{$retorno['inscricoesCampeonatosTotais']}}</h3>
                                
                            </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                            <div class="card-body text-center">
                                <h2 class="mb-2 text-dark font-weight-normal">Inscrições Pagas</h2>
                                <h3 class="mb-4 font-weight-bold">{{$retorno['inscricoesCampeonatosPagos']}}</h3>
                            </div>
                            </div>
                        </div>                    
                    </div>                    
                </div>
                </div>
            </div>
        </div> 
    </div>

    <div class="content-wrapper">
        <div class="d-xl-flex justify-content-between align-items-start"> 
            <h2 class="text-dark font-weight-bold mb-2"> Sobre os Eventos </h2>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tab-content tab-transparent-content">
                <div class="tab-pane fade show active" id="business-1" role="tabpanel" aria-labelledby="business-tab">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                            <div class="card-body text-center">
                                <h2 class="mb-2 text-dark font-weight-normal">Compras Totais</h2>
                                <h3 class="mb-4 font-weight-bold">{{$retorno['inscricoesEventosTotais']}}</h3>
                                
                            </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                            <div class="card-body text-center">
                                <h2 class="mb-2 text-dark font-weight-normal">Compras Pagas</h2>
                                <h3 class="mb-4 font-weight-bold">{{$retorno['inscricoesEventosPagos']}}</h3>
                            </div>
                            </div>
                        </div>
                    
                    </div>

                </div>
                </div>
            </div>
        </div> 
    </div>

    <style>
        .tab-pane h3 {
            font-size: 40px;
            color: #ff1313;
        }
    </style>
@endsection



