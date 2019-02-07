<?php

namespace App;


class App
{
    public function run($params)
    {

        $withoutHttp = str_replace(['http://', 'www.'], '', $params['url']);

        $len = strlen($withoutHttp);
        if (substr($withoutHttp, 0, $len - 1) === '/') {
            $withoutHttp = substr($withoutHttp, 0, $len - 1);
        }

        $cx = new \PDO('sqlite::memory:'); //dev
        // $cx = new PDO('mysql:host=sql-distant.mydbonline.com;dbname=googlekiller', 'monlogin', 'monmotdepasse'); // prod

        /* il faut commenter tout ça si on est en prod */
        $create = $cx->prepare('CREATE TABLE urls (url text PRIMARY KEY )');
        $create->execute();
        /* fin creation table en dev */

        mail('moi@googlekiller.com', 'nouvelle url dans le moteur', 'ajout de '.$withoutHttp.' !!!!');

        $prepare = $cx->prepare('INSERT INTO urls (url) VALUES (?)');
        $prepare->execute([$withoutHttp]);

        $listing = $cx->prepare('SELECT url FROM urls');
        $listing->execute();
        return $listing->fetchAll(\PDO::FETCH_ASSOC);
    }
}