@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <form method="post" action="{{url('/articles/update/' . $data['article']->id)}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <!-- title -->
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{$data['article']->title}}" required>
                        </div>
                        <!-- content -->
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea class="form-control" name="content" id="idcontent" rows="10" required>
                              {!!$data['article']->content!!}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="tags[]">Tags</label>
                            <select class="col-md-12 select2" id="tags[]" name="tags[]" multiple="multiple" required>
                                @foreach($data['tags'] as $tag)
                                @if(in_array($tag->id,$data['article_tags']))
                                <option value="{{$tag->id}}" selected="selected">{{$tag->name}}</option>
                                @else
                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group float-right">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-danger " id="btnClear">Clear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script>
    $(document).ready(function() {
        $('#idcontent').summernote({
            placeholder: 'Start writing, What you see is what you get!',
            tabsize: 2,
            height: 300
        });
        $('#btnClear').on('click', function() {
            $('#idcontent').summernote('code', null);
        });

        $('.select2').select2();

    });
</script>

@endsection