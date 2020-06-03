<?php

namespace App\View\Components;

use App\Group;
use Illuminate\View\Component;

/**
 * FileTable used in group views, admin views and public view
 * @package App\View\Components
 */
class FileTable extends Component
{
    /**
     * The type of the file table
     * 'normal' or 'admin'
     *
     * @type string
     */
    public $type;

    /**
     * The group of this file table
     *
     * @type Group
     */
    public $group;

    /**
     * Create a new component instance.
     *
     * @param $type
     * @param Group $group
     * @param $expiry
     */
    public function __construct($type, Group $group)
    {
        $this->type = $type;
        $this->group = $group;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.file-table');
    }
}
