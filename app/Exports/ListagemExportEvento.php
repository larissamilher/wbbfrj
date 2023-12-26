<?php

namespace App\Exports;

use App\Models\InscricaoEvento;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;

class ListagemExportEvento implements FromCollection
{
    protected $eventoId;

    public function __construct($eventoId)
    {
        $this->eventoId = $eventoId;
    }

    public function collection()
    {
        $inscricoes = InscricaoEvento::where('evento_id',$this->eventoId )->get(); 
    
        $dados[] =[
            'nome' => 'Nome',
            'cpf' => 'CPF',
            'email' => 'Email', 
            'celular' => 'Celular'
        ];
        
        foreach($inscricoes as $inscricao){
            $dados [] = [
                'nome' => $inscricao->nome,
                'cpf' => $inscricao->cpf,
                'email' => $inscricao->email,
                'celular' =>  $inscricao->celular,        
            ];
        }

        $dados = collect($dados);
             
        $data = $dados->map(function ($inscricao) {
            return [
                'Nome' => $inscricao['nome'],
                'CPF' => $inscricao['cpf'],
                'Email' => $inscricao['email'],
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


