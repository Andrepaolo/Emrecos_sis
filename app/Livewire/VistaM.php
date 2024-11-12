<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class VistaM extends Component
{
    use WithPagination;
    public $vista;
    public $search;
    public $view = 'materials';
    public function render()
    {
        return view('livewire.pages.vista-m')
            ->layout('layouts.app');
    }

    public function setView($view)
    {
        $this->view = $view;
    }

}
