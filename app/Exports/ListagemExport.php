<?php

namespace App\Exports;

use App\Models\AtletaXCampeonato;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;

class ListagemExport implements FromCollection
{
    protected $campeonatoId;

    public function __construct($campeonatoId)
    {
        $this->campeonatoId = $campeonatoId;
    }

    public function collection()
    {
        $inscricoes = AtletaXCampeonato::with(['campeonato', 'categoria', 'atleta'])->where('campeonato_id',$this->campeonatoId )->get(); 
    
        $dados[] =[
            'nome' => 'Nome',
            'cpf' => 'CPF',
            'email' => 'Email', 
            'categoria' => 'SubCategoria', 
            'celular' => 'Celular'
        ];
        
        foreach($inscricoes as $inscricao){
            $dados [] = [
                'nome' => $inscricao->atleta->nome,
                'cpf' => $inscricao->atleta->cpf,
                'email' => $inscricao->atleta->email,
                'categoria' => $inscricao->categoria->nome,
                'celular' =>  $inscricao->atleta->celular,        
            ];
        }

        $dados = collect($dados);
             
        $data = $dados->map(function ($inscricao) {
            return [
                'Nome' => $inscricao['nome'],
                'CPF' => $inscricao['cpf'],
                'Email' => $inscricao['email'],
                'Caegoria' => $inscricao['categoria'],
                'Celular' => $inscricao['celular'],
            ];
        });

        return collect($data);
    }


    public function export($fileName, $writerType = null)
    {
        $filePath = storage_path('app/excel/' . $fileName);
        $this->store($filePath, $writerType);

        return $filePath;
    }

}


