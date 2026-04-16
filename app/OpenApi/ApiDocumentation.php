<?php

namespace App\OpenApi;
use OpenApi\Attributes as OA;

#[OA\Info(
    version:"1.0.0",
    title:"Products API",
    description:"API documentation for Laravel application using Swagger",
  )]
#[OA\Server(
    url: "http://localhost:8000",
    description:"Local server"
 )]
class ApiDocumentation
{
    // This class can be used to generate OpenAPI documentation settings
    // such as API info, servers, security schemes, etc.
}
