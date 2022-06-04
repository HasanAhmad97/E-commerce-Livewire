<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Illuminate\Database\QueryException;
use Livewire\Component;
use http\Client\Request;
class CategoryComponent extends Component
{
    public $updateMode = false;
    public $name;
    public $slug;
    public $category_id;

    public function generateSlug(){
        $this->slug = \Illuminate\Support\Str::slug($this->name);
    }
    public function addNew(){
        dd('here');
    }
    public function storeCategory(){
        $category = new Category();
        $category->name = $this->name;
        $category->slug = $this->slug;
        $category->save();
//        session()->flash('message','category created succesfully');
        toastr()->success('Added Succesfuly');
        return redirect()->route('admin.categories');
//        return toastr()->success('Added Succesfuly');
    }
    public function edit($id)
    {
        $this->updateMode = true;
        $category = Category::where('id',$id)->first();
        $this->category_id = $id;
        $this->name = $category->name;
        $this->slug = $category->slug;
    }

    public function update()
    {
//        $validatedDate = $this->validate([
//            'name' => 'required',
//            'slug' => 'required|email',
//        ]);
        if ($this->category_id) {
            $category = Category::find($this->category_id);
            $category->name = $this->name;
            $category->slug = $this->slug;
            $category->save();
            $this->updateMode = false;
            session()->flash('message', 'Category Updated Successfully');
            return redirect()->route('admin.categories');
        }
    }

    public function delete($id)
    {
        try {
            if($id){
                Category::where('id',$id)->delete();
                session()->flash('deleteMessage', 'Category Deleted Successfully');
                return redirect()->route('admin.categories');
            }

        } catch (QueryException $e) {

            session()->flash('deleteMessage', 'You can not delete this category');
        }

    }

    public function render()
    {
        $categories = Category::paginate(5);
        return view('livewire.admin.category-component',['categories'=>$categories])->layout('layouts.dashboard.app');
    }
}
