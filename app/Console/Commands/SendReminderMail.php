<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Mail;

use App\Mail\EpisodeReleased;

use App\TvShow;

use GuzzleHttp\Client;

use Carbon\Carbon;

class SendReminderMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending the Reminder Emails to the user that a tv show they are subscribed to has been released';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date=Carbon::create(date('Y'), date('m'), date('d'))->subDay()->toDateTimeString();

        $comparedate=explode(' ', $date)[0];

        $shows=TvShow::where('next_episode_air_date', $comparedate)->get();

        foreach($shows as $show)
        {
            $this->sendMail($show, $show->getUsers());
        }
    }


    public function sendMail($show, $users)
    {
        foreach($users as $user)
        {
            Mail::to($user)->send(new EpisodeReleased($show, $user));
        }

        $this->setInformation($show);
    }

    public function setInformation($show)
    {
        $client=new Client(['base_uri'=>'https://api.themoviedb.org/3/tv/']);

        $apiKey='a22d7a33b97250f682073a165856d1d7';

        $relative_uri=$show->show_id.'?api_key='.$apiKey;

        $response=$client->request('GET', $relative_uri);

        if($response->getStatusCode() == 200)
        {
            $body=json_decode($response->getBody());

            $show->next_episode_air_date=$body->next_episode_to_air->air_date;

            $show->next_episode_number=$body->next_episode_to_air->episode_number;

            $show->next_episode_season=$body->next_episode_to_air->season_number;

            $show->about_episode=$body->next_episode_to_air->overview;

            if(!$body->in_production)
            {
                $show->ended=1;
            }

            $show->save();
        }
    }
}
