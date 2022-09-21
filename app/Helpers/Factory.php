<?php

function create($class, array $attributes = [], $count = null)
{
    return (new $class)->factory($count)->create($attributes);
}

function make($class, array $attributes = [], $count = null)
{
    return (new $class)->factory($count)->make($attributes);
}
