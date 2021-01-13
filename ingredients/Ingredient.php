<?php

class Ingredient
{
    private $name;
    private $capacity;
    private $durability;
    private $flavour;
    private $texture;
    private $calories;
    private $teaspoons;
    
    public function __construct(
        string $name,
        int $capacity,
        int $durability,
        int $flavour,
        int $texture,
        int $calories,
        int $teaspoons = 0
    ) {
        $this->name = $name;
        $this->capacity = $capacity;
        $this->durability = $durability;
        $this->flavour = $flavour;
        $this->texture = $texture;
        $this->calories = $calories;
        $this->teaspoons = $teaspoons;
    }

    public function getName() {
        return $this->name;
    }

    public function setName(string $name) {
        $this->name = $name;
    }

    public function getCapacity() {
        return $this->capacity;
    }

    public function setCapacity(int $capacity) {
        $this->capacity = $capacity;
    }

    public function getDurability() {
        return $this->durability;
    }

    public function setDurability(int $durability) {
        $this->durability = $durability;
    }

    public function getFlavour() {
        return $this->flavour;
    }

    public function setFlavour(int $flavour) {
        $this->flavour = $flavour;
    }

    public function getTexture() {
        return $this->texture;
    }

    public function setTexture(int $texture) {
        $this->texture = $texture;
    }

    public function getCalories() {
        return $this->calories;
    }

    public function setCalories(int $calories) {
        $this->calories = $calories;
    }

    public function getTeaspoons() {
        return $this->teaspoons;
    }

    public function setTeaspoons(int $teaspoons) {
        $this->teaspoons = $teaspoons;
    }
}