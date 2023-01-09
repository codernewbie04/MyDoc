<?php

use CodeIgniter\Test\CIUnitTestCase;
use Config\App;
use Config\Services;
use Tests\Support\Libraries\ConfigReader;
use CodeIgniter\Test\FeatureTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;

/**
 * @internal
 */
final class HealthTest extends CIUnitTestCase
{
    use FeatureTestTrait;
    use DatabaseTestTrait;

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $validation = \Config\Services::validation();
        $validation->reset();
    }

    private function testSuccessLoginAsPasien()
    {
        $email_testing = "akmalmf007@gmail.com";
        $password_testing = "12345678";
        // Validate the response if login with correct email and password
        $response = $this->call('post', '/api/v1/auth/login', [
            'email' => $email_testing,
            'password' => $password_testing,
            'fcm_token' => "AnyToken"
        ]);
        //expecting data is not null and status code to be 200 / Ok
        $response->assertJSONFragment(['data' => ['user' => ['email' => $email_testing]]]);
        $response->assertStatus(200);
        $json = json_decode($response->getJSON(), true);

        return $json['data']['token'];
    }

    // $this->expectOutputString('foo');

    private function testSuccessLoginAsAdmin() {
        $username_testing = "admin_123";
        $password_testing = "12345678";

        $response = $this->call('post', '/auth/login', [
            'login' => $username_testing,
            'password' => $password_testing
        ]);
        //getenv("JWT_WEB_NAME")
        $jwt = session(getenv("JWT_WEB_NAME"));
        $this->assertTrue($jwt != null);
        return $jwt;
    }

    private function testSuccessLoginAsInstansi() {
        $username_testing = "instansi_kesehatan";
        $password_testing = "12345678";

        $response = $this->call('post', '/auth/login', [
            'login' => $username_testing,
            'password' => $password_testing
        ]);
        //getenv("JWT_WEB_NAME")
        $jwt = session(getenv("JWT_WEB_NAME"));
        $this->assertTrue($jwt != null);
        return $jwt;
    }

    // Route Add Instansi Kesehatan: /admin/instansi/add
    private function testDUPL_01(){
        $jwt = $this->testSuccessLoginAsAdmin();
        if($jwt != null){
            $response = $this->withSession([
                getenv("JWT_WEB_NAME") => $jwt
            ])->call('post', '/admin/instansi/add', [
                'nama' => 'Nama Instansi',
                'username' => 'username_instansi'.rand(0,100),
                'email' => 'testing_instansi'.rand(0,100).'@gmail.com',
                'birthday' => '2002-01-01',
                'address' => 'Jl Instansi',
                'password' => '12345678',
                'password2' => '12345678'
            ]);
            $isSuccess = session("success");
            $this->assertTrue($isSuccess != null);
        }
    }

    // Route Add Dokter: /admin/dokter/add
    private function testDUPL_02(){
        $jwt = $this->testSuccessLoginAsInstansi();
        if($jwt != null){
            $response = $this->withSession([
                getenv("JWT_WEB_NAME") => $jwt
            ])->call('post', '/admin/dokter/add', [
                'nama' => 'Name Testing',
                'profession' => 'Testing Profession',
                'price' => rand(100000,500000)
            ]);
            $isSuccess = session("success");
            $this->assertTrue($isSuccess != null); 
        }
    }

    public function testDUPL_03(){
        $jwt = $this->testSuccessLoginAsPasien();
        if($jwt != null){
            // $response = $this->call('get', '/api/v1/master/dokter',[
            //     'Authorization' => 'Bearer '.$jwt
            // ]);

            $response = $this->withHeaders(['Authorization' => 'Bearer asdojqgeopjq'])->get('/api/v1/master/dokter');
            
            $response->assertJSONFragment(['message' => "Berhasil mendapatkan data!"]);
            $response->assertStatus(200);
        }
    }
}
