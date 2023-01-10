<?php

namespace App\Http\Livewire\Post;

use Livewire\Component;
use App\Models\Serial;

class Serials extends Component
{
    public $series, $name, $description, $serial_id;
    public $updateCategory = false;

    protected $listeners = [
        'deleteCategory'=>'destroy'
    ];

    // Validation Rules
    protected $rules = [
        'name'=>'required',
        'description'=>'required'
    ];

    public function resetFields(){
        $this->name = '';
        $this->description = '';
    }

    public function store(){
        // Validate Form Request
        try{
            // Create Category
            Serial::create([
                'name'=>$this->name,
                'description'=>$this->description
            ]);

            // Set Flash Message
            session()->flash('success','Category Created Successfully!!');

            // Reset Form Fields After Creating Category
            $this->resetFields();
        }catch(\Exception $e){
            // Set Flash Message
            session()->flash('error','Something goes wrong while creating series!!');

            // Reset Form Fields After Creating Category
            $this->resetFields();
        }
    }

    public function edit($id){
        $series = Serial::findOrFail($id);
        $this->name = $series->name;
        $this->description = $series->description;
        $this->serial_id = $series->id;
        $this->updateCategory = true;
    }

    public function cancel()
    {
        $this->updateCategory = false;
        $this->resetFields();
    }

    public function update(){

        // Validate request

        try{

            // Update serie
            Serial::find($this->serial_id)->fill([
                'name'=>$this->name,
                'description'=>$this->description
            ])->save();

            session()->flash('success','Category Updated Successfully!!');

            $this->cancel();
        }catch(\Exception $e){
            session()->flash('error','Something goes wrong while updating serie!!');
            $this->cancel();
        }
    }

    public function destroy($id){
        try{
            Serial::find($id)->delete();
            session()->flash('success',"Category Deleted Successfully!!");
        }catch(\Exception $e){
            session()->flash('error',"Something goes wrong while deleting serie!!");
        }
    }

    public function render()
    {
        $this->series = Serial::select('id','name','description')->get();
        return view('livewire.post.series');
    }
}
