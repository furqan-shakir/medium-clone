@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 ">
            <h2>Hi! This is the admin panel, You can manage your own articles from here :)</h2>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <a class="btn btn-primary" href="{{ url('articles/create') }}">New Article</a>

                    </div>

                    <table class="table table-stripped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($articles as $article)
                            <tr>
                                <td>{{$article->title}}</td>
                                <td>
                                    <a href="{{ url('articles/view/'.$article->id) }}"><img title="view" src="https://img.icons8.com/metro/26/000000/view-file.png" /></a> &nbsp; &nbsp;
                                    <a href="{{ url('articles/edit/'.$article->id) }}"><img title="edit" src="https://img.icons8.com/material-sharp/24/000000/edit.png" /></a> &nbsp; &nbsp;
                                    <a data-toggle="modal" data-target="#exampleModal" href="#"><img title="delete" src="https://img.icons8.com/android/24/000000/trash.png" /></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2">No arrticles</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
@if(!empty($article))
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Article</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Do you really want to delete this article?
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-secondary" data-dismiss="modal">No</a>
                <a type="button" class="btn btn-primary" href="{{ url('articles/delete/'.$article->id) }}">Yes</a>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@section('scripts')

<script>
    $(document).ready(function() {});
</script>

@endsection