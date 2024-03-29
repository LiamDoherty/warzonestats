<?php

        //Player overall stats
        //CURLOPT_URL => $this->defaultBaseURL."stats/cod/v1/title/mw/platform/".$platform."/gamer/".$encodedUserName."/profile/type/wz",

        //Get all match history
        //"crm/cod/v2/title/mw/platform/".$platform."/gamer/".$encodedUserName."/matches/wz/start/0/end/0

        //Get the details for each match
        //"crm/cod/v2/title/mw/platform/".$platform."/gamer/".$encodedUserName."/matches/wz/start/0/end/0/details

class Home extends CI_Controller
{
    private $baseCookie = "new_SiteId=cod; ACT_SSO_LOCALE=en_US;country=US;";
    private  $defaultBaseURL = "https://my.callofduty.com/api/papi-client/";
    private $token;
    private $curl;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->curl = curl_init();
    }

    public function GenerateLink()
    {
        $username = $this->input->post('username');
        $platform = $this->input->post('platform');
        $overlayType = $this->input->post('overlayType');
        $bgType = $this->input->post('bgType');
        $this->SetToken($this->baseCookie);
        $this->Login("info@hexeum.net", "Hexeum0verlay", false);
        $username =  urlencode($username);
        $isUser = $this->ConfirmUser($username, $platform);

        if(!$isUser)
        {
            $data = array('confirmed' => false, 'username' => $username, 'platform' => $platform,
            "overlayType" => $overlayType, "bgType" => $bgType);
            $this->view("home", $data);
        }
        else{
            $data = array('confirmed' => true, 'username' => $username, 'platform' => $platform,
            "overlayType" => $overlayType, "bgType" => $bgType);
            $this->view('home', $data);
        }
    }

    public function ConfirmUser($username, $platform)
    {
        curl_setopt_array($this->curl, array(
        CURLOPT_URL => $this->defaultBaseURL."stats/cod/v1/title/mw/platform/".$platform."/gamer/".$username."/profile/type/mp",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_HTTPHEADER => array("Cookie: ".$this->baseCookie,
        "Accept: application/json, text/javascript, */*; q=0.01"),
        CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($this->curl);
        log_message('debug', $response);
        $array = json_decode($response, true);
        if($array['status'] != 'success')
        {
            if($array['status' == "error"])
            {
                log_message('info', "Failed to confirm user, this could be due to incorrect details or api call failed");   
            }
            return false;
        }
        else{
            log_message('info', "User was successfully logged in and made a call to the api");   
             return true;
        }
    }

    public function getDailyStats($username, $platform, $bgType = 'transparent')
    {
        $newData  =$this->GetStatsArray($username, $platform);
        $mergedData = array(
            'username' => $username,
            'platform' => $platform,
            'wins' => $newData['wins'],
            'kills' => $newData['kills'],
            'bgType' => $bgType,
            'mostRecentMatchId' => $newData['mostRecentMatchId']
        );

        $this->load->view('templates/overlay-template');
        $this->load->view('pages/dailyOverlay', $mergedData);
    }

    public function UpdateDailyOverlay()
    {
        $username = $this->input->post('username');
        $platform = $this->input->post('platform');
        $newData  = $this->GetStatsArray($username, $platform);
        $mergedData = array(
            'wins' => $newData['wins'],
            'kills' => $newData['kills'],
            'mostRecentMatchId' => $newData['mostRecentMatchId']
        );
        echo json_encode($mergedData);
    }

    public function UpdateOverlay()
    {
        $username = $this->input->post('username');
        $platform = $this->input->post('platform');
        $newData  = $this->GetStatsArray($username, $platform);
        $mergedData = array(
            'wins' => $newData['wins'],
            'kills' => $newData['kills'],
            'totalKills' => $newData['totalKills'],
            'totalWins' => $newData['totalWins'],
            'mostRecentMatchId' => $newData['mostRecentMatchId']
        );
        echo json_encode($mergedData);
    }

    public function getOverlayStats($username, $platform, $bgType = 'transparent')
    {
        $newData  =$this->GetStatsArray($username, $platform);
        $mergedData = array(
            'username' => $username,
            'platform' => $platform,
            'wins' => $newData['wins'],
            'kills' => $newData['kills'],
            'totalKills' => $newData['totalKills'],
            'totalWins' => $newData['totalWins'],
            'bgType' => $bgType,
            'mostRecentMatchId' => $newData['mostRecentMatchId']
        );

        $this->load->view('templates/overlay-template');
        $this->load->view('pages/overlay', $mergedData);
    }

    private function GetUserStats($userName, $platform)
    {
        $this->SetToken($this->baseCookie);
        $this->Login("info@hexeum.net", "Hexeum0verlay", false);
        $matches = $this->GetAllMatchHistory($userName, $platform);
        $matchTimestamps = $this->GetMatchTimestampsFromLast24Hours($matches);

        if(count($matchTimestamps) > 0)
        {
            $this->GetTotalKillsFromMatchList($matchTimestamps, $userName, $platform);      
        }
    }

    private function RefreshOverlay($userName, $platform, $matchId = null)
    {
        $this->SetToken($this->baseCookie);
        $this->Login("info@hexeum.net", "Hexeum0verlay", false);
        $matchData = $this->GetKillsSinceMostRecentMatch($matchId, $userName, $platform);

        if($matchData != null)
        {
            return $matchData;
        }       
    }

    private function GetKillsSinceMostRecentMatch($mostRecentMatchId, $userName, $platform)
    {
        curl_setopt_array($this->curl, array(
        CURLOPT_URL => $this->defaultBaseURL."crm/cod/v2/title/mw/platform/".$platform."/gamer/".$userName."/matches/wz/start/0/end/0/details",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_HTTPHEADER => array("Cookie: ".$this->baseCookie,
        "Accept: application/json, text/javascript, */*; q=0.01"),
        CURLOPT_CUSTOMREQUEST => "GET",
        ));//Gets last 20 matches or some shit

        curl_setopt($this->curl, CURLOPT_COOKIEJAR, '/tmp/cookies.txt');
        curl_setopt($this->curl, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');

        $response = curl_exec($this->curl);
        $matchDetails = json_decode($response, true);
        $matches = $matchDetails['data']['matches'];
        //Loop the matches array until we find our Id
        
        $newMostRecentMatchId = 0;
        $newKills = 0;
        $newWins = 0;
        $refreshData = null;
        if($matches != null && count($matches) > 0)
        {
            if($mostRecentMatchId != null)
            {
                $lastUpdatedMatchIndex = 0;
                for($i = 0; $i < count($matches); $i++)
                {
                    $matchId = $matches[$i]["matchID"];

                    if($matchId == $mostRecentMatchId)
                    {
                        $lastUpdatedMatchIndex = $i;                                                       
                    }
                }

                if($lastUpdatedMatchIndex - 1 >= 0)//At least one new match has been played
                {
                    for($i = ($lastUpdatedMatchIndex - 1); $i >= 0; $i--)
                    {//Aggregate data here
                        $newKills += $matches[$i]["playerStats"]["kills"];

                        //print_r($matches[$i]['playerStats']['teamPlacement']."  ");
                        if($matches[$i]['playerStats']['teamPlacement'] == 1)
                        {
                            $newWins += 1;
                        }
                    }
                }
            }
            $newMostRecentMatchId = $matches[0]["matchID"];
            $refreshData = array("mostRecentMatchId"=>$newMostRecentMatchId, "kills"=>$newKills, "wins"=>$newWins, 
            "username"=>$userName, "platform"=>$platform);
        }
        return $refreshData;
    }

    private function GetStatsArray($username, $platform)
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('platform', 'Platform', 'required');        

        $receivedData = array(
            'username' => $username,
            'platform' => $platform,
            'mostRecentMatchId' => $this->input->post('mostRecentMatchId'),
            'kills' => $this->input->post('kills'),
            'wins' => $this->input->post('wins')
        );

        $updatedData = $this->RefreshOverlay($receivedData['username'], $receivedData['platform'], $receivedData['mostRecentMatchId']);
        $careerData = $this->GetCareerStats($receivedData['username'], $receivedData['platform']);

        $aggregatedKills = $updatedData['kills'] + $receivedData['kills'];
        $aggregatedWins = $updatedData['wins'] + $receivedData['wins'];

        $updatedData['kills'] = $aggregatedKills;
        $updatedData['wins'] = $aggregatedWins;
        $updatedData += $careerData;
        return $updatedData;
    }
    

    private function SetToken($baseCookie)
    {
        $url = "https://profile.callofduty.com/cod/login";
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($this->curl);
        $this->token = $this->ParseTokenFromResponse($response);
        log_message("debug", "Login attempt token response ".$this->token);
        $this->baseCookie = "new_SiteId=cod; ACT_SSO_LOCALE=en_US;XSRF-TOKEN=".$this->token.";";
    }

    private function Login($email, $password, $debugResponse)
    {
        log_message('debug', 'Logging in with cookie '.$this->baseCookie);
        curl_setopt_array($this->curl, array(
          CURLOPT_URL => "https://profile.callofduty.com/do_login?new_SiteId=cod",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_POSTFIELDS => array('username' => $email,'password' => $password,'remember_me' => 'true','_csrf' => $this->token),
          CURLOPT_HTTPHEADER => array(
            "Cookie: " .$this->baseCookie,
            "Accept: application/json, text/javascript, */*; q=0.01",
            "Connection: keep-alive"
          ),
        ));

        $cookies = tempnam('/tmp','cookies.txt');
        curl_setopt($this->curl, CURLOPT_COOKIEJAR, $cookies);
        curl_setopt($this->curl, CURLOPT_COOKIEFILE, $cookies);
        
        curl_setopt($this->curl, CURLOPT_VERBOSE, true);
        $verbose = fopen('php://temp', 'w+');
        curl_setopt($this->curl, CURLOPT_STDERR, $verbose);

        $response = curl_exec($this->curl);
        rewind($verbose);
        $verboseLog = stream_get_contents($verbose);
        if($debugResponse)
        {
            echo "Verbose information:\n<pre>", htmlspecialchars($verboseLog), "</pre>\n";
            echo "end verbose info";
        }
    }

    private function GetCareerStats($userName, $platform)//Need cookies to already be set
    {
        curl_setopt_array($this->curl, array(
        CURLOPT_URL => $this->defaultBaseURL."stats/cod/v1/title/mw/platform/".$platform."/gamer/".$userName."/profile/type/mp",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_HTTPHEADER => array("Cookie: ".$this->baseCookie,
        "Accept: application/json, text/javascript, */*; q=0.01"),
        CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($this->curl);

        $careerData = (json_decode($response, true))['data'];
        $returnData = array("totalKills"=> $careerData['lifetime']['mode']['br_all']['properties']['kills'], 
        "totalWins"=>$careerData['lifetime']['mode']['br_all']['properties']['wins']);
        return $returnData;
    }
    
    private function GetAllMatchHistory($userName, $platform)
    {
        curl_setopt_array($this->curl, array(
        CURLOPT_URL => $this->defaultBaseURL."crm/cod/v2/title/mw/platform/".$platform."/gamer/".$userName."/matches/wz/start/0/end/0/",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_HTTPHEADER => array("Cookie: ".$this->baseCookie,
        "Accept: application/json, text/javascript, */*; q=0.01"),
        CURLOPT_CUSTOMREQUEST => "GET",
        ));

        curl_setopt($this->curl, CURLOPT_VERBOSE, true);
        $verbose = fopen('php://temp', 'w+');
        curl_setopt($this->curl, CURLOPT_STDERR, $verbose);

        $response = curl_exec($this->curl);
        
        rewind($verbose);
        $verboseLog = stream_get_contents($verbose);

        $allMatches = json_decode($response, true);
        return $allMatches;
    }

    public function GetMatchTimestampsFromLast24Hours($matches)
    {
        $gamesSinceYesterday = []; 
        if($matches["status"] == "error")
        {
            print_r("oh fak man");//something better here
        }
        else
        {
            $dataArray = $matches["data"];
            $time = round(microtime(true) * 1000);
            $yesterday = $time - 86400000;
            foreach ($dataArray as &$value) {
                if($value["timestamp"] > $yesterday)
                {
                    array_push($gamesSinceYesterday, $value["timestamp"]);
                }
            }
        }
        return $gamesSinceYesterday;
    }

    public function GetTotalKillsFromMatchList($matchTimeStamps, $userName, $platform)
    {
        $time = round(microtime(true) * 1000);
        $numKills = 0;
        for ($x = 0; $x <= count($matchTimeStamps) - 1; $x++) {
            $startTime = 0;
            $endTime = 0; 
            if($x == 0)
            {
                $startTime = $matchTimeStamps[$x];
                $endTime = $time;
            }
            else{
                $startTime = $matchTimeStamps[$x];
                $endTime = $matchTimeStamps[$x - 1];
            }
            $numKills += $this->GetMatchDetails($startTime, $endTime, $userName, $platform);
        }
    }

    public function GetMatchDetails($startTime, $endTime, $userName, $platform)
    {
        $encodedUserName = urlencode($userName);
        curl_setopt_array($this->curl, array(
        CURLOPT_URL => $this->defaultBaseURL."crm/cod/v2/title/mw/platform/".$platform."/gamer/".$encodedUserName."/matches/wz/start/".$startTime."/end/".$endTime."/details",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_HTTPHEADER => array("Cookie: ".$this->baseCookie,
        "Accept: application/json, text/javascript, */*; q=0.01"),
        CURLOPT_CUSTOMREQUEST => "GET",
        ));

        curl_setopt($this->curl, CURLOPT_VERBOSE, true);
        $verbose = fopen('php://temp', 'w+');
        curl_setopt($this->curl, CURLOPT_STDERR, $verbose);

        $response = curl_exec($this->curl);

        rewind($verbose);
        $verboseLog = stream_get_contents($verbose);
        $allMatches = json_decode($response, true);
        return $allMatches['data']['summary']['all']['kills'];
    }

    public function view($page = 'home', $data = null)
    {
        if(!file_exists(APPPATH.'views/pages/' .$page.'.php'))
        {
            show_404();
        }

        $title = $this->GetCorrectTitle($page);
        $data['meta_description'] = "COD warzone stats streaming overlay. Free to use overlay for displaying warzone stats on stream. For all major platforms including Twitch, Mixer, Streamlabs";

        $title = "Call of Duty Stream Overlay : Warzone Stats Overlay";

        if($data == null)
        {
            $data = array('username' => '', 'platform' => '',
            "overlayType" => '', 'title' => $title, "bgType" => '', 'page' => $page);
        }
        else
        {
            $data += array('title' => $title);
            $data += array('page' => $page);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('pages/' .$page, $data);
        $this->load->view('templates/footer', $data);
    }

    private function GetCorrectTitle($pageName)
    {
        if($pageName == 'about')
        {
            return "About Us";         
        }
        else return 'Warzone Stats Overlay';
    }

    private function ParseTokenFromResponse($response)
    {
        $doc = new DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML($response);
        libxml_use_internal_errors(false);

        $tokens = $doc->getElementsByTagName('input');

        for($i = 0; $i < $tokens->length; $i++)
        {
            $input = $tokens->item($i);
            if($input->getAttribute('name') == "_csrf")
            {
                $token = $input->getAttribute('value');
                return $token;
            }
        }
    }
}