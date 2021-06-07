<?php

namespace App\Http\Livewire\Registrar;

use Livewire\Component;
use App\Models\Campus;
use App\Models\Course;
use App\Models\Document;
use App\Models\Request as RequestModel;
use App\Models\Requestorinformation;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;
class Requestlist extends Component
{

    public $tab="";
    public $search;
    public $status='';
    public $countApproved;
    public $countReadyToClaim;
    public $countReview;

    public $viewRequest=false;

    public $requestview;
    public $amount;
    public $retrievaldate;
    public $countClaim;



    use WithPagination;

    
    public function render()
    {
        return view('livewire.registrar.requestlist',[
            'requests'=>RequestModel::where('status','like','%'.$this->tab.'%')->whereHas('requestorinformation',function(Builder  $q){
                         $q->where('campus_id',auth()->user()->campus_id)
                         ->where('lastname','like','%'.$this->search.'%');
                     })->paginate(10)
        ]);
    }

    public function mount()
    {

        $requests=RequestModel::whereHas('requestorinformation',function(Builder  $q){
            $q->where('campus_id',auth()->user()->campus_id);
        })->get();
        $this->countClaim=$requests->where('status','Ready To Claim')->count();
        $this->countApproved=$requests->where('status','Approved')->count();
        $this->countReview=$requests->where('status','Payment Review')->count();

    }
    
    public function view($id)
    {
        $this->viewRequest=true;
        $this->requestview=RequestModel::where('id',$id)->first();


        $this->amount = $this->requestview->documents()->sum('amount');


    }

    public function close()
    {
        $this->viewRequest=false;



    }

    public function update($id)
    {
        $this->validate([
            'retrievaldate'=>'required',
        ]);
        $update = RequestModel::find($id);
        $update->update([
            'status'=>'Ready To Claim',
            'retrievaldate'=>$this->retrievaldate,
        ]);

        $this->alert('success','Saved Successfully');
        $this->viewRequest=false;

    }

    
    public function claim($id)
    {
   
        $update = RequestModel::find($id);
        $update->update([
            'status'=>'Claimed',
        ]);

        $this->alert('success','Saved Successfully');

    }





}
