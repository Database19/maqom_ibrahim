<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ModalComponent extends Component
{
    public $title;
    public $id;
    public $tableId;
    public $listData;
    public $columns;

    /**
     * Membuat instance komponen baru.
     *
     * @return void
     */
    public function __construct($title, $id, $tableId, $listData, $columns)
    {
        $this->title = $title;
        $this->id = $id;
        $this->tableId = $tableId;
        $this->listData = $listData;
        $this->columns = $columns;
    }

    /**
     * Mendapatkan tampilan / konten yang mewakili komponen.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.modal-component');
    }
}
