<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 03/04/2015
 * Time: 13:47
 */

namespace MattCannon\Collections;


use MattCannon\Collections\Exceptions\InvalidTypeException;

/**
 * Class TypedCollection
 * @package MattCannon\Collections
 */
class TypedCollection extends AbstractCollection
{
    /**
     * @var null
     */
    private $type;

    /**
     * @param array $items
     * @param null $type
     */
    public function __construct($items = array(), $type = null)
    {
        parent::__construct($items);
        $this->type = $type;
    }

    /**
     * @param null $items
     * @return TypedCollection
     * @throws InvalidTypeException
     */
    public static function make($items = null)
    {
        return self::makeWithType($items, null);
    }

    /**
     * @param null $items
     * @param null $type
     * @return static
     * @throws InvalidTypeException
     */
    public static function makeWithType($items = null, $type = null)
    {
        if (!is_null($type)) {
            foreach ($items as $key => $item) {
                if (!self::checkItemType($item, $type)) {
                    throw new InvalidTypeException("Item at position [$key] is not an instance of type [$type].");
                }
            }
        }
        return new static($items, $type);
    }

    /**
     * @param $item
     * @param $type
     * @return bool
     */
    public static function checkItemType($item, $type)
    {
        if (in_array($type, ["boolean", "integer", "double", "float", "string", "array", "object", "resource"])) {
            return self::isBaseType($item, $type);
        } else {
            $reflectionClass = new \ReflectionClass($type);
            if ($reflectionClass->isInterface()) {
                $inspectedClass = new \ReflectionClass(get_class($item));
                return $inspectedClass->implementsInterface($type);
            } else {
                return is_a($item, $type);
            }
        }
    }

    /**
     * @param $item
     * @param $type
     * @return bool
     */
    private static function isBaseType($item, $type)
    {
        $finalType = ($type == 'float') ? 'double' : $type;
        $itemType = gettype($item);
        return ($itemType == $finalType);
    }

    /**
     * @param mixed $value
     * @throws InvalidTypeException
     */
    public function push($value)
    {

        if (!is_null($this->type) && !$this->checkItemType($value, $this->type)) {
            throw new InvalidTypeException("This item doesn't match the collection's type [$this->type]");
        }
        parent::push($value);
    }

    /**
     * @param mixed $key
     * @param mixed $value
     * @throws InvalidTypeException
     */
    public function put($key, $value)
    {
        if (!$this->checkItemType($value, $this->type)) {
            throw new InvalidTypeException("This item doesn't match the collection's type [$type]");
        }
        parent::put($key, $value);
    }

    /**
     * @param mixed $value
     * @throws InvalidTypeException
     */
    public function prepend($value)
    {
        if (!$this->checkItemType($value, $this->type)) {
            throw new InvalidTypeException("This item doesn't match the collection's type [$type]");
        }
        parent::prepend($value);
    }

    /**
     * @return static
     */
    public function collapse()
    {
        $ret = parent::collapse();
        return new static($ret->items, $this->type);
    }

    /**
     * Fetch a nested element of the collection.
     *
     * @param  string $key
     * @return static
     */
    public function fetch($key)
    {
        return new static(array_fetch($this->items, $key), $this->type);
    }

    /**
     * Run a filter over each of the items.
     *
     * @param  callable $callback
     * @return static
     */
    public function filter(callable $callback)
    {
        return new static(array_filter($this->items, $callback), $this->type);
    }

    /**
     * Flip the items in the collection.
     *
     * @return static
     */
    public function flip()
    {
        return new static(array_flip($this->items), $this->type);
    }

    /**
     * @param callable|string $groupBy
     * @return static
     */
    public function groupBy($groupBy)
    {
        $ret = parent::groupBy($groupBy);
        return new static($ret->items, $this->type);
    }

    /**
     * @param callable|string $keyBy
     * @return static
     */
    public function keyBy($keyBy)
    {
        $ret = parent::keyBy($keyBy);
        return new static($ret->items, $this->type);
    }

    /**
     * Intersect the collection with the given items.
     *
     * @param  \Illuminate\Support\Collection|\Illuminate\Contracts\Support\Arrayable|array $items
     * @return static
     */
    public function intersect($items)
    {
        return new static(array_intersect($this->items, $this->getArrayableItems($items)), $this->type);
    }

    /**
     * Merge the collection with the given items.
     *
     * @param  \Illuminate\Support\Collection|\Illuminate\Contracts\Support\Arrayable|array $items
     * @return static
     */
    public function merge($items)
    {
        return new static(array_merge($this->items, $this->getArrayableItems($items)), $this->type);
    }

    /**
     * "Paginate" the collection by slicing it into a smaller collection.
     *
     * @param  int $page
     * @param  int $perPage
     * @return static
     */
    public function forPage($page, $perPage)
    {
        return new static(array_slice($this->items, ($page - 1) * $perPage, $perPage), $this->type);
    }

    /**
     * Reverse items order.
     *
     * @return static
     */
    public function reverse()
    {
        return new static(array_reverse($this->items), $this->type);
    }

    /**
     * Slice the underlying collection array.
     *
     * @param  int $offset
     * @param  int $length
     * @param  bool $preserveKeys
     * @return static
     */
    public function slice($offset, $length = null, $preserveKeys = false)
    {
        $returnVal = parent::slice($offset, $length, $preserveKeys);
        return new static($returnVal->items, $this->type);
    }

    /**
     * Chunk the underlying collection array.
     *
     * @param  int $size
     * @param  bool $preserveKeys
     * @return static
     */
    public function chunk($size, $preserveKeys = false)
    {
        $chunks = [];

        foreach (array_chunk($this->items, $size, $preserveKeys) as $chunk)
        {
            $chunks[] = new static($chunk,$this->type);
        }

        return new static($chunks);
    }

    public function splice($offset, $length = 0, $replacement = [])
    {
        $returnVal = parent::splice($offset, $length, $replacement); 
        return new static($returnVal->items,$this->type);
    }
    /**
     * Return only unique items from the collection array.
     *
     * @return static
     */
    public function unique()
    {
        return new static(array_unique($this->items),$this->type);
    }

    /**
     * Reset the keys on the underlying array.
     *
     * @return static
     */
    public function values()
    {
        return new static(array_values($this->items),$this->type );
    }

}