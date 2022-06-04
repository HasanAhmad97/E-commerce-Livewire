<div class="main-footer">

    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#exampleModal">
        Add New Category
    </button>
    @if(\Illuminate\Support\Facades\Session::has('message'))
        <div class="alert alert-success" role="alert">{{\Illuminate\Support\Facades\Session::get('message')}}</div>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('deleteMessage'))
        <div class="alert alert-danger" role="alert">{{\Illuminate\Support\Facades\Session::get('deleteMessage')}}</div>
    @endif
<table class="table">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Category Name</th>
        <th scope="col">Slug</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($categories as $category)
    <tr>
        <th scope="row">{{$category->id}}</th>
        <td>{{$category->name}}</td>
        <td>{{$category->slug}}</td>
        <td>
            <a class="text-danger" data-target="#delete" data-toggle="modal" style="cursor:pointer;font-size: 26px;margin-left:10px "><i class="fa fa-trash"></i></a>
            <a data-target="#edit" wire:click="edit({{ $category->id }})" data-toggle="modal" style="cursor:pointer;font-size: 26px;margin: 5px;"><i class="fa fa-edit"></i></a>
        </td>
    </tr>

    <!-- Edit_modal_Category -->

    <div class="modal fade" wire:ignore.self id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                </div>
                <div class="modal-body">

                    <form style="padding: 0px 20px">
                        <div class="row" style="padding: 0px 20px">
                            <div class="col">
                                <label for="name" class="mr-sm-2">Name
                                    :</label>

                                <input id="name" wire:model="name" type="text" class="form-control" wire:keyup="generateSlug">
                            </div>
                            <div class="col">
                                <label for="Name_en" class="mr-sm-2">Slug
                                    :</label>
                                <input type="text" class="form-control" wire:model="slug">
                                <input type="hidden" class="form-control" wire:model="category_id">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- delete_modal_Grade -->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                        id="exampleModalLabel">
                        {{ trans('Grades_trans.delete_Grade') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        @csrf
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                            <button wire:click.prevent="delete({{$category->id}})" class="btn btn-danger">delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    </tbody>
</table>
    <div class="wrap-pagination-info">
        {{$categories->links('customPagination')}}
    </div>


<!-- add_modal_Category -->

<div class="modal fade" wire:ignore.self id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
            </div>
            <div class="modal-body">

                <form style="padding: 0px 20px">
                    <div class="row">
                    <div class="col">
                        <label for="name" class="mr-sm-2">Name
                            :</label>

                        <input id="name" type="text" class="form-control"  wire:model="name" wire:keyup="generateSlug">
                    </div>
                    <div class="col">
                        <label for="Name_en" class="mr-sm-2">Slug
                            :</label>
                        <input type="text" class="form-control" wire:model="slug">
                    </div>
                </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" wire:click="storeCategory()" class="btn btn-primary" data-dismiss="modal">Save changes</button>
            </div>
        </div>
    </div>
</div>



