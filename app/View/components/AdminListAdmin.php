<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminListAdmin extends Component
{

    public $admins;
    /**
     * Create a new component instance.
     */
    public function __construct($admins)
    {
        //
        $this->admins=$admins;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin-list-admin');
    }
}
