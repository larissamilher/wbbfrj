@extends('layouts.site')

@section('content')
       
        <!--? Date Tabs Start -->
    <section class="date-tabs section-padding30">
        <div class="container">
            <!-- Section Tittle -->
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="section-tittle text-center mb-100" style="    margin-bottom: 0;">
                        <span>Calendário</span>
                        {{-- <h3>Atletas, atenção! Consulte os documentos em PDF na seção de Filiação deste site para informações 
                            sobre os procedimentos classificatórios de cada campeonato.</h3> --}}
                    </div>
                </div>
            </div>
            <!-- Heading & Nav Button -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 categorias" style="text-align: center;">
                    <img src="{{ asset('img/calendario.png') }}" alt="">                  
                </div>     
            </div>
           
        </div>
        
    </section>
  
@endsection
