
@extends('layouts.sidebar')

@section('content')

  <h1>Edit post</h1>
  {{Form::open(['action' => ['PostsController@update', $post->id],'method'=> 'post', 'enctype' => 'multipart/form-data'])}}
  <div class="form-group">
       {{Form::label('title', 'Title')}}
       {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder'=> 'Title'])}}
  </div>
  
<!-- bigger text box for other formatting -->
  <div class="form-group">
     {{Form::label('body', 'Body')}}
     {{form::textarea('body', $post->body, ['id'=> 'editor','class' => 'form-control', 'placeholder'=> 'Body Text'])}}
</div>  
<!-- bigger text box for uploading files -->
<div class="form-group">
  {{Form::file('cover_image')}}
</div>
{{form::hidden('_method','PUT')}}
{{form::Submit('Submit', ['class'=>'btn btn-primary'])}}
  {{form::close()}}  
@endsection
