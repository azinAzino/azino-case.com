<?php

namespace App\Http\Controllers\Admin\Tickets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ticket;
use App\TicketCategory;
use App\TicketTemplate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\TicketAttachment;
use App\User;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function new()
    {
        $tickets = Ticket::where('status', 'new')->where('manager_id', Auth::user()->id)->get();
        return view('manager.tickets.tickets', compact('tickets'));
    }
    public function in_process()
    {
        $tickets = Ticket::where('status', 'in_process')->where('manager_id', Auth::user()->id)->get();
        return view('manager.tickets.tickets', compact('tickets'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = TicketCategory::all();
        $templates = TicketTemplate::all();
        return view('admin.tickets.create', compact('categories', 'templates'));
    }



    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    public function store(Request $request, $id = false)
    {
        $ticket = false;
        if ($request->post('user_id')) {
            $ticket = Ticket::create([
                'user_id' => $request->post('user_id'),
                'manager_id' => Auth::user()->id,
                'text' => $request->post('text'),
                'direction' => 'answer',
                'ip' => $request->ip()
            ]);
        } elseif ($request->post('text')) {
            $question = Ticket::findOrfail($id);
            $ticket = Ticket::create([
                'user_id' => $question->user_id,
                'manager_id' => $question->manager_id,
                'text' => $request->post('text'),
                'direction' => 'answer',
                'ip' => $request->ip()
            ]);
        }
        if ($ticket) {
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    @mkdir(public_path() . '/uploads/tickets/' . $ticket->id . '/', 0755, true);
                    $newfile = Str::random(20) . '.' . $file->getClientOriginalExtension();
                    if ($file->move(public_path() . '/uploads/tickets/' . $ticket->id . '/', $newfile)) {
                        TicketAttachment::create([
                            'ticket_id' => $ticket->id,
                            'file' => $newfile,
                            'filename' => $file->getClientOriginalName()
                        ]);
                    }
                }
            }
            $request->session()->flash('alert-success', __('Ticket sent!'));
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::find($id);
        $categories = TicketCategory::all();
        $templates = TicketTemplate::all();
        return view('admin.tickets.ticket', compact('ticket', 'categories', 'templates'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function history($id)
    {
        $tickets = Ticket::where('user_id', $id)->orderBy('id', 'DESC')->get();
        $categories = TicketCategory::all();
        $templates = TicketTemplate::all();
        return view('admin.tickets.history', compact('tickets', 'categories', 'templates'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = Ticket::find($id);
        $categories = TicketCategory::all();
        $templates = TicketTemplate::all();
        return view('admin.tickets.edit', compact('ticket', 'categories', 'templates'));
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
        $ticket = Ticket::findOrfail($id);
        $ticket->update(['text' => $request->post('text')]);
        $request->session()->flash('alert-success', __('Tickets category created'));
        return redirect("/admin/tickets/history/$ticket->user_id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($id)
    {
        Ticket::findOrfail($id)->delete();
        return redirect()->back();
    }

    public function deleteAll(Request $request)
    {
        Ticket::whereIn('id', $request['to_remove'])->delete();
    }
}
