<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use App\Models\Registration;

class UpdateParticipantCount extends Command
{
    protected $signature = 'update:participant-count';
    protected $description = 'Update the participant count in the events table based on registrations';

    public function handle()
    {
        $events = event::all();

        foreach ($events as $event) {
            // Count the number of participants for this event
            $participantCount = Registration::where('event_id', $event->id)->count();

            // Update the participant_count in the events table
            $event->update(['participant_count' => $participantCount]);
        }

        $this->info('Participant counts updated successfully.');
    }
}
