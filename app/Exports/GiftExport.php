<?php

namespace App\Exports;

use App\Gift;
use App\GiftItem;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class GiftExport implements FromView
{

    public $data;
    public function __construct($data){
        $this->data = $data;
    }

    public function view(): View{
        return view('exports.gift_list',[
            'data' => Gift::whereIn('id',$this->data)->get(),
            'item' => GiftItem::all()
        ]);
    }
}
