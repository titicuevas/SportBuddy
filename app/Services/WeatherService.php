<?php

namespace App\Services;

use App\Models\Ubicacion;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class WeatherService
{
    public function isConfigured(): bool
    {
        return filled(config('services.openweather.api_key'));
    }

    public function getForUbicacion(Ubicacion $ubicacion, ?Carbon $fechaHora = null): array
    {
        if (! $this->isConfigured()) {
            return [
                'configured' => false,
                'error' => 'Servicio meteorológico no configurado.',
            ];
        }

        $fechaHora ??= now();
        $cacheKey = sprintf('weather.%d.%s', $ubicacion->id, $fechaHora->format('Y-m-d-H'));

        return Cache::remember($cacheKey, 1800, fn () => $this->fetchWeather($ubicacion, $fechaHora));
    }

    protected function fetchWeather(Ubicacion $ubicacion, Carbon $fechaHora): array
    {
        $query = $this->resolveQuery($ubicacion);

        if ($fechaHora->isToday()) {
            return $this->fetchCurrent($query);
        }

        if ($fechaHora->isAfter(now()->addDays(5)->endOfDay())) {
            return [
                'configured' => true,
                'available' => false,
                'message' => 'Pronóstico disponible solo para los próximos 5 días.',
            ];
        }

        return $this->fetchForecast($query, $fechaHora);
    }

    protected function resolveQuery(Ubicacion $ubicacion): string
    {
        if (str_contains($ubicacion->direccion, 'Sanlúcar') || str_contains($ubicacion->direccion, 'Sanlucar')) {
            return 'Sanlucar de Barrameda,ES';
        }

        return $ubicacion->nombre.',ES';
    }

    protected function fetchCurrent(string $query): array
    {
        $response = Http::timeout(5)->get('https://api.openweathermap.org/data/2.5/weather', [
            'q' => $query,
            'units' => 'metric',
            'lang' => 'es',
            'appid' => config('services.openweather.api_key'),
        ]);

        if ($response->failed()) {
            return ['configured' => true, 'available' => false, 'error' => 'No se pudo obtener el tiempo.'];
        }

        return $this->formatWeather($response->json());
    }

    protected function fetchForecast(string $query, Carbon $fechaHora): array
    {
        $response = Http::timeout(5)->get('https://api.openweathermap.org/data/2.5/forecast', [
            'q' => $query,
            'units' => 'metric',
            'lang' => 'es',
            'appid' => config('services.openweather.api_key'),
        ]);

        if ($response->failed()) {
            return ['configured' => true, 'available' => false, 'error' => 'No se pudo obtener el pronóstico.'];
        }

        $target = $fechaHora->copy()->setTime(
            $fechaHora->hour ?: 12,
            $fechaHora->minute
        );

        $closest = collect($response->json('list', []))
            ->sortBy(fn (array $item) => abs(Carbon::parse($item['dt_txt'])->diffInMinutes($target)))
            ->first();

        if (! $closest) {
            return ['configured' => true, 'available' => false, 'error' => 'Sin datos para esa fecha.'];
        }

        $formatted = $this->formatWeather([
            'main' => $closest['main'],
            'weather' => $closest['weather'],
            'wind' => $closest['wind'] ?? [],
        ]);

        $formatted['forecast_date'] = $fechaHora->format('d/m/Y');

        return $formatted;
    }

    protected function formatWeather(array $data): array
    {
        return [
            'configured' => true,
            'available' => true,
            'temp' => (int) round($data['main']['temp'] ?? 0),
            'feels_like' => (int) round($data['main']['feels_like'] ?? 0),
            'description' => ucfirst($data['weather'][0]['description'] ?? ''),
            'icon' => $data['weather'][0]['icon'] ?? '01d',
            'humidity' => $data['main']['humidity'] ?? null,
            'wind' => round($data['wind']['speed'] ?? 0, 1),
        ];
    }

    public static function iconEmoji(string $icon): string
    {
        return match (substr($icon, 0, 2)) {
            '01' => '☀️',
            '02' => '⛅',
            '03', '04' => '☁️',
            '09', '10' => '🌧️',
            '11' => '⛈️',
            '13' => '❄️',
            '50' => '🌫️',
            default => '🌡️',
        };
    }
}
