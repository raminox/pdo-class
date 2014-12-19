<?php

namespace moofyme;

class QueryBuilder extends Singleton
{
	protected $where;
	protected $select;

	public function raw($query)
	{
		return str_replace('table', $this->table, $query);
	}
}
