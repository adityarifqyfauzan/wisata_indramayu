<?php
namespace App\Controllers\Webhook;

use CodeIgniter\RESTful\ResourceController;
use App\Models\TempatWisataModel;

class DialogflowRespond extends ResourceController {

    protected $format = 'json';
    protected $tempatWisataModel;

    protected $action;

    protected $parameters = [];

    protected $text;

    public function __construct()
    {
        $this->tempatWisataModel = new TempatWisataModel();
        $this->action;
        $this->text;
        $this->parameters;
    }

    public function index()
    {
        // ambil request yang diberikan dari dialogflow
        $getRequestFromDialogflow = file_get_contents('php://input');

        // fungsi json_encode digunain buat ngubah masukan/data yang awalnya berformat json menjadi array assosiatif
        $agent = json_decode($getRequestFromDialogflow, true);

        // Get Parameter kategori wisata 
        $kategoriwisata = $this->getParameters($agent, "kategoriwisata");

        // Get Parameter nama wisata
        $namawisata = $this->getParameters($agent, "namawisata");

        // Get Parameter kabupaten
        $kabupaten = $this->getParameters($agent, "kabupaten");
        
        // Get Parameter keterangan
        $keterangan = $this->getParameters($agent, "ket");

        // Get Pesan yang dikirimkan oleh user
        $message = $this->getTextFromUser($agent);

        // Digunakan untuk mengambil action dari user
        $action = $this->getAction($agent);

        // apabila user menanyakan hal mengenai wisata (Intent Wisata)
        if ($action == "input.wisata") {
            
            // Jika user menanyakan tempat wisata (Semua tempat wisata) di indramayu
            if ($kategoriwisata == "Wisata") {
                
                // Get semua data wisata yang aktif
                $getData = $this->tempatWisataModel->getDataWisataAktif(true); 

                // kirim respon ke user
                $this->sendMessage($getData); 
                // $text = "Berikut ini adalah tempat wisata di Indramayu";
                // $this->sendRichMessageForWisataList($getData, $text);



            }else{
                
                // Jika User menanyakan detail/keterangan tempat wisata
                if ($namawisata != null && $keterangan != null) {

                    // Apabila yang ditanyakan nya adalah lokasi wisata
                    if ($keterangan == "Lokasi") {
                        
                        // Get lokasi wisata berdasarkan nama wisata yang ditanyakan oleh user
                        $getData = $this->tempatWisataModel->getLokasiWisata($namawisata);

                        if ($getData['status'] == 200) {
                            
                            // kirim respon ke user
                            // $this->sendRichMessageForLocation($getData['text'], $getData['dataWisata']);
                            $this->sendMessage($getData['text']);

                        } else if ($getData['status'] == 404) {
                            
                            // kirim respon ke user
                            $this->sendMessage($getData['text']);

                        }
                        

                    } 
                    // Apabila yang ditanyakan nya adalah Waktu Operasional
                    else if ($keterangan == "Waktu Operasional") {
                        
                        // Get Waktu operasional berdasarkan nama wisata yang ditanyakan oleh user
                        $getData = $this->tempatWisataModel->getWaktuOperasionalWisata($namawisata);

                        // kirim respon ke user
                        $this->sendMessage($getData);

                    } 
                    // Apabila yang ditanyakan nya adalah Harga Tiket
                    else if ($keterangan == "Harga Tiket") {
                        
                        // Get Harga tiket berdasarkan nama wisata yang ditanyakan oleh user
                        $getData = $this->tempatWisataModel->getHargaTiketWisata($namawisata);

                        // kirim respon ke user
                        
                        if ($getData['status'] == 200) {
                            
                            $this->sendMessage($getData['text']);
                            // $this->sendRichMessageForHargaTiket($getData['dataTiket'], $getData['text']);

                        }else if ($getData['status'] == 404) {
                            
                            $this->sendMessage($getData['text']);

                        }else if ($getData['status'] == 403) {

                            $this->sendMessage($getData['text']);

                        }

                    }
                    // Apabila yang ditanyakan nya adalah Hal selain diatas (Out of topic)
                    else {

                        $message = "Maaf, kami hanya memberikan informasi mengenai lokasi, waktu operasional dan harga tiket saja";

                        $this->sendMessage($message);

                    }

                } else if ($namawisata != null) {

                    $getData = $this->tempatWisataModel->getInformasiWisataByName($namawisata);

                    if ($getData['status'] == 200) {
                        
                        $this->sendMessage($getData['text']);
                        // $this->sendRichMessageForInformasiUmumWisata($getData['dataWisata'], $getData['text']);

                    } else if($getData['status'] == 404) {
                        
                        $this->sendMessage($getData['text']);

                    }
                    
                
                }
                // Apabila user menanyakan tempat wisata (semua tempat wisata di Indramayu) berdasarkan nama kategori
                else if ($kategoriwisata != null || $kategoriwisata && $kabupaten != null) {

                    // Get semua data wisata dengan nama kategori sesuai permintaan user
                    $getData = $this->tempatWisataModel->getWisataByKategoriName($kategoriwisata, $message);

                    // kirim respon ke user
                    
                    if ($getData['status'] == 200) {
                        
                        $this->sendMessage($getData['text']);
                        // $this->sendRichMessageForKategoriWisata($getData['dataWisata'], $getData['text']);
                        
                    } else if($getData['status'] == 201) {
                        
                        $this->sendMessage($getData['text']);
                        // $this->sendRichMessageForKategoriWisata($getData['dataWisata'], $getData['text']);
                    
                    } else if($getData['status'] == 404){

                        $this->sendMessage($getData['text']);

                    }
                    


                }

            }
        
        }

            
    }

