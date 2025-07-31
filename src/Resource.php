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

use Exception;

/**
 * Fleetbase PHP SDK Base Resource
 */
class Resource
{
    private array $dirtyAttributes = [];

    public function __construct(private array $attributes = [], private readonly ?Service $service = null, private readonly array $options = [])
    {
    }

    public function __get(string $name)
    {
        if ($name === 'id') {
            return $this->getAttribute('id');
        }

        if ($name === 'isDestroyed') {
            return isset($this->attributes['deleted']) && $this->attributes['deleted'] === true;
        }
        return null;
    }

    public function create($attributes = [], $options = [])
    {
        $options = array_merge($options, [
            'onAfter' => function ($response): void {
                $this->mergeAttributes((array) $response);
            }
        ]);
        
        return $this->service->create($attributes, $options = []);
    }

    public function update($attributes = [], $options = [])
    {
        $options = array_merge($options, [
            'onAfter' => function ($response): void {
                $this->mergeAttributes((array) $response);
            }
        ]);

        return $this->service->update($this->id, $attributes, $options);
    }

    public function destroy($options = [])
    {
        $options = array_merge($options, [
            'onAfter' => function ($response): void {
                $this->resetAttributes((array) $response);
            }
        ]);

        return $this->service->destroy($this->id, $options);
    }

    public function save(?array $options = [])
    {
        $attributes = $this->getAttributes();

        if (!$this->id) {
            return $this->create($attributes);
        }

        return $this->update($attributes);
    }

    public function getAttribute($attribute, $defaultValue = null)
    {
        if (is_array($attribute)) {
            return $this->getAttributes($attribute);
        }

        return Utils::get($this->attributes, $attribute, $defaultValue);
    }

    public function hasAttribute($property)
    {
        if (is_array($property)) {
            return Arr::every(
                $property,
                fn($prop) => $this->hasAttribute($prop)
            );
        }

        return in_array($property, array_keys($this->attributes ?? []));
    }

    public function isAttributeFilled($property): bool
    {
        if (is_array($property)) {
            return $this->hasAttribute($property) && Arr::every(
                $property,
                fn($prop): bool => !empty($this->getAttribute($prop))
            );
        }

        return $this->hasAttribute($property) && !empty($this->getAttribute($property));
    }

    public function getAttributes(?array $properties = [])
    {
        $attributes = [];

        if ($properties === null || $properties === []) {
            return $this->attributes;
        }

        if (is_string($properties)) {
            return $this->getAttributes([$properties]);
        }

        if (!is_array($properties)) {
            throw new Exception('No attribute properties provided!');
        }
        $counter = count($properties);

        for ($i = 0; $i < $counter; $i++) {
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

    private function mergeAttributes(array $attributes = []): void
    {
        $this->attributes = array_merge($this->attributes, $attributes);
    }

    private function resetAttributes(array $attributes): void
    {
        $this->attributes = $attributes;
    }

    public function isDirty($attribute): bool
    {
        return in_array($attribute, array_keys($this->dirtyAttributes));
    }
}
