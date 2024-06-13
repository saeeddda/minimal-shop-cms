<?php

namespace App\Http\Controllers\Site\Account;

use App\Http\Controllers\Controller;
use App\Models\Ticket\Ticket;
use Illuminate\Http\Request;

class AccountTicketController extends Controller
{
    public function index()
    {
        $tickets = auth()->user()->tickets;
        return view('site.account.tickets-list', compact('tickets'));
    }

    public function create(){

    }

    public function store(){

    }

    public function show(Request $request, Ticket $ticket){
        $answers = Ticket::where('ticket_id', $ticket->id)->get();
        return view('site.account.tickets-show', compact('ticket', 'answers'));
    }

    public function answer(Request $request, Ticket $ticket){

    }

    public function change(Ticket $ticket){

    }
}
