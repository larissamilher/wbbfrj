


 <table style=" padding: 5%; width:80% ">
    <thead>
    <tr>
        
        <td>
            <div class="image">
               
                <div class="ticket-number" style=" margin-top: -20px; text-align: right;">
                    <p style=" font-size: 12px; font-weight: 700;letter-spacing: 0.1em;color: #000;">
                       {{$inscricao->codigo}}
                    </p>
                </div>
            </div>
        </td>

        <td style="width: 350px">
            <div class="ticket-info" 
            style="    padding: 10px 10px;
            display: flex;
            flex-direction: column;
            text-align: center;
            justify-content: space-between;
            align-items: center;">
                <p class="date" style="width: 100%;padding: 2% 0; font-size: 16px;">
                    <span>
                        @php    
                            $dateTime = new DateTime($inscricao->evento->data_evento);
                            $locale = 'pt_BR';
                            $formatter = new IntlDateFormatter($locale, IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'UTC');
                            $formatter->setPattern('EEEE');  
                            $diaSemana = $formatter->format($dateTime);

                            echo ucfirst($diaSemana); 
                        @endphp
                    </span>
                    <span class="june-29" style=" font-size: 16px;"> 
                        @php
                            $dateTime = new DateTime($inscricao->evento->data_evento);
                            $dia = $dateTime->format('d');
                            echo $dia; 
                        @endphp
                        de 
                        @php
                            $dateTime = DateTime::createFromFormat('Y-m-d', $inscricao->evento->data_evento);

                            // Configurando a localidade para português do Brasil
                            setlocale(LC_TIME, 'pt_BR.utf-8', 'pt_BR', 'portuguese');

                            // Obtendo o nome do mês em português
                            $nomeMes = strftime('%B', $dateTime->getTimestamp());

                            switch ($nomeMes) {
                                case 'January':
                                    echo 'Janeiro';
                                    break;
                                
                                    case 'February':
                                    echo 'Fevereiro';
                                    break;

                                    case 'March':
                                    echo 'Março';
                                    break;

                                    case 'April':
                                    echo 'Abril';
                                    break;

                                    case 'May':
                                    echo 'Maio';
                                    break;

                                    case 'June':
                                    echo 'Junho';
                                    break;

                                    case 'July':
                                    echo 'Julho';
                                    break;

                                    case 'August':
                                    echo 'Agosto';
                                    break;

                                    case 'September':
                                    echo 'Setembro';
                                    break;

                                    case 'October':
                                    echo 'Outubro';
                                    break;

                                    case 'November':
                                    echo 'Novembro';
                                    break;

                                    case 'December':
                                    echo 'Dezembro';
                                    break;
                            } 
                        @endphp
                    </span>
                    <span>
                        @php                    
                            $dateTime = DateTime::createFromFormat('Y-m-d', $inscricao->evento->data_evento);
                            echo date('Y', $dateTime->getTimestamp()) ;
                        @endphp
                    </span>
                </p>
                <div class="show-name" style="padding-top: 3%;">
                    <h1 style=" font-size: 18px; letter-spacing: 0.1em;color: #000;"> 
                        @php
                            $texto = $inscricao->evento->nome;
                            $numeroPalavras = str_word_count($texto);

                            if ($numeroPalavras > 2) {
                                $palavras = explode(' ', $texto);
                                $palavras[2] .= "<br>";
                                $novoTexto = implode(' ', $palavras);
                                echo $novoTexto;
                            }else 
                                echo $texto;                            
                        @endphp
                    </h1>
                    <h2 style="font-size: 30px;">Larissa Milher</h2>
                </div>
                
                <p class="location" style="width: 100%;padding: 2% 0;  font-size: 12px;">
                    <span> {{$inscricao->evento->local}}</span>
                </p>
            </div>
        </td>

        <td style="width: 200px;text-align: center;border-left: 1.5px dashed rgba(126, 124, 124, 0.438);">
            
            <div class="right-info-container">
                <div class="show-name"  style="text-align: center;">
                    <h1 style=" font-size: 12px; font-weight: 700;letter-spacing: 0.1em;color: #000;"> 
                        @php
                            $texto = $inscricao->evento->nome;
                            $numeroPalavras = str_word_count($texto);

                            if ($numeroPalavras > 2) {
                                $palavras = explode(' ', $texto);
                                $palavras[2] .= "<br>";
                                $novoTexto = implode(' ', $palavras);
                                echo $novoTexto;
                            }else 
                                echo $texto;                            
                        @endphp
                    </h1>
                </div>
                <div class="time">
                    <p>{{ date("d.m.Y", strtotime( $inscricao->evento->data_evento))}}</p>				
                </div>
                <div class="barcode">
                    <img src="{{ $qrCodePath }}" alt="QR Code">

                </div>
                <p class="ticket-number"  style=" font-size: 12px; font-weight: 700;letter-spacing: 0.1em;color: #000;">
                    {{$inscricao->codigo}}
                </p>
            </div>
        </td>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>

