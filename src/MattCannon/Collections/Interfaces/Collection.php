<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 03/04/2015
 * Time: 13:35
 */

namespace MattCannon\Collections\Interfaces;

use ArrayAccess;
use CachingIterator;
use Countable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use IteratorAggregate;
use JsonSerializable;

interface Collection extends ArrayAccess, Arrayable, Countable, IteratorAggregate, Jsonable, JsonSerializable
{

    /**
     * Create a new collection instance if the value isn't one already.
     *
     * @param  mixed $items
     * @return static
     */
    public static function make($items = null);

    /**
     * Get all of the items in the collection.
     *
     * @return array
     */
    public function all();

    /**
     * Collapse the collection items into a single array.
     *
     * @return static
     */
    public function collapse();

    /**
     * Determine if an item exists in the collection.
     *
     * @param  mixed $key
     * @param  mixed $value
     * @return bool
     */
    public function contains($key, $value = null);

    /**
     * Diff the collection with the given items.
     *
     * @param  \Illuminate\Support\Collection|\Illuminate\Contracts\Support\Arrayable|array $items
     * @return static
     */
    public function diff($items);

    /**
     * Execute a callback over each item.
     *
     * @param  callable $callback
     * @return $this
     */
    public function each(callable $callback);

    /**
     * Fetch a nested element of the collection.
     *
     * @param  string $key
     * @return static
     */
    public function fetch($key);

    /**
     * Run a filter over each of the items.
     *
     * @param  callable $callback
     * @return static
     */
    public function filter(callable $callback);

    /**
     * Filter items by the given key value pair.
     *
     * @param  string $key
     * @param  mixed $value
     * @param  bool $strict
     * @return static
     */
    public function where($key, $value, $strict = true);

    /**
     * Filter items by the given key value pair using loose comparison.
     *
     * @param  string $key
     * @param  mixed $value
     * @return static
     */
    public function whereLoose($key, $value);

    /**
     * Get the first item from the collection.
     *
     * @param  callable $callback
     * @param  mixed $default
     * @return mixed|null
     */
    public function first(callable $callback = null, $default = null);

    /**
     * Get a flattened array of the items in the collection.
     *
     * @return static
     */
    public function flatten();

    /**
     * Flip the items in the collection.
     *
     * @return static
     */
    public function flip();

    /**
     * Remove an item from the collection by key.
     *
     * @param  mixed $key
     * @return void
     */
    public function forget($key);

    /**
     * Get an item from the collection by key.
     *
     * @param  mixed $key
     * @param  mixed $default
     * @return mixed
     */
    public function get($key, $default = null);

    /**
     * Group an associative array by a field or using a callback.
     *
     * @param  callable|string $groupBy
     * @return static
     */
    public function groupBy($groupBy);

    /**
     * Key an associative array by a field or using a callback.
     *
     * @param  callable|string $keyBy
     * @return static
     */
    public function keyBy($keyBy);

    /**
     * Determine if an item exists in the collection by key.
     *
     * @param  mixed $key
     * @return bool
     */
    public function has($key);

    /**
     * Concatenate values of a given key as a string.
     *
     * @param  string $value
     * @param  string $glue
     * @return string
     */
    public function implode($value, $glue = null);

    /**
     * Intersect the collection with the given items.
     *
     * @param  \Illuminate\Support\Collection|\Illuminate\Contracts\Support\Arrayable|array $items
     * @return static
     */
    public function intersect($items);

    /**
     * Determine if the collection is empty or not.
     *
     * @return bool
     */
    public function isEmpty();

    /**
     * Get the keys of the collection items.
     *
     * @return static
     */
    public function keys();

    /**
     * Get the last item from the collection.
     *
     * @return mixed|null
     */
    public function last();

    /**
     * Get an array with the values of a given key.
     *
     * @param  string $value
     * @param  string $key
     * @return array
     */
    public function lists($value, $key = null);

    /**
     * Run a map over each of the items.
     *
     * @param  callable $callback
     * @return static
     */
    public function map(callable $callback);

    /**
     * Merge the collection with the given items.
     *
     * @param  \Illuminate\Support\Collection|\Illuminate\Contracts\Support\Arrayable|array $items
     * @return static
     */
    public function merge($items);

    /**
     * "Paginate" the collection by slicing it into a smaller collection.
     *
     * @param  int $page
     * @param  int $perPage
     * @return static
     */
    public function forPage($page, $perPage);

    /**
     * Get and remove the last item from the collection.
     *
     * @return mixed|null
     */
    public function pop();

    /**
     * Push an item onto the beginning of the collection.
     *
     * @param  mixed $value
     * @return void
     */
    public function prepend($value);

