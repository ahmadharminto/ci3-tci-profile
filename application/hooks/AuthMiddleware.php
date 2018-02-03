<?php

class AuthMiddleware {
    protected $CI;

    private $ignore_search_bot;
    private $ip_ignored_list;
    private $controller_ignored_list;
    private $table_visitor;
    private $ignored_path;
    private $ignored_class;
    
    public function __construct()
    {
        $this->CI =& get_instance();

        $this->ignore_search_bot = TRUE;
        $this->ip_ignored_list = [];
        $this->controller_ignored_list = [];
        $this->table_visitor = 'visitor_log';
        $this->auth_ignored_path = [
            'tci-admin/auth/index',
            'tci-admin/auth/login',
            'tci-admin/auth/check',
            'tci-admin/auth/logout',
            'backend/auth/index',
            'backend/auth/login',
            'backend/auth/check',
            'backend/auth/logout'
        ];
        $this->ignored_class = [
            'public'
        ];
    }

    public function handle()
    {
        $class = $this->CI->router->fetch_class();
        $page_name = $class . '/' . $this->CI->router->fetch_method();

        if ($page_name == 'home/timestamp') return;
        if ($class == 'migrate') return;

        if (($this->CI->uri->segment(1) == 'tci-admin' || $this->CI->uri->segment(1) == 'backend')) {
            if (!in_array($this->CI->uri->uri_string, $this->auth_ignored_path) && ($this->CI->session->userdata('in_session') == NULL || $this->CI->session->userdata('in_session') === FALSE)) {
                redirect('/tci-admin/auth/login');
            }

            if ($this->CI->uri->uri_string == 'tci-admin' || $this->CI->uri->uri_string == 'backend') {
                redirect('/tci-admin/auth/login');
            }
            
            if (!in_array($this->CI->uri->uri_string, $this->auth_ignored_path)) {
                // update user-session info
                $existing_session = $this->CI->session->userdata('meta_session');
                $this->CI->load->model('users', 'model_users');
                $this->CI->db->where('users.id', $existing_session->id);
                $query = $this->CI->model_users->get_all();
                if ($query->num_rows() > 0) {
                    $row = $query->row();
                    $this->CI->session->set_userdata('meta_session', $row);
                }

                $page_type = '';
                if ($page_name == 'home/index') $page_type = 'home_section';
                elseif ($page_name == 'user/index' || $page_name == 'user/add' || $page_name == 'user/save' || $page_name == 'user/edit' || $page_name == 'user/update') $page_type = 'config_user';

                // share variable
                $this->CI->load->vars([
                    'current_page' => $page_name,
                    'current_uri_string' => $this->CI->uri->uri_string,
                    'page_type' => $page_type
                ]);
            }
        }
        else {
            if ($class && !in_array($class, $this->ignored_class)) $this->logVisitor($page_name);
        }
    }

    private function logVisitor($page_name)
    {
        $proceed = TRUE;

        if ($this->ignore_search_bot && $this->isBotSearch()) {
            $proceed = FALSE;
        }

        if (in_array($this->CI->input->server('REMOTE_ADDR'), $this->ip_ignored_list)) {
            $proceed = FALSE;
        }

        foreach ($this->controller_ignored_list as $controller) {
            if (strpos(trim($this->CI->router->fetch_class()), $controller) !== FALSE) {
                $proceed = FALSE;
                break;
            }
        }

        if ($page_name && $proceed) {
            $ip_address = $this->CI->input->ip_address();
            $check_visitor = $this->CI->input->cookie(urldecode($page_name), FALSE);
            if (!isset($check_visitor)) {
                $cookie = array(
                    'name'   => urldecode($page_name),
                    'value'  => $ip_address,
                    'expire' => 7200,
                    'secure' => false
                );
                $this->CI->input->set_cookie($cookie);
                $this->saveVisitor($page_name);
            }
        }

        $this->totalVisitors();
    }