<style media="print">
    body,
    html {
        font-family: "Staatliches", cursive;
        color: black;
        font-size: 14pt;
        letter-spacing: 0.1em;
    }

    /* Adicione outros estilos específicos para impressão aqui... */
</style>

<style>
    @import url("https://fonts.googleapis.com/css2?family=Staatliches&display=swap");
    @import url("https://fonts.googleapis.com/css2?family=Nanum+Pen+Script&display=swap");
    @import url('https://fonts.googleapis.com/css2?family=Teko:wght@400&display=swap');

    @font-face {
        font-family: 'Staatliches';
        font-style: normal;
        font-weight: 400;
        src: url('https://fonts.googleapis.com/css2?family=Staatliches&display=swap');
    }

    @font-face {
        font-family: 'Nanum Pen Script';
        font-style: normal;
        font-weight: 400;
        src: url('https://fonts.googleapis.com/css2?family=Nanum+Pen+Script&display=swap');
    }

    @font-face {
        font-family: 'Teko';
        font-style: normal;
        font-weight: 400;
        src: url('https://fonts.googleapis.com/css2?family=Teko:wght@400&display=swap');
    }

    img {
        max-width: 100%;
        height: auto;
    }


    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body,
    html {
        height: 100vh;
        display: grid;
        font-family: Arial, sans-serif;
        /* background: #ff1313; */
        color: black;
        font-size: 14px;
        letter-spacing: 0.1em;
    }

    .ticket {
        margin: auto;
        display: flex;
        background: white;
        box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px;
    }

    .left {
        display: flex;
    }

    .image {
        height: 180px;
        width: 180px;
        background-image: url("https://www.wbbfrj.com/img/logo/wbbf-logo.jpg");
        background-size: contain;
    }

    .admit-one {
        /* position: absolute; */
        color: darkgray;
        height: 250px;
        padding: 0 10px;
        letter-spacing: 0.15em;
        display: flex;
        text-align: center;
        justify-content: space-around;
        writing-mode: vertical-rl;
        transform: rotate(-180deg);
    }

    .left .ticket-number {
        height: 250px;
        width: 250px;
        display: flex;
        justify-content: flex-end;
        align-items: flex-end;
        padding: 5px;
    }

    .ticket-info {
        padding: 10px 30px;
        display: flex;
        flex-direction: column;
        text-align: center;
        justify-content: space-between;
        align-items: center;
    }

    .date {
        border-top: 1px solid gray;
        border-bottom: 1px solid gray;
        padding: 5px 0;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: space-around;
    }

    .date span:first-child {
        text-align: left;
    }

    .date span:last-child {
        text-align: right;
    }

    .date .june-29 {
        color: #ff1313;
        font-size: 20px;
    }

    .show-name {
        font-size: 24px;
        font-family: "Teko",sans-serif;
        color: #ff1313;
    }

    .show-name h1 {
        font-size: 24px;
        font-weight: 700;
        letter-spacing: 0.1em;
        color: #000;
    }

    .time {
        padding: 10px 0;
        color: #000;
        text-align: center;
        display: flex;
        flex-direction: column;
        gap: 10px;
        font-weight: 700;
    }

    .time span {
        font-weight: 400;
        color: gray;
    }

    .left .time {
        font-size: 16px;
    }


    .location {
        display: flex;
        justify-content: space-around;
        align-items: center;
        width: 100%;
        padding-top: 8px;
        border-top: 1px solid gray;
    }

    .location .separator {
        font-size: 20px;
    }

    .right {
        width: 180px;
        border-left: 1px dashed #404040;
    }

    .right .admit-one {
        color: darkgray;
    }

    .right .admit-one span:nth-child(2) {
        color: gray;
    }

    .right .right-info-container {
        height: 250px;
        padding: 10px 10px 10px 35px;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        align-items: center;
    }

    .right .show-name h1 {
        font-size: 18px;
    }

    .barcode {
        height: 100px;
    }

    .barcode img {
        height: 100%;
    }

    .right .ticket-number {
        color: gray;
    }

</style>