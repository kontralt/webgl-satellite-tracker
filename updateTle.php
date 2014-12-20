<?php
    function addData($jsFile, $dataFileName) {
        $data = file($dataFileName);
        $dataLen = count($data);
        for ($i = 0; $i < $dataLen; $i += 3) {
            $satName = trim($data[$i]);
            if ($satName[strlen($satName) - 1] == ']')
                $satName = substr($satName, 0, strlen($satName) - 4);
            fwrite($jsFile, str_replace("\r\n", "", "\t[\"" . $satName  . "\", \"" .  $data[$i + 1] . "\", \"" .  $data[$i + 2] . "\"],\n"));     
        }
    }

    $tleFile = fopen("tle.js", "w");
    fwrite($tleFile, "var tle = [\n");
    addData($tleFile, "http://celestrak.com/NORAD/elements/noaa.txt");
    addData($tleFile, "http://celestrak.com/NORAD/elements/weather.txt");
    addData($tleFile, "http://celestrak.com/NORAD/elements/goes.txt");
    addData($tleFile, "http://celestrak.com/NORAD/elements/resource.txt");
    addData($tleFile, "http://celestrak.com/NORAD/elements/sarsat.txt");
    addData($tleFile, "http://celestrak.com/NORAD/elements/dmc.txt");
    addData($tleFile, "http://celestrak.com/NORAD/elements/tdrss.txt");
    addData($tleFile, "http://celestrak.com/NORAD/elements/geo.txt");
    addData($tleFile, "http://celestrak.com/NORAD/elements/intelsat.txt");
    addData($tleFile, "http://celestrak.com/NORAD/elements/gorizont.txt");
    addData($tleFile, "http://celestrak.com/NORAD/elements/raduga.txt");
    addData($tleFile, "http://celestrak.com/NORAD/elements/molniya.txt");
    addData($tleFile, "http://celestrak.com/NORAD/elements/globalstar.txt");
    addData($tleFile, "http://celestrak.com/NORAD/elements/orbcomm.txt");
    addData($tleFile, "http://celestrak.com/NORAD/elements/iridium.txt");
    addData($tleFile, "http://celestrak.com/NORAD/elements/amateur.txt");
    addData($tleFile, "http://celestrak.com/NORAD/elements/x-comm.txt");
    addData($tleFile, "http://celestrak.com/NORAD/elements/other-comm.txt");
    addData($tleFile, "http://celestrak.com/NORAD/elements/gps-ops.txt");
    addData($tleFile, "http://celestrak.com/NORAD/elements/glo-ops.txt");
    addData($tleFile, "http://celestrak.com/NORAD/elements/galileo.txt");
    addData($tleFile, "http://celestrak.com/NORAD/elements/sbas.txt");
    addData($tleFile, "http://celestrak.com/NORAD/elements/nnss.txt");
    addData($tleFile, "http://celestrak.com/NORAD/elements/musson.txt");
    addData($tleFile, "http://celestrak.com/NORAD/elements/science.txt");
    addData($tleFile, "http://celestrak.com/NORAD/elements/geodetic.txt");
    addData($tleFile, "http://celestrak.com/NORAD/elements/engineering.txt");
    addData($tleFile, "http://celestrak.com/NORAD/elements/education.txt");
    addData($tleFile, "http://celestrak.com/NORAD/elements/military.txt");
    addData($tleFile, "http://celestrak.com/NORAD/elements/cubesat.txt");
    addData($tleFile, "http://celestrak.com/NORAD/elements/radar.txt");
    addData($tleFile, "http://celestrak.com/NORAD/elements/other.txt");
    fseek($tleFile, -2, SEEK_END);
    fwrite($tleFile, "\r\n];");
    fclose($tleFile);
?>