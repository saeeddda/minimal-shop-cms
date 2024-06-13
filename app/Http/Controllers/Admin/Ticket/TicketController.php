<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\TicketRequest;
use App\Models\Ticket\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        return view('admin.ticket.index', [
            'page_name' => 'همه تیکت ها',
            'tickets' => Ticket::where(['ticket_id' => null])->get()
        ]);
    }

    public function newTickets()
    {
        return view('admin.ticket.index', [
            'page_name' => 'تیکت های جدید',
            'tickets' => Ticket::where([ 'seen' => 0, 'ticket_id' => null])->get()
        ]);
    }

    public function openTickets()
    {
        return view('admin.ticket.index', [
            'page_name' => 'تیکت های باز',
            'tickets' => Ticket::where([ 'status' => 1, 'ticket_id' => null])->get()
        ]);
    }

    public function closedTickets()
    {
        return view('admin.ticket.index', [
            'page_name' => 'تیکت های بسته',
            'tickets' => Ticket::where([ 'status' => 0, 'ticket_id' => null])->get()
        ]);
    }

    public function show(Ticket $ticket)
    {
        $ticket->seen = 1;
        $ticket->save();
        $answers = Ticket::where('ticket_id', $ticket->id)->get();
        return view('admin.ticket.show', compact('ticket', 'answers'));
    }

    public function answer(TicketRequest $request, Ticket $ticket)
    {
        $inputs = $request->all();

        $inputs['subject'] = $ticket->subject;
        $inputs['reference_id'] = $ticket->reference_id;
        $inputs['user_id'] = $ticket->user_id;
        $inputs['category_id'] = $ticket->category_id;
        $inputs['priority_id'] = $ticket->priority_id;
        $inputs['seen'] = $ticket->seen;
        $inputs['status'] = $ticket->status;
        $inputs['ticket_id'] = $ticket->id;

        Ticket::create($inputs);

        return redirect()->route('admin.ticket.show', $ticket->id)
            ->with('alert-success','پاسخ به تیکت افزوده شد.');
    }

    public function change(Ticket $ticket)
    {
        $ticket->status = $ticket->status == 1 ? 0 : 1;
        $result = $ticket->save();
        return redirect()->route('admin.ticket.index')
            ->with('alert-success','عملیات انجام شد.');
    }

}
