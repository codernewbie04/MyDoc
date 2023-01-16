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
final class MyDocTest extends CIUnitTestCase
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

    private function testCase001($email_testing, $password_testing)
    {
        if(is_null($email_testing) || is_null($password_testing)){
            $email_testing = "akmalmf007@gmail.com";
            $password_testing = "12345678";
        }
        
        
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

    private function testCase002()
    {
        $fullname_testing = "Testing Name";
        $email_testing = "testing_email".rand(0,100)."@gmail.com";
        $birthday_testing = "2002-01-01";
        $addres_testing = "Lorem Ipsum";
        $password_testing = "12345678";
        // Validate the response if login with correct email and password
        $response = $this->call('post', '/api/v1/auth/register', [
            'fullname' => $fullname_testing,
            'email' => $email_testing,
            'birthday' => $birthday_testing,
            'address' => $addres_testing,
            'password1' => $password_testing,
            'password2' => $password_testing
        ]);
        //expecting data is not null and status code to be 201 / Created
        $response->assertJSONFragment(['message' => "Berhasil register!"]);
        $response->assertStatus(201);
        return [$email_testing, $password_testing];
    }

    // $this->expectOutputString('foo');

    private function testCase003() {
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

    private function testCase004() {
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
    public function testDUPL_01(){
        $jwt = $this->testCase003();
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
    public function testDUPL_02(){
        $jwt = $this->testCase004();
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
            return json_decode($response->getJSON(), true);
        }
    }

    public function testDUPL_03(){
        $u = $this->testCase002();
        if($u != null){
            $jwt = $this->testCase001($u[0], $u[1]);
            if($jwt != null){
                $response = $this->call('get', '/api/v1/master/dashboard',[
                    'test_token' => 'Bearer '.$jwt
                ]);
                
                $response->assertJSONFragment(['message' => "Berhasil mendapatkan data!"]);
                $response->assertStatus(200);
            }
        }
    }

    public function testDUPL_04(){
        $jwt = $this->testCase001(null, null);
        if($jwt != null){
            $response = $this->call('get', '/api/v1/master/dokter',[
                'test_token' => 'Bearer '.$jwt
            ]);
            
            $response->assertJSONFragment(['message' => "Berhasil mendapatkan data!"]);
            $response->assertStatus(200);
        }
    }

    public function testDUPL_05(){
        $jwt = $this->testCase001(null, null);
        if(!is_null($jwt)){
            $doker = 1;
            $response = $this->call('post', '/api/v1/transaction/checkout', [
                'dokter_id' => $doker,
                'time' => "12:30",
                'payment_method' => "VA",
                'test_token' => 'Bearer '.$jwt
            ]);
            //expecting data is not null and status code to be 201 / Created
            $response->assertJSONFragment(['message' => "Berhasil melakukan checkout"]);
            $response->assertStatus(201);
            return json_decode($response->getJSON(), true)['data'];
        }
    }

    public function testDUPL_06(){
        $jwt = $this->testCase001(null, null);
        if($jwt != null){
            $invoice_id = 31;
            $response = $this->call('get', '/api/v1/transaction/invoice/'.$invoice_id,[
                'test_token' => 'Bearer '.$jwt
            ]);
            
            $response->assertJSONFragment(['message' => "Berhasil Mendapatkan data!"]);
            $response->assertJSONFragment(['data' => ['id' => $invoice_id]]);
            $response->assertStatus(200);
        }
    }

    public function testDUPL_07_negative(){
        $jwt = $this->testCase001(null, null);
        if(!is_null($jwt)){
            $invoice_id = $this->testDUPL_05();
            $response = $this->call('post', '/api/v1/transaction/give_rating', [
                'invoice_id' => $invoice_id,
                'description' => "Lorem Ipsum Dolor Sit Amet",
                'star' => 5,
                'test_token' => 'Bearer '.$jwt
            ]);
            //expecting data is not null and status code to be 403 / Forbidden
            $response->assertStatus(403);
        }
    }

    public function testDUPL_07_positive(){
        $jwt = $this->testCase001(null, null);
        if(!is_null($jwt)){
            $invoice_id = $this->testDUPL_05();
            $data = array(
                'status' => 2
            );
            $this->db->table('invoice')->where('id', $invoice_id)->update($data);

            $response = $this->call('post', '/api/v1/transaction/give_rating', [
                'invoice_id' => $invoice_id,
                'description' => "Lorem Ipsum Dolor Sit Amet",
                'star' => 5,
                'test_token' => 'Bearer '.$jwt
            ]);
            //expecting data is not null and status code to be 201 / Created
            $response->assertStatus(201);
        }
    }
}
