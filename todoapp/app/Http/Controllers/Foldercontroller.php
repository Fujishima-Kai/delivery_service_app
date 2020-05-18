<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Folder;
use App\Http\Requests\CreateFolder;


class Foldercontroller extends Controller
{
    public function create()
    {
    	return view('folders.create');
    }

	public function store(CreateFolder $request)
    {
    	$folder = new Folder();
    	$folder->title = $request->title;
    	$folder->save();

    	return redirect()->route('tasks.index', ['folder_id' => $folder->id,]);
    }    
}
