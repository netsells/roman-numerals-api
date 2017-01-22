<?php
namespace Tests\Exceptions;

use App\Responder\ErrorResponseBuilder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ResourceNotFoundTest extends TestCase
{
    public function test404Behavior()
    {
        $this->call('GET', '/invalid/path/here', ['lang' => 'nl']);

        $this->assertResponseStatus(404);
        // Arrange...
        $this->mockTranslator('De gevraagde bron bestaat niet');
        $responseBuilder = app(ErrorResponseBuilder::class);
        // Act...
        $responseBuilder->setError('resource_not_found');
        // Assert...
        $this->assertEquals([
            'success' => false,
            'error'   => [
                'code'    => 'resource_not_found',
                'message' => 'De gevraagde bron bestaat niet'
            ]
        ], $responseBuilder->toArray());

    }
}
