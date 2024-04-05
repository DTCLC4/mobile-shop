<?php

namespace App\Http\Controllers;

use App\Contracts\BirdServiceInterface;
use Symfony\Component\HttpFoundation\Response;

class HomeController
{

  protected $response;
  protected $birdService;
  public function __construct(Response $response, BirdServiceInterface $birdService)
  {
    $this->birdService = $birdService;
    $this->response = $response;
  }

  public function index()
  {
    $message = $this->birdService->fly();

    // Thiết lập nội dung của response
    $this->response->setContent($message);

    // Trả về response
    return $this->response;
  }
}
