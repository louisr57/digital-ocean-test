<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Calendar;
use App\Models\Registration;

class UpdateParticipantCount extends Command
{
    protected $signature = 'update:participant-count';
    protected $description = 'Update the participant count in the calendars table based on registrations';

    public function handle()
    {
        $calendars = Calendar::all();

        foreach ($calendars as $calendar) {
            // Count the number of participants for this calendar
            $participantCount = Registration::where('event_id', $calendar->id)->count();

            // Update the participant_count in the calendars table
            $calendar->update(['participant_count' => $participantCount]);
        }

        $this->info('Participant counts updated successfully.');
    }
}
