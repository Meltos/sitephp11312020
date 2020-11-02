<?php
namespace Lid;

class Content
{
    public $dir_list;
    public $file_list;
    public $content_dir;
    public $page_header;
    public $page_content;

    public function __construct ($path)
    {
        $this->content_dir = $path;
    }

    public function getDirList($path)
    {
        foreach(glob($path . '/*')as $dir)
        {
            if (is_dir($dir))
            {
                $this->dir_list[] = basename($dir);
            }
        }
        return $this->dir_list;
    }

    public function getFileList($path)
    {
        foreach(glob($path . '/*')as $dir)
        {
            if (is_file($dir))
            {
                $this->file_list[] = basename($dir, ".php");
            }
        }
        return $this->file_list;
    }

    public function getFileListSuffix($path)
    {
        foreach(glob($path . '/*')as $dir)
        {
            if (is_file($dir))
            {
                $this->file_list[] = basename($dir);
            }
        }
//        $skip = array('.', '..');//пропускаем точки
//        $files = scandir($path);
//        //$this->dbg ($path);
//        foreach($files as $file) {
//            if(!in_array($file, $skip)) {
//                //echo $file . '<br />';
//                $this->file_list[] = basename($file);
//            }
//
//        }
        return $this->file_list;
    }

    public function getNoExtraFile($filelist)
    {
        unset($filelist[3]);
        unset($filelist[2]);
        unset($filelist[1]);
        unset($filelist[0]);
        return $filelist;
    }

    public function ParseContent($path)
    {
        return explode('===', file_get_contents($path));
    }

    public function GetContent($path)
    {
        $content_list = $this->ParseContent($path);
        $this->page_header = $content_list[0];
        $this->page_content = $content_list[1];
    }
}