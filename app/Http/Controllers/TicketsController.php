<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;


use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Cards;
use App\Items;
use Illuminate\Support\Facades\Storage;
use App\Games;
use App\User;
use App\Settings;
use App\Reviews;
use App\Ticket;
use App\TicketAttachment;
use Illuminate\Support\Facades\View;

class TicketsController extends Controller
{
    private $folder;

    public function __construct(Request $r)
    {
        $f = explode('.', $r->getHttpHost());
        unset($f[count($f) - 1]);
        $f = implode('.', $f);
        $pattern = '/[^a-z0-9]/iu';
        $this->folder = preg_replace($pattern, '', $f);
    }

    public function index(Request $r)
    {
        $tickets = Ticket::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        Ticket::where('direction', 'answer')->update(['status' => 'read']);
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
