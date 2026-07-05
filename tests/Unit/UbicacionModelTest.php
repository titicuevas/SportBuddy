<?php

namespace Tests\Unit;

use App\Models\Ubicacion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UbicacionModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_image_path_uses_unsplash_fallback_when_local_file_missing(): void
    {
        $ubicacion = Ubicacion::create([
            'nombre' => 'Polideportivo',
            'direccion' => 'Av. Test',
            'imagen' => 'Poli.jpg',
            'enlace_maps' => 'https://maps.example.com',
            'iframe' => '<iframe></iframe>',
        ]);

        $this->assertStringStartsWith('https://images.unsplash.com/', $ubicacion->image_path);
    }

    public function test_image_path_keeps_external_url(): void
    {
        $url = 'https://cdn.example.com/pista.jpg';

        $ubicacion = Ubicacion::create([
            'nombre' => 'Otro sitio',
            'direccion' => 'Calle 1',
            'imagen' => $url,
            'enlace_maps' => 'https://maps.example.com',
            'iframe' => '<iframe></iframe>',
        ]);

        $this->assertSame($url, $ubicacion->image_path);
    }
}
