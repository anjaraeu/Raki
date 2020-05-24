<?php

namespace App\View\Components;

use App\Group;
use Illuminate\View\Component;

/**
 * GroupList used in dashboards
 * @package App\View\Components
 */
class GroupList extends Component
{
    /**
     * The group of this file table
     *
     * @type Group
     */
    public $group;

    /**
     * Create a new component instance.
     *
     * @param Group $group
     */
    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.group-list');
    }
}
