<?php

namespace Users\DataFixtures;

use Users\Entity\Attribute;
use Users\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Users\Entity\UserHasAttribute;

class AppFixtures extends Fixture
{
    private const LIMIT = 100;

    public function load(ObjectManager $manager)
    {
        $attrs = $this->generateAttributes();
        $colors = $this->generateColors();

        $users = [];

        for ($i = 1; $i <= self::LIMIT; $i++) {
            $user = new User;
            $user->name = 'Jhon Doe '.$i;

            $this->getRandomAttrs($user, $attrs, $colors);

            $manager->persist($user);
        }

        $manager->flush();
    }

    private function generateAttributes(): array
    {
        return [
            new Attribute('Color de ojos'),
            new Attribute('Color de casa'),
            new Attribute('Color de coche'),
            new Attribute('Color de camisa'),
            new Attribute('Color del pantalón'),
            new Attribute('Color de piel'),
            new Attribute('Color de cabello'),
        ];
    }

    private function generateColors(): array
    {
        return [
            'Azul',
            'Azul oscuro',
            'Azul rey',
            'Verde',
            'Verde claro',
            'Rojo',
            'Rojo claro',
            'Rojo oscuro'
        ];
    }

    private function getRandomAttrs(User $user, $attrs, $colors)
    {
        $randomAttrs = [];
        $randomKeys  = array_rand($attrs, mt_rand(1, count($attrs) - 1));

        if (is_array($randomKeys)) {
            $randomAttrs = array_map(function($key) use ($attrs) {
                return $attrs[$key];
            }, $randomKeys);
        } else if (is_numeric($randomKeys)) {
            array_push($randomAttrs, $attrs[$randomKeys]);
        }

        return $this->setRandomValues($randomAttrs, $user, $colors);
    }

    private function setRandomValues($randomAttrs, User $user, $colors): array
    {
        return array_map(function($attr) use ($user, $colors) {
            $randomColor = array_rand($colors, 1);

            $uha = new UserHasAttribute();
            $uha->user = $user;
            $uha->attribute = $attr;
            $uha->value = $colors[$randomColor];

            return $user->addAttribute($uha);
        }, $randomAttrs);
    }
}
