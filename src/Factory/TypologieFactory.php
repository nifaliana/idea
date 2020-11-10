<?php

namespace App\Factory;

use App\Entity\Typologie;
use App\Repository\TypologieRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Typologie|Proxy findOrCreate(array $attributes)
 * @method static Typologie|Proxy random()
 * @method static Typologie[]|Proxy[] randomSet(int $number)
 * @method static Typologie[]|Proxy[] randomRange(int $min, int $max)
 * @method static TypologieRepository|RepositoryProxy repository()
 * @method Typologie|Proxy create($attributes = [])
 * @method Typologie[]|Proxy[] createMany(int $number, $attributes = [])
 */
final class TypologieFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://github.com/zenstruck/foundry#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://github.com/zenstruck/foundry#model-factories)
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(Typologie $typologie) {})
        ;
    }

    protected static function getClass(): string
    {
        return Typologie::class;
    }
}
