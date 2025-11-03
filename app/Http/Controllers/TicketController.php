<?php 
  
namespace App\Http\Controllers; 
 
use App\Models\Ticket; 
use App\Models\Event;
use Illuminate\Http\Request; 
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller 
{ 
    use ValidatesRequests;
    /** 
    * index 
    * 
    * @return void 
    */ 
    public function index() 
    { 
        $tickets = Ticket::latest()->paginate(5);  
        return view('ticket.index', compact('tickets')); 
    } 

    public function create()
    {
        $events = Event::orderBy('event_name')->get();  
        return view('ticket.create', compact('events'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'id_event'    => 'required|exists:events,id',   
            'ticket_type' => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {
            $event = Event::lockForUpdate()->findOrFail($request->id_event);

            if ($event->quota <= 0) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'id_event' => 'Kuota event sudah habis.',
                ]);
            }

           
            Ticket::create([
                'id_event'    => $request->id_event,         
                'ticket_type' => $request->ticket_type,
                'price'       => $request->price,
            ]);

           
            $event->decrement('quota');
        });

        return redirect()->route('ticket.index')->with('success', 'Ticket berhasil ditambahkan dan kuota event berkurang.');
    }

    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        $events = Event::orderBy('event_name')->get();
        return view('ticket.edit', compact('ticket', 'events'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id_event'    => 'required|exists:events,id',
            'ticket_type' => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->update([
            'id_event'    => $request->id_event,
            'ticket_type' => $request->ticket_type,
            'price'       => $request->price,
        ]);

        return redirect()->route('ticket.index')->with('success', 'Ticket berhasil diperbarui.');
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $ticket = Ticket::findOrFail($id);

            Event::where('id', $ticket->id_event)->increment('quota');

            $ticket->delete();
        });

        return redirect()->route('ticket.index')->with('success', 'Ticket berhasil dihapus dan kuota event dikembalikan.');
    }
}