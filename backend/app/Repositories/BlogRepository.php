<?php

namespace App\Repositories;
use App\Models\Blog;

class BlogRepository implements FirstInterface
{
    public function all()
    {
        return Blog::all();
    }

    public function get($id)
    {
        return Blog::find($id);
    }

    public function store(array $data)
    {
        return Blog::create($data);
    }

    public function update(array $data, $id)
    {
        return Blog::find($id)->update($data);
    }

    public function delete($id)
    {
        return Blog::destroy($id);
    }
}
