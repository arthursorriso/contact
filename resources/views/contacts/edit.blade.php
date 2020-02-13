@extends('layout.app')

@section('content')
<div class="my-3 p-3 bg-white rounded shadow-sm">
    <h3 class="border-bottom border-gray pb-2 mb-0"><strong>Contatos - Editando</strong></h3>

    <form action="{{url('contacts/'.$contact->id) }}" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="PATCH">
    {{ csrf_field() }}
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">Nome</label>
                    <input class="form-control form-control-line" name="name" type="text" id="name" placeholder="Digite o nome" value="{{ $contact->name}}">
                    
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">Email</label>
                    <input class="form-control form-control-line" name="email" type="text" id="email" placeholder="Digite o email" value="{{$contact->email}}">
                    
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="form-group{{ $errors->has('tel') ? ' has-error' : '' }}">
                    <label for="tel">Telefone</label>
                    <input class="form-control form-control-line" name="tel" type="text" id="tel" placeholder="Digite o telefone" value="{{$contact->tel}}">
                    
                    @if ($errors->has('tel'))
                        <span class="help-block">
                            <strong>{{ $errors->first('tel') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                    <label for="message">Mensagem</label>
                    <textarea class="form-control form-control-line" name="message" id="message">{{$contact->message}}</textarea>
                    
                    @if ($errors->has('message'))
                        <span class="help-block">
                            <strong>{{ $errors->first('message') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                    <label for="file">Arquivo</label>
                    <input class="form-control form-control-line" name="file" type="file" id="file">
                    
                    @if ($errors->has('file'))
                        <span class="help-block">
                            <strong>{{ $errors->first('file') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <small class="d-block text-right mt-3">
            <input type="submit" class="btn btn-primary" value="Salvar">
            <a href="{{ url('contacts') }}" class="btn btn-light">Voltar</a>
        </small>
        
    </form>
    
    
</div>
@endsection