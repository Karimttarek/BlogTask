@extends('dashboard::layouts.app')

@section('content')
{{--<section class="p-5">--}}
    @if (session('status'))
        <div class="form-group col-12 p-1" style="background: #dff0d8">
            <p>{{ session('status') }}</p>
        </div>
    @endif

    <div class="content p-t-5">
        <div class="col-12">
        <div class="m-b-10">
            <a href="{{route('posts.create')}}">
                <button type="button" class="btn btn-outline-primary">Create Post</button>
            </a>
            </div>
        </div>
        <form action="{{route('post.destroy')}}" method="GET" id="form">
            <table class="table table-striped table-hover table-borderd table-sm">
                <thead>
                    <tr>
                    <th scope="col"><input type="checkbox" class="ckeck-all" onclick="checkAll()"></th>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Content</th>
                    <th scope="col">Image</th>
                    <th scope="col">Trash</th>
                    <th scope="col">options</th>
                    </tr>
                </thead>
                <tbody id="render">
                    @if ($posts->count() > 0)
                    @foreach ($posts as $post)
                    <tr>
                        <td><input type="checkbox" name="item[]" class="item" value="{{$post->id}}"></td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->author}}</td>
                        <td>{{$post->content}}</td>
                        <td> <img class="bd-placeholer-img bd-placeholder-img-lg img-fluid" width="100" src="{{URL::asset($post->image_url)}}" alt=""></td>
                        <td><a href="#">@if (!empty($post->deleted_at)) <i class="fa fa-undo undo"></i></a>@endif</td>
                        <td><a href="{{url('post/edit/'.$post->id)}}"><i class="fa fa-edit"></i></a><a href="#"><i class="fa fa-trash delete"></i></a></td>
                    </tr>
                    @endforeach
                    @else
                    <td colspan="6">No posts found!</td>
                    @endif
                </tbody>
                </table>
            </form>
        </div>
</section>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
               Are you sure to delete this items?
            </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger softDelete">Trash</button>
                    <button type="button" class="btn btn-outline-danger perDelete">Permenetly Delete</button>
                </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    /**
     *
     */
function checkAll() {
    $('input[class="item"]').each(function () {
        if ($('input[class="ckeck-all"]:checked').length == 0) {
            $(this).prop('checked', false);
        } else {
            $(this).prop('checked', true);
        }
    });
}
    /**
     *
     */
$(document).on('click' , '.delete' , function (){
    var checkedItem = $('input[class="item"]').filter(":checked").length;
    $(this).prop('checked' , true);
    if (checkedItem > 0){
        $('.modal-body').text('Warning: Deleting this posts will also delete the comments it contains. Are you sure you want to permanently delete this '+checkedItem +' records ?');
        $('.modal-footer').show();
    }else{
        $('.modal-body').text('No records found');
        $('.modal-footer').hide();
    }
    $('#exampleModal').modal('show');
});

/*
* Permenant delete
*/
$(document).on('click' , '.perDelete' , function (){
    $('#form').submit();
});

$(document).on('click' , '.softDelete' , function (){
    $("#form").attr('action', '/post/softDelete');
    $('#form').submit();
});

$(document).on('click' , '.undo' , function (){
    var checkedItem = $('input[class="item"]').filter(":checked").length;
    if(checkedItem > 0 ){
        $("#form").attr('action', '/post/rollBack');
        $('#form').submit();
    }
});

</script>

@endpush

