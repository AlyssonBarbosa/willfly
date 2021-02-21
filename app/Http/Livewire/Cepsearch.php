<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Cepsearch extends Component
{

    public $results;
    public function render()
    {
        return view('livewire.cepsearch');
    }

    public function mount()
    {

    }

    public function cepSearch($cep)
    {

        $this->results ++;
        // try {
        //     $this->reset('results');
        //     $results = simplexml_load_file("https://viacep.com.br/ws/$cep/xml/");
        //     $results = (array) $results;
        //     $results['municipio'] = $results['localidade'];
        //     // unset($results['localidade']);
        //     $this->results = $results;
        // } catch (\Exception $e) {
            
        // }
    }
    
}
