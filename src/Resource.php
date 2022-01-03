<?php

/**
 * This file is part of the fleetbase/fleetbase-php library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Fleetbase Pte Ltd. <ron@fleetbase.io>
 * @license   http://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Fleetbase\Sdk;

/**
 * Fleetbase PHP SDK Base Resource
 */
class Resource
{
    private array $attributes = [];
    private string $version = 'v1';
    private array $options = [];
    private array $dirtyAttributes = [];
    private array $changes = [];
    private bool $isSaving = false;
    private bool $isLoading = false;
    private bool $isDestroying = false;
    private bool $isReloading = false;
    private ?Service $service;

    public function __construct(array $attributes = [], ?Service $service = null, ?array $options = [])
    {
        $this->attributes = $attributes;
        $this->service = $service;
        $this->options = $options;
        $this->version = $options['version'] ?? 'v1';
    }

    public function __get(string $name)
    {
        if ($name === 'id') {
            return $this->getAttribute('id');
        }
    }

    public function create($attributes = [])
    {
    }

    public function update($attributes = [])
    {
    }

    public function save(?array $options = [])
    {
        $attributes = $this->getAttributes();

        if (!$this->id) {
            return $this->create($attributes);
        }

        return $this->update($attributes);
    }

    public function getAttribute(string $attribute, $defaultValue = null)
    {
        return Utils::get($this->attributes, $attribute, $defaultValue);
    }

    public function hasAttribute($property)
    {
        if (is_array($property)) {
            return Arr::every(
                $property,
                function ($prop) {
                    return $this->hasAttribute($prop);
                }
            );
        }

        return in_array($property, array_keys($this->attributes ?? []));
    }

    public function isAttributeFilled($property)
    {
        if (is_array($property)) {
            return $this->hasAttribute($property) && Arr::every(
                $property,
                function ($prop) {
                    return !empty($this->getAttribute($prop));
                }
            );
        }

        return $this->hasAttribute($property) && !empty($this->getAttribute($property));
    }

    public function getAttributes(array $properties = [])
    {
        $attributes = [];

        if (empty($properties)) {
            return $this->getAttributes(array_keys($this->attributes));
        }

        if (is_string($properties)) {
            return $this->getAttributes([$properties]);
        }

        if (!is_array($properties)) {
            throw new Exception('No attribute properties provided!');
        }

        for ($i = 0; $i < count($properties); $i++) {
            $property = $properties[$i];

            if (!is_string($property)) {
                continue;
            }

            $value = $this->getAttribute($property);

            if (is_object($value) && isset($value->attributes)) {
                $value = $value->attributes;
            }

            $attributes[$property] = $value;
        }

        return $attributes;
    }

    private function mergeAttributes(array $attributes = [])
    {
        $this->attributes = array_merge($this->attributes, $attributes);
    }

    private function getDirtyAttributes(): array
    {
        return $this->dirtyAttributes;
    }

    public function isDirty($attribute)
    {
        return in_array($attribute, array_keys($this->dirtyAttributes));
    }

    private function setFlags(array $flags = [])
    {
    }
}
