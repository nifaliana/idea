<?php

namespace App\Factory;

use App\Entity\Confection;
use App\Repository\ConfectionRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Confection|Proxy findOrCreate(array $attributes)
 * @method static Confection|Proxy random()
 * @method static Confection[]|Proxy[] randomSet(int $number)
 * @method static Confection[]|Proxy[] randomRange(int $min, int $max)
 * @method static ConfectionRepository|RepositoryProxy repository()
 * @method Confection|Proxy create($attributes = [])
 * @method Confection[]|Proxy[] createMany(int $number, $attributes = [])
 */
final class ConfectionFactory extends ModelFactory
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
            // ->afterInstantiate(function(Confection $confection) {})
        ;
    }

    protected static function getClass(): string
    {
        return Confection::class;
    }
}
