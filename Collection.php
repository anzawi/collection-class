<?php

class Collection implements Countable, IteratorAggregate
{
	protected $items = [];

	public function __construct($items = [])
	{
		$this->items = $items;
	}

	public function __toString()
	{
		return $this->toJson();
	}

	public function all()
	{
		return $this->items;
	}

	public function first()
	{
		return isset($this->items[0]) ? $this->items[0] : [];
	}

	public function last()
	{
		$results = array_reverse($this->items);
		return isset($results[0]) ? $results[0] : [];
	}

	public function count()
	{
		return count($this->items);
	}

	public function each($callback)
	{
		foreach($this->items as $key => $value)
		{
			$callback($value, $key);
		}

		return $this;
	}

	public function filter($callback = null)
	{
		if($callback)
		{
			return new static(array_filter($this->items, $callback));
		}

		return new static(array_filter($this->items));
	}

	public function map($callback)
	{
		$keys = array_keys($this->items);

		$items = array_map($callback, $this->items, $keys);

		return new static(array_combine($keys, $items));
	}

	public function toJson()
	{
		return json_encode($this->items);
	}

	public function getIterator()
	{
		return new ArrayIterator($this->items);
	}
}