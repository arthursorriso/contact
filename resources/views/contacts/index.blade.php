@extends('layout.app')

@section('content')
<div class="my-3 p-3 bg-white rounded shadow-sm">
<h3 class="border-bottom border-gray pb-2 mb-0"><strong>Contatos</strong></h3>
    @if(!$contacts->count())
        <div class="media text-muted pt-3">
            <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                Sem contatos salvos. Adicione-os agora.
            </p>
        </div>
    @else
    <table class="table table-hover">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">E-mail</th>
            <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
        @foreach($contacts as $key => $contact)
        
            <tr>
                <th scope="row">{{ $key }}</th>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                <td>
                    <a href="{{ url('contacts/'.$contact->id) }}">Ver</a> | 
                    <a href="{{ url('contacts/'.$contact->id.'/edit/') }}">Editar</a>
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>
    @endif
    <small class="d-block text-right mt-3">
    <a href="{{ url('contacts/create') }}" class="btn btn-primary">Adicionar</a>
    </small>
</div>
@endsection