    private function saveVisitor($page_name)
    {
        if ($page_name) {
            $page_length = strlen(trim($this->CI->router->fetch_class() . '/' . $this->CI->router->fetch_method()));
            $query_params = trim(substr($this->CI->uri->uri_string(), $page_length + 1));
            $query_string = strlen($query_params) ? $query_params : '';

            $this->CI->db->select('id, no_of_visits');
            $this->CI->db->where([
                'ip_address' => $this->CI->input->server('REMOTE_ADDR'),
                'user_agent' => $this->CI->agent->agent_string(),
                'page_name' => urldecode($page_name),
                'query_string' => $query_string
            ]);
            $this->CI->db->limit(1);
            $query = $this->CI->db->get($this->table_visitor);
            $check = $query->row();

            if (isset($check) && $check->id) {
                $this->CI->db->set(['no_of_visits' => $check->no_of_visits + 1]);
                $this->CI->db->where(['id' => $check->id]);
                $this->CI->db->update($this->table_visitor);
            }
            else {
                $data = array(
                    'no_of_visits' => 1,
                    'ip_address' => $this->CI->input->server('REMOTE_ADDR'),
                    'requested_url' => $this->CI->input->server('REQUEST_URI'),
                    'referer_page' => $this->CI->agent->referrer(),
                    'user_agent' => $this->CI->agent->agent_string(),
                    'page_name' => urldecode($page_name),
                    'query_string' => $query_string
                );

                $this->CI->db->insert($this->table_visitor, $data);
            }
        }
    }

