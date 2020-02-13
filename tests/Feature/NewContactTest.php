<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Contact;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class NewContactTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testNewContactSuccessful()
    {
        $response = $this->post('/contacts', $this->data());

        $this->assertCount(1, Contact::all());
    }

    public function testNewContactRequired()
    {
        $response = $this->post('/contacts', $this->emptyData());

        $response->assertSessionHasErrors('name');
        $response->assertSessionHasErrors('email');
        $response->assertSessionHasErrors('tel');
        $response->assertSessionHasErrors('message');
        $response->assertSessionHasErrors('file');
        $this->assertCount(0, Contact::all());
    }

    public function testNewContactNoValidEmail()
    {
        $response = $this->post('/contacts', array_merge($this->data(), ['email' => 'testeemail.com']));

        $response->assertSessionHasErrors('email');
        $this->assertCount(0, Contact::all());
    }

    public function testNewContactNoValidFileType()
    {
        Storage::fake('files');
        $file = UploadedFile::fake()->create('document.xlsx', 500);

        $response = $this->post('/contacts', array_merge($this->data(), ['file' => $file]));

        $response->assertSessionHasErrors('file');
        $this->assertCount(0, Contact::all());
    }

    public function testNewContactNoValidFileSize()
    {
        Storage::fake('files');
        $file = UploadedFile::fake()->create('document.pdf', 501);

        $response = $this->post('/contacts', array_merge($this->data(), ['file' => $file]));

        $response->assertSessionHasErrors('file');
        $this->assertCount(0, Contact::all());
    }

    public function testNewContactNoValidTel()
    {
        $response = $this->post('/contacts', array_merge($this->data(), ['tel' => '(12) 1234-123']));

        $response->assertSessionHasErrors('tel');
        $this->assertCount(0, Contact::all());
    }

    public function testNewContactNoValidTelBig()
    {
        $response = $this->post('/contacts', array_merge($this->data(), ['tel' => '(12) 1234-123444']));

        $response->assertSessionHasErrors('tel');
        $this->assertCount(0, Contact::all());
    }

    private function data() {
        Session::start();
        Storage::fake('files');
        $file = UploadedFile::fake()->create('document.pdf', 500);

        return [
            'name' => 'Test Name',
            'email' => 'teste@email.com',
            'tel' => '(12) 1234-1234',
            'message' => 'lorem ipsum',
            'file' => $file,
            '_token' => csrf_token()
        ];
    }

    private function emptyData() {
        Session::start();

        return [
            'name' => '',
            'email' => '',
            'tel' => '',
            'message' => '',
            'file' => '',
            '_token' => csrf_token()
        ];
    }
}
