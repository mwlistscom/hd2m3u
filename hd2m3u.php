<?php
/**
 * @package     hd2m3u
 * @version     1.0
 * @author      John Martin (help@mwlists.com)
 * @copyright   (C) 2001 - 2022 MWLISTS.COM.  All rights reserved.
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0-standalone.html
 * @link        https://rockmym3u.com
 *
 * hd2m3u is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * GetVod is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with GetVod. If not, see http://www.gnu.org/licenses/.
 */

//
//Config
//
$use_duration = false;
$group = "HDHOMERUN"; // add a group name
$ip = "xxx.xxx.xxx.xx"; //your hdhomerun ip

//
// Make it happen
//
$url = "http://$ip/lineup.json?show=unprotected";
$content = file_get_contents($url);
$json = json_decode($content, true);

print("#EXTM3U ");
foreach($json as $i) {
    $channel = $i['GuideNumber'];
    $name    = $i['GuideName'];
    $duration = isset($i['duration']) ? $i['duration']: "0";

    printf('#EXTINF:-1 tvg-chno="%s" channel-id="%s" tvg-id="%s" tvg-name="%s" group-title="%s",%s ',$channel,$channel,$name,$name,$group,$name);
    if ($use_duration){
            print("\nhttp://$ip:5004/auto/v$channel?duration=$duration");
    }else{
            print("\nhttp://$ip:5004/auto/v$channel");
    }
   print "\n";
}
