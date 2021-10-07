<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\FirstInterface;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    protected $blog;
    public function __construct(FirstInterface $blog)
    {
        $this->blog = $blog;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = $this->blog->all();
        return response()->json(['blogs' => $blogs], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'                  => ['required', 'string'],
            'slug'                  => ['required', 'string'],
            'banner'                => ['required'],
            'body'                  => ['required', 'string'],
            'category_id'           => ['required', 'integer'],
            'tag'                   => ['required', 'array']
        ]);

        $data['tag'] = json_encode($data['tag']);
        if(strpos($data['banner'],'image'))
        {
            $file_parts = explode(";base64,", $data['banner']);
            $file_type_aux = explode("/", $file_parts[0]);
            $extension = $file_type_aux[1];

            $fileName = 'Banner/'.time() . '.' . $extension; //generating unique file name;
            Storage::disk('public')->put($fileName, base64_decode($file_parts[1]));
            $data['banner'] = $fileName;
        }
        else
            $data['banner'] = null;

        $this->blog->store($data);
        return response()->json(['message' => 'Blog Added'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = $this->blog->get($id);
        return response()->json(['blog' => $blog], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name'                  => ['required', 'string'],
            'slug'                  => ['required', 'string'],
            'banner'                => ['required'],
            'body'                  => ['required', 'string'],
            'category_id'           => ['required', 'integer'],
            'tag'                   => ['required', 'array']
        ]);

        $data['tag'] = json_encode($data['tag']);
        if(strpos($data['banner'],'image'))
        {
            $file_parts = explode(";base64,", $data['banner']);
            $file_type_aux = explode("/", $file_parts[0]);
            $extension = $file_type_aux[1];

            $fileName = 'Banner/'.time() . '.' . $extension; //generating unique file name;
            Storage::disk('public')->put($fileName, base64_decode($file_parts[1]));
            $data['banner'] = $fileName;
        }
        else
            $data['banner'] = null;

        $this->blog->update($data, $id);
        return response()->json(['message' => 'Blog Updated'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->blog->delete($id);
    }
}