    public function getTextFromUser($agent)
    {
        $this->text = $agent['queryResult']['queryText'];
        return $this->text;
    }

    public function getAction($param)
    {
        $this->action = $param['queryResult']['action'];

        return $this->action;
    }

    public function getParameters($agent, $param)
    {
        if ($param == "namawisata") {

            $this->parameters['namawisata'] = ($agent['queryResult']['parameters']['namawisata']) ? $agent['queryResult']['parameters']['namawisata'] : null;

            return $this->parameters['namawisata'];
            
        } else if ($param == "ket") {
            
            $this->parameters['ket'] = ($agent['queryResult']['parameters']['ket']) ? $agent['queryResult']['parameters']['ket'] : null;

            return $this->parameters['ket'];
            
        } else if ($param == "kategoriwisata") {
            
            $this->parameters['kategoriwisata'] = ($agent['queryResult']['parameters']['kategoriwisata']) ? $agent['queryResult']['parameters']['kategoriwisata'] : null;

            return $this->parameters['kategoriwisata'];
            
        } else if ($param == "kabupaten") {
            
            $this->parameters['kabupaten'] = ($agent['queryResult']['parameters']['kabupaten']) ? $agent['queryResult']['parameters']['kabupaten'] : null;
            
            return $this->parameters['kabupaten'];

        } else {

            return null;

        }
    
    }

    public function sendMessage($params)
    {   
        $data = array(
            "source" => null,
            "fulfillmentText" => $params
        );

        echo json_encode($data);
    }

    public function sendRichMessageForKategoriWisata($dataWisata, $text)
    {
        $message = "";
        $message .= '
            {
            "fulfillmentMessages": [
                {
                        "text": {
                            "text": [
                            "' . $text . '"
                            ]
                        }
                },
                {
                    "payload": {
                        "richContent": [
                        [
                        {
                            "type": "description",
                            "title": "Daftar Objek Wisata di Indramayu",
                            "text": [';


        foreach ($dataWisata as $key) {

            $message .= '"' . $key['nama_wisata'] . '",';
        }

        $message .= '                
                            ]
                        },
                        {
                            "type": "description",
                            "title": "",
                            "text": [
                                "Anda bisa bertanya seputar lokasi, harga tiket dan waktu operasional dari tempat wisata diatas, atau dengan mengetikkan nama wisata diatas"
                            ]   
                        }
                        ]
                        ]
                    }
                }
            ]
            }
        ';

        echo $message;
    }

    public function sendRichMessageForHargaTiket($dataTiket, $text)
    {
        $message = '';
        $message .= '
            {
            "fulfillmentMessages": [
                {
                        
                },
                {
                    "payload": {
                        "richContent": [
                        [
                        {
                            "type": "description",
                            "title": "'.$text.'",
                            "text": [
                                
                                ';


        foreach ($dataTiket as $key) {

            $keteranganUsia = $key['keterangan'];

            if ($keteranganUsia == "Semua") {
                
                $keteranganUsia = "Semua Umur";

            } else {
                
                $keteranganUsia = $key['keterangan'];

            }
            

            $message .= '"' . $keteranganUsia . ' | Hari '. $key['keterangan_hari'] .' | Tiket Rp '. number_format($key['harga']) .'",';
        }

        $message .= '                
                            ]
                        }
                        ]
                        ]
                    }
                }
            ]
            }
        ';

        echo $message;
    }

