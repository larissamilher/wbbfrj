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
                <table class="min-w-full divide-y divide-gray-200" style="WIDTH: 100%;">
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
                        <td style="width: 120PX;">  <strong>QUANTIDADE </strong></td>     
                        <td> <strong>DESCRIÇÃO </strong></td>                       
                    </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white">
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900" style="text-align: center;">
                                {{$retorno['candidaturas']}}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900">
                                <strong>Candidaturas Confirmadas </strong>
                            </td>                                    
                        </tr>

                        <tr class="bg-white">
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900" style="text-align: center;">
                                {{$retorno['candidaturas-pendentes']}}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900">
                                <strong>Candidaturas Pendentes</strong>
                            </td>                                    
                        </tr>

                        <tr class="bg-white">
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900" style="text-align: center;">
                                {{$retorno['candidaturas-recusadas']}}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900">
                                <strong>Candidaturas Recusada </strong>
                            </td>                                    
                        </tr>

                        <tr class="bg-white">
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900"style="text-align: center;">
                                {{$retorno['boleto']}}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900">
                                <strong>Pagamentos via boleto </strong>
                            </td>                      
                        </tr>

                        <tr class="bg-white">
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900"style="text-align: center;">
                                {{$retorno['pix']}}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900">
                                <strong>Pagamentos via pix </strong>
                            </td>                      
                        </tr>

                        <tr class="bg-white">
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900"style="text-align: center;">
                                {{$retorno['cartao']}}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900">
                                <strong>Pagamentos via cartão de crédito </strong>
                            </td>                      
                        </tr>

                        <tr class="bg-white">
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900"style="text-align: center;">
                                {{$retorno['convidados']}}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900">
                                <strong>Convidados </strong>
                            </td>                      
                        </tr>
                       
                    </tbody>
                </table>
                <hr>

                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>  
                        <td style="width: 120PX;text-align: center;"><strong>VALOR</strong></td>     
                        <td><strong>FORMA DE PAGAMENTO</strong></td>                       
                    </tr>
                    </thead>
                    <tbody>
                        
                        <tr class="bg-white">
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900"style="text-align: center;">
                                R$ {{  number_format($retorno['valor-boleto'], 2, ',', '.')}} 
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900">
                                <strong>Boleto </strong>
                            </td>                      
                        </tr>

                        <tr class="bg-white">
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900"style="text-align: center;">
                                R$ {{  number_format($retorno['valor-pix'], 2, ',', '.')}} 
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900">
                                <strong>PIX </strong>
                            </td>                      
                        </tr>

                        <tr class="bg-white">
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900"style="text-align: center;">
                                R$ {{  number_format($retorno['valor-cartao'], 2, ',', '.')}} 
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900">
                                <strong>Cartão de crédito </strong>
                            </td>                      
                        </tr>

                        <tr class="bg-white">
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900"style="text-align: center;">
                                R$ {{  number_format($retorno['valor-total'], 2, ',', '.')}} 
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900">
                                <strong>TOTAL </strong>
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