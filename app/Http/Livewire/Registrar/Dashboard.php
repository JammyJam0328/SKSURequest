<?php

namespace App\Http\Livewire\Registrar;

use Livewire\Component;
use App\Models\Campus;
use App\Models\Course;
use App\Models\Document;
use App\Models\Request as RequestModel;
use App\Models\Requestorinformation;
use Illuminate\Database\Eloquent\Builder;
class Dashboard extends Component
{
    public $countUnread;
    public $countDocument;
    public $countPending;
    public $countToReview;

    public $requests;

    

    public function render()
    {
        $requests=RequestModel::whereHas('requestorinformation',function(Builder  $q){
                         $q->where('campus_id',auth()->user()->campus_id);
                     })->get();
        $this->countUnread=$requests->where('read','no')->count();
        $this->countPending=$requests->where('status','Pending')->count();
        $this->countToReview=$requests->where('status','Payment Review')->count();


        
        return view('livewire.registrar.dashboard');
    }
    
}