    private function isBotSearch()
    {
        $spiders = array(
            "abot",
            "dbot",
            "ebot",
            "hbot",
            "kbot",
            "lbot",
            "mbot",
            "nbot",
            "obot",
            "pbot",
            "rbot",
            "sbot",
            "tbot",
            "vbot",
            "ybot",
            "zbot",
            "bot.",
            "bot/",
            "_bot",
            ".bot",
            "/bot",
            "-bot",
            ":bot",
            "(bot",
            "crawl",
            "slurp",
            "spider",
            "seek",
            "accoona",
            "acoon",
            "adressendeutschland",
            "ah-ha.com",
            "ahoy",
            "altavista",
            "ananzi",
            "anthill",
            "appie",
            "arachnophilia",
            "arale",
            "araneo",
            "aranha",
            "architext",
            "aretha",
            "arks",
            "asterias",
            "atlocal",
            "atn",
            "atomz",
            "augurfind",
            "backrub",
            "bannana_bot",
            "baypup",
            "bdfetch",
            "big brother",
            "biglotron",
            "bjaaland",
            "blackwidow",
            "blaiz",
            "blog",
            "blo.",
            "bloodhound",
            "boitho",
            "booch",
            "bradley",
            "butterfly",
            "calif",
            "cassandra",
            "ccubee",
            "cfetch",
            "charlotte",
            "churl",
            "cienciaficcion",
            "cmc",
            "collective",
            "comagent",
            "combine",
            "computingsite",
            "csci",
            "curl",
            "cusco",
            "daumoa",
            "deepindex",
            "delorie",
            "depspid",
            "deweb",
            "die blinde kuh",
            "digger",
            "ditto",
            "dmoz",
            "docomo",
            "download express",
            "dtaagent",
            "dwcp",
            "ebiness",
            "ebingbong",
            "e-collector",
            "ejupiter",
            "emacs-w3 search engine",
            "esther",
            "evliya celebi",
            "ezresult",
            "falcon",
            "felix ide",
            "ferret",
            "fetchrover",
            "fido",
            "findlinks",
            "fireball",
            "fish search",
            "fouineur",
            "funnelweb",
            "gazz",
            "gcreep",
            "genieknows",
            "getterroboplus",
            "geturl",
            "glx",
            "goforit",
            "golem",
            "grabber",
            "grapnel",
            "gralon",
            "griffon",
            "gromit",
            "grub",
            "gulliver",
            "hamahakki",
            "harvest",
            "havindex",
            "helix",
            "heritrix",
            "hku www octopus",
            "homerweb",
            "htdig",
            "html index",
            "html_analyzer",
            "htmlgobble",
            "hubater",
            "hyper-decontextualizer",
            "ia_archiver",
            "ibm_planetwide",
            "ichiro",
            "iconsurf",
            "iltrovatore",
            "image.kapsi.net",
            "imagelock",
            "incywincy",
            "indexer",
            "infobee",
            "informant",
            "ingrid",
            "inktomisearch.com",
            "inspector web",
            "intelliagent",
            "internet shinchakubin",
            "ip3000",
            "iron33",
            "israeli-search",
            "ivia",
            "jack",
            "jakarta",
            "javabee",
            "jetbot",
            "jumpstation",
            "katipo",
            "kdd-explorer",
            "kilroy",
            "knowledge",
            "kototoi",
            "kretrieve",
            "labelgrabber",
            "lachesis",
            "larbin",
            "legs",
            "libwww",
            "linkalarm",
            "link validator",
            "linkscan",
            "lockon",
            "lwp",
            "lycos",
            "magpie",
            "mantraagent",
            "mapoftheinternet",
            "marvin/",
            "mattie",
            "mediafox",
            "mediapartners",
            "mercator",
            "merzscope",
            "microsoft url control",
            "minirank",
            "miva",
            "mj12",
            "mnogosearch",
            "moget",
            "monster",
            "moose",
            "motor",
            "multitext",
            "muncher",
            "muscatferret",
            "mwd.search",
            "myweb",
            "najdi",
            "nameprotect",
            "nationaldirectory",
            "nazilla",
            "ncsa beta",
            "nec-meshexplorer",
            "nederland.zoek",
            "netcarta webmap engine",
            "netmechanic",
            "netresearchserver",
            "netscoop",
            "newscan-online",
            "nhse",
            "nokia6682/",
            "nomad",
            "noyona",
            "nutch",
            "nzexplorer",
            "objectssearch",
            "occam",
            "omni",
            "open text",
            "openfind",
            "openintelligencedata",
            "orb search",
            "osis-project",
            "pack rat",
            "pageboy",
            "pagebull",
            "page_verifier",
            "panscient",
            "parasite",
            "partnersite",
            "patric",
            "pear.",
            "pegasus",
            "peregrinator",
            "pgp key agent",
            "phantom",
            "phpdig",
            "picosearch",
            "piltdownman",
            "pimptrain",
            "pinpoint",
            "pioneer",
            "piranha",
            "plumtreewebaccessor",
            "pogodak",
            "poirot",
            "pompos",
            "poppelsdorf",
            "poppi",
            "popular iconoclast",
            "psycheclone",
            "publisher",
            "python",
            "rambler",
            "raven search",
            "roach",
            "road runner",
            "roadhouse",
            "robbie",
            "robofox",
            "robozilla",
            "rules",
            "salty",
            "sbider",
            "scooter",
            "scoutjet",
            "scrubby",
            "search.",
            "searchprocess",
            "semanticdiscovery",
            "senrigan",
            "sg-scout",
            "shai'hulud",
            "shark",
            "shopwiki",
            "sidewinder",
            "sift",
            "silk",
            "simmany",
            "site searcher",
            "site valet",
            "sitetech-rover",
            "skymob.com",
            "sleek",
            "smartwit",
            "sna-",
            "snappy",
            "snooper",
            "sohu",
            "speedfind",
            "sphere",
            "sphider",
            "spinner",
            "spyder",
            "steeler/",
            "suke",
            "suntek",
            "supersnooper",
            "surfnomore",
            "sven",
            "sygol",
            "szukacz",
            "tach black widow",
            "tarantula",
            "templeton",
            "/teoma",
            "t-h-u-n-d-e-r-s-t-o-n-e",
            "theophrastus",
            "titan",
            "titin",
            "tkwww",
            "toutatis",
            "t-rex",
            "tutorgig",
            "twiceler",
            "twisted",
            "ucsd",
            "udmsearch",
            "url check",
            "updated",
            "vagabondo",
            "valkyrie",
            "verticrawl",
            "victoria",
            "vision-search",
            "volcano",
            "voyager/",
            "voyager-hc",
            "w3c_validator",
            "w3m2",
            "w3mir",
            "walker",
            "wallpaper",
            "wanderer",
            "wauuu",
            "wavefire",
            "web core",
            "web hopper",
            "web wombat",
            "webbandit",
            "webcatcher",
            "webcopy",
            "webfoot",
            "weblayers",
            "weblinker",
            "weblog monitor",
            "webmirror",
            "webmonkey",
            "webquest",
            "webreaper",
            "websitepulse",
            "websnarf",
            "webstolperer",
            "webvac",
            "webwalk",
            "webwatch",
            "webwombat",
            "webzinger",
            "wget",
            "whizbang",
            "whowhere",
            "wild ferret",
            "worldlight",
            "wwwc",
            "wwwster",
            "xenu",
            "xget",
            "xift",
            "xirq",
            "yandex",
            "yanga",
            "yeti",
            "yodao",
            "zao/",
            "zippp",
            "zyborg"
        );

        $agent = strtolower($this->CI->agent->agent_string());

        foreach ($spiders as $spider) {
            if (strpos($agent, $spider) !== FALSE)
                return TRUE;
        }

        return FALSE;
    }

    private function totalVisitors()
    {
        $query = $this->CI->db->query('SELECT SUM(no_of_visits) AS total FROM ' . $this->table_visitor . ' LIMIT 1');   
        if ($query->num_rows() == 1) {
            $row = $query->row();
            $this->CI->session->set_userdata('visitor', $row->total);
        }
    }
}