<?php

/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 5/09/2018
 * Time: 9:09 AM
 */

namespace Org_Saludables\Negocio\Logica\Google;

use Carbon\Carbon;
use App\Org_Saludables\Datos\Repositorio\MCitas\ICitasRepositorio;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Redirect;
//use Illuminate\Http\Redirect;

;

class GoogleCalendar 
{
    //protected $client;
        protected $citaRepositorio;

    public function __construct(ICitasRepositorio $citaRepositorio)
    {
         $this->citaRepositorio = $citaRepositorio;
        $client = new Google_Client();
        $client->setAuthConfig('client_secret.json');
        $client->addScope(Google_Service_Calendar::CALENDAR);
        $client -> setAccessType ( "offline" );
         $client->setApprovalPrompt('force');

        //$guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false)));
       // $client->setHttpClient($guzzleClient);
        $this->client = $client;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        session_start();
        $client = new Google_Client();
       
       $client->setAuthConfig('client_secret.json');
        $client->addScope(Google_Service_Calendar::CALENDAR);

      // $guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false)));
       //$client->setHttpClient($guzzleClient);
        $client -> setAccessType( "offline" );
         $client->setApprovalPrompt('force');
        //session_unset();

     
    
       
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $client->setAccessToken($_SESSION['access_token']);
            $service = new Google_Service_Calendar($client);

            $calendarId = 'primary';

            $results = $service->events->listEvents($calendarId);
           
            return ['respuesta' =>true, 'resultado' =>$results->getItems()];
            //return $results->getItems();

        } else {
          // return redirect()->route('oauthCallback');
           return $this->oauth();
        }

    }

    public function oauth()
    {

        // session_start();
        $client = new Google_Client();
       $client->setAuthConfig('client_secret.json');
        $client->addScope(Google_Service_Calendar::CALENDAR);

        //$guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false)));
       // $client->setHttpClient($guzzleClient);
         $client -> setAccessType ("offline" );
         $client->setApprovalPrompt('force');
  
        //session_start();

        $rurl = action('gCalendarController@oauth');
        $client->setRedirectUri($rurl);
        if (!isset($_GET['code'])) {
            $auth_url = $client->createAuthUrl();
            $filtered_url = filter_var($auth_url, FILTER_SANITIZE_URL);
             //return redirect($filtered_url);
            //return redirect()->away($filtered_url);
            //return Redirect::to($filtered_url);
            //return redirect::intended($filtered_url);
            //return $filtered_url;
       
            return ['respuesta' =>false, 'resultado'=>$filtered_url];
            // return $filtered_url;
             //return  new RedirectResponse($filtered_url); 
            // return new RedirectResponse($filtered_url->url); 
        } else {
            $client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $client->getAccessToken();
             if ($client->isAccessTokenExpired()) {
             $client->refreshTokenWithAssertion();
             }
           
            return redirect()->route('home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('calendar.createEvent');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store($Fecha, $Inicio, $Fin, $Lugar)
    {
        
        //session_start();
        $client = new Google_Client();
        $client->setAuthConfig('client_secret.json');
        $client->addScope(Google_Service_Calendar::CALENDAR);

      //  $guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false)));
       // $client->setHttpClient($guzzleClient);
       $client -> setAccessType ( "offline" );
       $client->setApprovalPrompt('force');
       
        //session_start();
         $fecha=$Fecha;
         $inicio=$Inicio;
         $Fin=$Fin;
         $Lugar=$Lugar;
     

        $startDateTime = $fecha."T".$inicio."-05:00";
        $endDateTime =   $fecha."T".$Fin."-05:00";


      if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $client->setAccessToken($_SESSION['access_token']);
            $service = new Google_Service_Calendar($client);

            $calendarId = 'primary';
            $event = new Google_Service_Calendar_Event([
                 'summary' => "Cita Rio Booking". $Lugar,
                'location'=> $Lugar,
                'description' => "Cita Rio Booking",
                'start' => ['dateTime' =>  $startDateTime,
                'timeZone' =>"America/Bogota"],
                'end' => ['dateTime' => $endDateTime,
                          'timeZone' =>"America/Bogota"],
                'reminders' => ['setEmail' => "jvargasg@serviciosnutresa.com",
                                 'setEmmail' =>"jovaga2012@gmail.com"],
            ]);
          
            $results = $service->events->insert($calendarId, $event);
            $idEvento=$results->id;
            //$this->AgendaRepositorio->GuardarIdEvento($cita, $idEvento, $citaPorUsuario);
         
            if (!$results) {
             
                return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
            }
            return response()->json(['status' => 'success', 'message' => 'Event Created']);
        } else {
          $this->oauth();
       }
    }

    /**
     * Display the specified resource.
     *
     * @param $eventId
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show($eventId)
    {
        session_start();
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);

            $service = new Google_Service_Calendar($this->client);
            $event = $service->events->get('primary', $eventId);

            if (!$event) {
                return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
            }
            return response()->json(['status' => 'success', 'data' => $event]);

        } else {
            return redirect()->route('oauthCallback');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $eventId
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, $eventId)
    {
        session_start();
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);
            $service = new Google_Service_Calendar($this->client);

            $startDateTime = Carbon::parse($request->start_date)->toRfc3339String();

            $eventDuration = 30; //minutes

            if ($request->has('end_date')) {
                $endDateTime = Carbon::parse($request->end_date)->toRfc3339String();

            } else {
                $endDateTime = Carbon::parse($request->start_date)->addMinutes($eventDuration)->toRfc3339String();
            }

            // retrieve the event from the API.
            $event = $service->events->get('primary', $eventId);

            $event->setSummary($request->title);

            $event->setDescription($request->description);

            //start time
            $start = new Google_Service_Calendar_EventDateTime();
            $start->setDateTime($startDateTime);
            $event->setStart($start);

            //end time
            $end = new Google_Service_Calendar_EventDateTime();
            $end->setDateTime($endDateTime);
            $event->setEnd($end);

            $updatedEvent = $service->events->update('primary', $event->getId(), $event);


            if (!$updatedEvent) {
                return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
            }
            return response()->json(['status' => 'success', 'data' => $updatedEvent]);

        } else {
            return redirect()->route('oauthCallback');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $eventId
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy($eventId, $cita, $citaPorUsuario)
    {
           session_start();
              
        $client = new Google_Client();
        $client->setAuthConfig('client_secret.json');
        $client->addScope(Google_Service_Calendar::CALENDAR);

       // $guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false)));
        //$client->setHttpClient($guzzleClient);
        $client ->setAccessType ( "offline" );
         $client->setApprovalPrompt('force');
     
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);
            $service = new Google_Service_Calendar($this->client);

            $service->events->delete('primary', $eventId);
      
            $this->citaRepositorio->EliminarIdEvento($eventId, $cita, $citaPorUsuario);


        } else {
              $this->oauth();
       }
    }
}
