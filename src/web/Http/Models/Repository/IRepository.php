<?php
namespace Web\Http\Models\Repository;

interface IRepository
{
    function show() : array;
    function findEntity($obj) : array;
    function create($obj) : int;
    function update($obj): int;
    function remove($obj): int;
}
