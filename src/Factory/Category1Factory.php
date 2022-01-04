<?php

namespace App\Factory;

use App\Entity\Category1;
use App\Repository\Category1Repository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Category1>
 *
 * @method static Category1|Proxy createOne(array $attributes = [])
 * @method static Category1[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Category1|Proxy find(object|array|mixed $criteria)
 * @method static Category1|Proxy findOrCreate(array $attributes)
 * @method static Category1|Proxy first(string $sortedField = 'id')
 * @method static Category1|Proxy last(string $sortedField = 'id')
 * @method static Category1|Proxy random(array $attributes = [])
 * @method static Category1|Proxy randomOrCreate(array $attributes = [])
 * @method static Category1[]|Proxy[] all()
 * @method static Category1[]|Proxy[] findBy(array $attributes)
 * @method static Category1[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Category1[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Category1Repository|RepositoryProxy repository()
 * @method Category1|Proxy create(array|callable $attributes = [])
 */
final class Category1Factory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

    }

    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->word(),
        ];
    }

    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Category1 $category1): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Category1::class;
    }
}
