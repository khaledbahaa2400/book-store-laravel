<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Message::class);
        return view('admin.messages', ['messages' => Message::all()]);
    }

    public function create()
    {
        return view('user.contact');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'number' => ['required', 'regex:/^[0-9\s()+\-]+$/'],
            'message' => ['required', 'min:5'],
        ], [
            'number.regex' => 'Enter a valid phone number.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Message::create([
            'user_id' => auth()->id(),
            'phone' => $request->input('number'),
            'message' => $request->input('message'),
        ]);

        return back()->with('success', 'Message Sent Successfully');
    }

    public function destroy(Message $message)
    {
        $this->authorize('delete', $message);
        $message->delete();
        return back()->with('success', 'Message Deleted Successfully');
    }
}
