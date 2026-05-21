function getCoordinates(address) {

    $url = "https://nominatim.openstreetmap.org/search?format=json&q=" . urlencode(address);

    $opts = [
        "http" => [
            "header" => "User-Agent: MonSite/1.0\r\n"
        ]
    ];

    $context = stream_context_create($opts);

    $response = file_get_contents($url, false, $context);

    $data = json_decode($response, true);

    if (!empty($data)) {
        return [
            'lat' => $data[0]['lat'],
            'lng' => $data[0]['lon']
        ];
    }

    return null;
}
