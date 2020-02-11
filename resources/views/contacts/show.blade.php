@extends('layout.app')

@section('content')
<div class="my-3 p-3 bg-white rounded shadow-sm">
<h3 class="border-bottom border-gray pb-2 mb-0"><strong>Contatos - {{ $contact->name }} </strong></h3> (Cadastrado às {{ $contact->created_at->format('d/m/Y H:i')}} do IP {{ $contact->ip }})
    <div class="media text-muted pt-3">
      <p class="media-body">
        <strong class="d-block text-gray-dark">{{ $contact->email }}</strong>
        <strong class="d-block text-gray-dark">Tel: {{ $contact->tel }}</strong>
        {{ $contact->message }}
        <br>
        <a href="{{ url('files/'.$contact->file->path.'/'.$contact->file->filename) }}">{{ $contact->file->filename }}</a>
      </p>
    </div>
    
    <small class="d-block text-right mt-3">
        <a href="{{ url('contacts') }}" class="btn btn-light">Voltar</a>
    </small>
</div>
@endsection