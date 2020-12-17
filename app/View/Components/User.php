<?php

namespace App\View\Components;

use Illuminate\View\Component;

class User extends Component
{
    public $users;
    public $letters;
    public $totalbooks;
    public $statuses;

    /**
     * Create a new component instance.
     *
     * @param $users
     * @param $letters
     * @param $totalbooks
     * @param $statuses
     */
    public function __construct($users,$letters,$totalbooks,$statuses)
    {
        $this->users = $users;
        $this->letters = $letters;
        $this->totalbooks = $totalbooks;
        $this->statuses = $statuses;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.user');
    }
}
