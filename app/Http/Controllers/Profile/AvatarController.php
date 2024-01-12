<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateAvatarRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use OpenAI\Laravel\Facades\OpenAI;


class AvatarController extends Controller
{
    public function update(UpdateAvatarRequest $request)
    {
        // $path = $request->file('avatar')->store('avatars', 'public');
        $path = Storage::disk('public')->put('avatars', $request->file('avatar'));

        if($oldAvatar = $request->user()->avatar) {
            Storage::disk('public')->delete($oldAvatar);
        }

        auth()->user()->update(['avatar' => $path]);

        return redirect(route('profile.edit'))->with('message', 'Avatar is updated');
    }

    public function generate(Request $request) {
        $result = OpenAI::images()->create([
            "prompt" => "Generate a single avatar with a cool and animated style, inspired by the tech world. Emphasize the facial features of the user, incorporating elements that represent the dynamic and cutting-edge nature of technology. The avatar should have a distinct personality while maintaining a modern and futuristic aesthetic. Consider using elements such as circuit patterns, vibrant colors, or subtle tech-related symbols to enhance the overall tech-inspired vibe. Ensure that the final avatar reflects a sense of innovation and creativity in the tech realm. Please refrain from adding any text to the generated image.",
            "n" => 1,
            "size" => "256x256",
        ]);
        
        $contents = file_get_contents($result->data[0]->url);

        $filename = Str::random(25);

        if($oldAvatar = $request->user()->avatar) {
            Storage::disk('public')->delete($oldAvatar);
        }

        Storage::disk('public')->put("avatars/$filename.jpg", $contents);

        auth()->user()->update(['avatar' => "avatars/$filename.jpg"]);

        return redirect(route('profile.edit'))->with('message', 'Avatar is updated');
    }
}
