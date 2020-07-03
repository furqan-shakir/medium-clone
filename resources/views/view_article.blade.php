@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <h1>{!!$data['article']->title!!}</h1>
                    <hr>
                    {!!$data['article']->content!!}

                    <div class="form-group">
                        <label for="tags[]">Tags</label>
                        <select readonly="true" class="col-md-12 select2" id="tags[]" name="tags[]" multiple="multiple" required>
                            @foreach($data['tags'] as $tag)
                            <option value="{{$tag->id}}" selected="selected">{{$tag->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script>
    $(document).ready(function() {
        $('.select2').select2({
            disabled: true
        });
    });
</script>

@endsection