<?php

namespace App\Http\Controllers;

use App\Models\Audio;
use Illuminate\Http\Request;

class AudioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $audios = Audio::get();

        return view('backend.audios.index',compact('audios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.audios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            // Validate the audio file
        $request->validate([
            'audio' => 'required|mimes:mp3,wav,ogg|max:10240' // 10MB max size
        ]);

        // Check if an audio file was uploaded
        if ($request->hasFile('audio')) {
            $file = $request->file('audio');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Store file in public/audio directory
            $path = $file->storeAs('audio', $filename, 'public');

            $FullPath = asset('storage/' . $path);
            
            $audio = new Audio();
            
            $audio->audio = $FullPath;
            
            $audio->status = $request->has('status') ? 1 : 0;
            
            $audio->save();

            return redirect()->route('audios.index')->with('success', 'Audio Created successfully!');
        }

        return back()->with('error', 'Audio upload failed!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Audio $audio)
    {
        $audio->delete();

        return redirect()->back()->with('success', 'Audio Deleted successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Audio $audio)
    {
        return view('backend.audios.edit',compact('audio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Audio $audio)
    {

        $audio->audio = $request->audio;
        if($request->status){

            $audio->status = $request->status;

        }else{
            $audio->status = 0;
        }
        
    
        $audio->save();
        return redirect()->route('audios.index')->with('success', 'Audio Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Audio $audio)
    {

        $audio->delete();

        return redirect()->back()->with('success', 'Audio Deleted successfully!');
    }
}
