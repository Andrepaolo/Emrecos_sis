<?php

namespace App\Livewire;

use Livewire\Component;

class VistaP extends Component
{   
    public $view='products';

    public function render()
    {
        return view('livewire.pages.vista-p')
        ->layout('layouts.app');
    }

    //funcion para vistas
    public function setView($view)
    {
        $this->view = $view;
    }
}