    public function sendRichMessageForInformasiUmumWisata($dataWisata, $text)
    {
        
        $id = $dataWisata['id'];
        $nama_wisata = $dataWisata['nama_wisata'];
        $alamat = $dataWisata['alamat'];
        $deskrpsi = $dataWisata['deskripsi'];
        $link_foto = base_url() . "/assets/img/profile_pengelola/" . $dataWisata['foto'];
        $link_detail = base_url() . "/detail_wisata/$id";

        $message = "";
        $message .='
            {
            "fulfillmentMessages": [
                {
                        "text": {
                            "text": [
                            "' . $text . '"
                            ]
                        }
                },
                {
                    "payload": {
                        "richContent": [
                        [';
                        if($dataWisata['foto'] != null) {
                        
                        $message .=  '{
                                        "type": "image",
                                        "rawUrl": "'. $link_foto .'",
                                        "accessibilityText": "'. $nama_wisata .'"
                                    },';
                        
                        }
            $message .= '{
                            "type": "info",
                            "title": "'. $nama_wisata .'",
                            "subtitle": "'. $alamat .'",
                            "actionLink": ""
                        },
                        {
                            "type": "accordion",
                            "title": "Deskripsi",
                            "image": {
                            "src": {
                                "rawUrl": "https://example.com/images/logo.png"
                            }
                            },
                            "text": "'. substr($deskrpsi, 0, 200) . ' ... (Selengkapnya)"
                        },
                        {
                                "type": "button",
                                "icon": {
                                    "type": "chevron_right",
                                    "color": "#FF9800"
                                },
                                "text": "Lihat Detail",
                                "link": "' . $link_detail . '",
                                "event": {
                                    "name": "",
                                    "languageCode": "",
                                    "parameters": {}
                                }
                            }
                        ]
                        ]
                    }
                }
            ]
            }
        ';

        echo $message;

    }

    public function sendRichMessageForWisataList($dataWisata, $text)
    {   
        $message = '';
        $message .= '
            {
            "fulfillmentMessages": [
                {
                        "text": {
                            "text": [
                            "' . $text . '"
                            ]
                        }
                },
                {
                    "payload": {
                        "richContent": [
                        [
                        {
                            "type": "description",
                            "title": "Daftar Objek Wisata di Indramayu",
                            "text": [';
                    
        
        foreach ($dataWisata as $key) {
        
                $message .= '"'.$key['nama_wisata'].'",';
                
        }

        $message .= '                
                            ]
                        },
                        {
                            "type": "description",
                            "title": "",
                            "text": [
                                "Anda bisa bertanya seputar lokasi, harga tiket dan waktu operasional dari tempat wisata diatas, atau dengan mengetikkan nama wisata diatas"
                            ]   
                        }
                        ]
                        ]
                    }
                }
            ]
            }
        ';

        echo $message;

    }

    public function sendRichMessageForLocation($text, $data)
    {
        $mapsLink = "https://www.google.com/maps/embed/v1/place?key=AIzaSyBJongUi8dEP6rjYVB7he5isojyllm-q9o&q=". $data['google_maps'];

        $nama_wisata = $data['nama_wisata'];

        $alamat = $data['alamat'];
        $message = "";
        $message .= '
            {
            "fulfillmentMessages": [
                {
                        "text": {
                            "text": [
                            "' . $text . '"
                            ]
                        }
                },
                {
                    "payload": {
                    "richContent": [
                        [
                            {
                                "type": "info",
                                "title": "'. $nama_wisata .'",
                                "subtitle": "'. $alamat . '"
                            }';
        
        if($data['google_maps'] != null) {
        
            $message .= '
                            ,{
                                "type": "button",
                                "icon": {
                                    "type": "chevron_right",
                                    "color": "#FF9800"
                                },
                                "text": "Lihat Lokasi",
                                "link": "' . $mapsLink . '",
                                "event": {
                                    "name": "",
                                    "languageCode": "",
                                    "parameters": {}
                                }
                            }';
        }
        
        $message .=  '
                        ]
                    ]
                    }
                }
            ]
            }
        ';
        

        echo $message;
    }

}
