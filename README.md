# TorrentAPI-PHP
Simple PHP wrapper for RARBG's torrentapi

## Installation
```
composer require rhnorskov/torrentapi-php
```

## How to use
Create a new instance of the TorrentAPI and fill in the application name. On the new instance run the query function, and pass an array of parameters.
```
$torrentAPI = new TorrentAPI('APPLICATION_NAME");

$popularMovies = $torrentAPI->query([
    "mode" => "list",
    "sort" => "leechers",
    "category" => "44;45",
]);
```

## Parameters
Option | Value | Default | Description
------ | ---- | ------- | -----------
mode | `"list"` or `"search"` | `"list"` | Query mode
search_string | e.g. `"The Shawshank Redemption"` | `null` | Any search string
search_imdb | e.g. `"tt0111161"` | `null` | Any imdb id
search_tvdb | e.g. `"81189"` | `null` | Any tvdb id
search_themoviedb | e.g. `"293660"` | `null` | Any themoviedb id
category | `"tv"`, `"movie"` or `"44;45"` | unfiltered | Filter by category. The two constants tv or movie or any combination of rarbg.com category numbers. 
limit | `25`, `50` or `100` | `25` | Limit results
sort | `"last"`, `"seeders"` or `"leechers"` | `"last"` | Order results by
min_seeders | any positive integer | `0` | Only include torrents with seeders above specified number
min_leechers | any positive integer | `0` | Only include torrents with leechers above specified number
format | `"json"` or `"json_extended"` | `json` | Use `"json_extended"` for more info
ranked | `0` or `1` | `1` | Include only scene releases + -rarbg releases + -rartv releases. For other groups set to `0`.
