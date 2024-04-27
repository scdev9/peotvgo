<?php

// Simulated channel database with categories and images
$channels = [
    [
        'name' => 'SirasaTV',
        'category' => 'News',
        'image' => '',
        'stream_url' => 'http://edge2-moblive.yuppcdn.net/transsd/smil:sirtv09.smil/playlist.m3u8'
        
    ],
    [
        'name' => 'Channel 2',
        'category' => 'Entertainment',
        'image' => 'https://example.com/images/channel2.jpg',
        'stream_url' => 'http://example.com/channel2/stream.m3u8'
    ],
    [
        'name' => 'Channel 3',
        'category' => 'Sports',
        'image' => 'https://example.com/images/channel3.jpg',
        'stream_url' => 'http://example.com/channel3/stream.m3u8'
    ],
    // Add more channels with categories and images as needed
];

// Group channels by category
$channelsByCategory = [];
foreach ($channels as $channel) {
    $category = $channel['category'];
    if (!isset($channelsByCategory[$category])) {
        $channelsByCategory[$category] = [];
    }
    $channelsByCategory[$category][] = $channel;
}

// Output channels as M3U playlist format
header('Content-Type: audio/mpegurl');
header('Content-Disposition: attachment; filename="ott_channels.m3u"');

foreach ($channelsByCategory as $category => $channels) {
    echo "#EXTGRP:{$category}\n";
    foreach ($channels as $channel) {
        echo "#EXTINF:-1 tvg-logo=\"{$channel['image']}\",{$channel['name']}\n";
        echo "{$channel['stream_url']}\n";
    }
}
