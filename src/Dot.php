<?php

declare(strict_types=1);

namespace Codin\Dot;

class Dot
{
    protected array $items;

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * Get key from items
     *
     * @param string|null $key
     * @param mixed $default
     * @return mixed
     */
    public function get(?string $key, $default = null)
    {
        if (null === $key) {
            return $this->items;
        }

        $item =& $this->items;

        foreach (explode('.', $key) as $index) {
            if (!is_array($item) || !array_key_exists($index, $item)) {
                return $default;
            }
            $item =& $item[$index];
        }

        return $item;
    }

    /**
     * Store a key-value in items
     *
     * @param string $key
     * @param mixed $value
     */
    public function set(string $key, $value): void
    {
        $item =& $this->items;

        foreach (explode('.', $key) as $index) {
            if (!is_array($item)) {
                throw new DotException(sprintf('The value at the current index "%s" is not an array', $index));
            }
            if (!array_key_exists($index, $item)) {
                $item[$index] = [];
            }
            $item =& $item[$index];
        }

        $item = $value;
    }
}
