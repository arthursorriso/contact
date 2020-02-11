<div>
    Nome: {{ $contact->name }} <br>
    Email: {{ $contact->email }} <br>
    Tel: {{ $contact->tel }} <br>
    IP: {{ $contact->ip }} <br>
    Data de criação: {{ $contact->created_at->format('d/m/Y H:i:s') }} <br>
    Mensagem: {{ $contact->message }} <br>
    Arquivo: <a href="{{ url('files/'.$contact->file->path.'/'.$contact->file->filename) }}">{{ $contact->file->filename }}</a>
</div>