    /**
     * Push an item onto the end of the collection.
     *
     * @param  mixed $value
     * @return void
     */
    public function push($value);

    /**
     * Pulls an item from the collection.
     *
     * @param  mixed $key
     * @param  mixed $default
     * @return mixed
     */
    public function pull($key, $default = null);

    /**
     * Put an item in the collection by key.
     *
     * @param  mixed $key
     * @param  mixed $value
     * @return void
     */
    public function put($key, $value);

    /**
     * Get one or more items randomly from the collection.
     *
     * @param  int $amount
     * @return mixed
     */
    public function random($amount = 1);

    /**
     * Reduce the collection to a single value.
     *
     * @param  callable $callback
     * @param  mixed $initial
     * @return mixed
     */
    public function reduce(callable $callback, $initial = null);

    /**
     * Create a collection of all elements that do not pass a given truth test.
     *
     * @param  callable|mixed $callback
     * @return static
     */
    public function reject($callback);

    /**
     * Reverse items order.
     *
     * @return static
     */
    public function reverse();

    /**
     * Search the collection for a given value and return the corresponding key if successful.
     *
     * @param  mixed $value
     * @param  bool $strict
     * @return mixed
     */
    public function search($value, $strict = false);

    /**
     * Get and remove the first item from the collection.
     *
     * @return mixed|null
     */
    public function shift();

    /**
     * Shuffle the items in the collection.
     *
     * @return $this
     */
    public function shuffle();

    /**
     * Slice the underlying collection array.
     *
     * @param  int $offset
     * @param  int $length
     * @param  bool $preserveKeys
     * @return static
     */
    public function slice($offset, $length = null, $preserveKeys = false);

    /**
     * Chunk the underlying collection array.
     *
     * @param  int $size
     * @param  bool $preserveKeys
     * @return static
     */
    public function chunk($size, $preserveKeys = false);

    /**
     * Sort through each item with a callback.
     *
     * @param  callable $callback
     * @return $this
     */
    public function sort(callable $callback);

    /**
     * Sort the collection using the given callback.
     *
     * @param  callable|string $callback
     * @param  int $options
     * @param  bool $descending
     * @return $this
     */
    public function sortBy($callback, $options = SORT_REGULAR, $descending = false);

    /**
     * Sort the collection in descending order using the given callback.
     *
     * @param  callable|string $callback
     * @param  int $options
     * @return $this
     */
    public function sortByDesc($callback, $options = SORT_REGULAR);

    /**
     * Splice portion of the underlying collection array.
     *
     * @param  int $offset
     * @param  int $length
     * @param  mixed $replacement
     * @return static
     */
    public function splice($offset, $length = 0, $replacement = []);

    /**
     * Get the sum of the given values.
     *
     * @param  callable|string|null $callback
     * @return mixed
     */
    public function sum($callback = null);

    /**
     * Take the first or last {$limit} items.
     *
     * @param  int $limit
     * @return static
     */
    public function take($limit = null);

    /**
     * Transform each item in the collection using a callback.
     *
     * @param  callable $callback
     * @return $this
     */
    public function transform(callable $callback);

    /**
     * Return only unique items from the collection array.
     *
     * @return static
     */
    public function unique();

    /**
     * Reset the keys on the underlying array.
     *
     * @return static
     */
    public function values();

    /**
     * Get the collection of items as a plain array.
     *
     * @return array
     */
    public function toArray();

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize();

    /**
     * Get the collection of items as JSON.
     *
     * @param  int $options
     * @return string
     */
    public function toJson($options = 0);

    /**
     * Get an iterator for the items.
     *
     * @return \ArrayIterator
     */
    public function getIterator();

    /**
     * Get a CachingIterator instance.
     *
     * @param  int $flags
     * @return CachingIterator
     */
    public function getCachingIterator($flags = CachingIterator::CALL_TOSTRING);

    /**
     * Count the number of items in the collection.
     *
     * @return int
     */
    public function count();

    /**
     * Determine if an item exists at an offset.
     *
     * @param  mixed $key
     * @return bool
     */
    public function offsetExists($key);

    /**
     * Get an item at a given offset.
     *
     * @param  mixed $key
     * @return mixed
     */
    public function offsetGet($key);

    /**
     * Set the item at a given offset.
     *
     * @param  mixed $key
     * @param  mixed $value
     * @return void
     */
    public function offsetSet($key, $value);

    /**
     * Unset the item at a given offset.
     *
     * @param  string $key
     * @return void
     */
    public function offsetUnset($key);

    /**
     * Convert the collection to its string representation.
     *
     * @return string
     */
    public function __toString();
}