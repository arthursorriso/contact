<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Contact;
use App\FileEntry;
use App\Mail\NewContact;
use Illuminate\Support\Facades\Mail;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::all();

        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'tel' => 'required|min:14|max:15',
            'message' => 'required',
            'file' => 'required|mimes:pdf,doc,docx,odt,txt|max:500',
        ]);
        
        if($request->file) {
            $file = new FileEntry();
            $input['file_id'] = $file->postFile($request->file, 'files');
        }

        $input['ip'] = $request->ip();

        $contact = Contact::create($input);
        
        Mail::to(config('mail.mail_to_new_contact'))->send(new NewContact($contact));

        return redirect('contacts')->with('status', 'Contato cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::find($id);

        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::find($id);
        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contact = Contact::find($id);

        $input = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'tel' => 'required',
            'message' => 'required',
            'file' => 'mimes:pdf,doc,docx,odt,txt|max:500',
        ]);

        if($request->file) {
            $file = new FileEntry();
            $input['file_id'] = $file->postFile($request->file, 'files');
        }

        //$input['ip'] = $request->ip();

        $contact->update($input);

        return redirect('contacts')->with('status', 'Contato atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
    }
}
