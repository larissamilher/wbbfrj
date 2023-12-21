<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="images/favicon.png" rel="icon" />
    <title>General Invoice - PageCapture</title>

    {{-- <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> --}}
</head>
<body>
    <div class="max-w-7xl mx-auto">


        <section class="px-10 py-5">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200" style="
                WIDTH: 100%;
            ">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" colspan="2" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <img alt="WBBF" src="https://www.wbbfrj.com/img/logo/wbbf-circulo.png" style="max-width: 50px; display: block; margin: 0 auto;">
                            <br/>
                            WBBF RJ - Ficha de Inscrição
                        </th>                        
                    </tr>
                    </thead>
                </table>

                <hr>

                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        
                        
                    </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white">
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900">
                                <strong>Nome: </strong>
                                {{$inscricao->atleta->nome}}
                            </td>                                    
                        </tr>

                        <tr class="bg-white">
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900">
                                <strong>Telefone: </strong>
                                {{$inscricao->atleta->celular}}
                            </td>                      
                        </tr>

                        <tr class="bg-white">
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900">
                                <strong>CPF: </strong>
                                {{$inscricao->atleta->cpf}}
                            </td>                   
                        </tr>

                        <tr class="bg-white">
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900">
                               <strong>Data de Nascimento: </strong>
                               {{ date("d/m/Y", strtotime( $inscricao->atleta->data_nascimento))}}
                            </td>                    
                        </tr>

                        <tr class="bg-white">
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900">
                                <strong>Email: </strong>
                                {{$inscricao->atleta->email}}
                            </td>                      
                        </tr>

                        <tr class="bg-white">
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900">
                               <strong> Código da Inscrição: 
                                </strong> {{$inscricao->codigo}}
                            </td>                 
                        </tr>

                        <tr class="bg-white">
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900">
                                <strong>Data da inscrição: 
                                </strong> {{ date("d/m/Y H:m", strtotime( $inscricao->created_at))}}
                            </td>                
                        </tr>

                        <tr class="bg-white">
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900">                               
                                <strong>Campeonato: </strong>
                                {{$inscricao->campeonato->nome}}
                            </td>                   
                        </tr>

                        <tr class="bg-white">
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900">
                                <strong>SubCategoria: </strong>
                                {{$inscricao->categoria->nome}}
                            </td>                    
                        </tr>

                        <tr class="bg-white">
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900">
                               <strong>Status do Pagamento: </strong>
                               {{$inscricao->status_pagamento}}
                            </td>                 
                        </tr>

                        <tr class="bg-white">
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900">
                                <strong>Peso Atleta: </strong>
                                {{ $inscricao->peso}}
                            </td>                     
                        </tr>
                    </tbody>
                </table>
                <hr>

            </div>
        </section>

        <section class="flex justify-between px-10 py-5">
            <p class="text-xs">
                <strong>PDF gerado pelo sistema WBBF RJ no dia {{ date("d/m/Y")}}</strong>
            </p>
        </section>
    </div>

    <style>

        th{
            font-size: 20px !important;
            font-family: inherit !important;
        }

        td{
            font-size: 16px !important;
            font-family: inherit !important;
        }

    </style>
</body>
</html>