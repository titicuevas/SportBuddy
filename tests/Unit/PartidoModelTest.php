<?php

namespace Tests\Unit;

use App\Models\Deporte;
use App\Models\Partido;
use Tests\TestCase;

class PartidoModelTest extends TestCase
{
    public function test_future_scope_filters_by_fecha_hora(): void
    {
        $sql = Partido::query()->future()->toSql();

        $this->assertStringContainsString('"fecha_hora"', $sql);
        $this->assertStringContainsString('>', $sql);
    }

    public function test_padel_uses_distinct_cover_image(): void
    {
        $padel = Deporte::coverImageUrl('Padel');
        $futbol = Deporte::coverImageUrl('Futbol Sala');

        $this->assertStringContainsString('unsplash.com', $padel);
        $this->assertNotSame($futbol, $padel);
    }
}
