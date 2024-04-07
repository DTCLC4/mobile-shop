<?php

namespace Tests\Application\Http\Controllers;

use App\Http\Controllers\HomeController;
use PHPUnit\Framework\TestCase;

class HomeControllerTest extends TestCase
{
    public function testIndex()
    {
        $controller = new HomeController();

        // Gọi phương thức index
        $result = $controller->index(null, null);

        // Kiểm tra xem kết quả có phải là chuỗi "hello world" hay không
        $this->assertEquals('hello world', $result);

    }
}
