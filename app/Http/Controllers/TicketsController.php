<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\User;
use App\Ticket;
use App\TicketAttachment;

class TicketsController extends Controller
{

    public function index(Request $r)
    {
        $tickets = Ticket::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        Ticket::where('direction', 'answer')->where('user_id', Auth::user()->id)->update(['status' => 'read']);
        return view($this->folder . '.tickets.index', compact('tickets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ticket = false;
        if ($request->post('text'))
            $ticket = Ticket::create([
                'user_id' => Auth::user()->id,
                'manager_id' => Auth::user()->manager_id ? Auth::user()->manager_id : User::find('role', 11)->first(),
                'text' => $request->post('text'),
                'ip' => $request->ip()
            ]);
        if ($ticket) {
            if($request->hasFile('attachments')){
                foreach($request->file('attachments') as $file){
                    @mkdir(public_path().'/uploads/tickets/'.$ticket->id.'/', 0755, true);
                    $newfile = Str::random(20).'.'.$file->getClientOriginalExtension();
                    if($file->move(public_path().'/uploads/tickets/'.$ticket->id.'/', $newfile)){
                        TicketAttachment::create([
                            'ticket_id' => $ticket->id,
                            'file' => $newfile,
                            'filename'=>$file->getClientOriginalName()
                        ]);
                    }
                }
            }
            $request->session()->flash('alert-success', __('Ticket accepted, we will contact you shortly!'));
        }
        return redirect()->back();
    }
}
