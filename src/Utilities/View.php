<?php
namespace App\Utilities;

/**
* class View - representation of View in MVC logic 
*
*/
class View
{
    /**
    * @var string $_file
    * @var mixed array $date
    * @var string $renderFile
    */
    public $renderFile;
    protected $file;
    protected $date = [];
    
    /**
    * Set date to template
    * @param int $key;
    * @param int|string|bool|array $value
    * 
    * @return void
    */
    public function set($key, $value)
    {
        $this->date[$key] = $value;
    }
    
    /**
    * Get seted date to template
    *
    * @return array
    */
    public function get()
    {
        return $thus->date[$key];
    }

    /**
    * Set main file for rendering
    *
    * @param $setRenderFolder
    * @param $setRenderFile
    *
    * @return void
    */
    public function setRender($setRenderFolder, $setRenderFile)
    {
        $path = HOME . DS . 'src/Views' . DS . $setRenderFolder . DS;
        $filePath = $setRenderFile . '.tpl';

        $this->renderFile = $path . $filePath;
    }

    /**
    * Render date in template
    *
    * @return string
    */
    public function render()
    {
        if (!file_exists($this->renderFile)) {
            throw new \Exception("Missing sub template.");
        }
        extract($this->date);
        ob_start();
        include($this->renderFile);
        $renderOutput = ob_get_contents();
        ob_end_clean();
        return $renderOutput;
    }
    
    /**
    * Set file for rendering
    *
    * @param $setFolder
    * @param $setFile
    *
    * @return void
    */
    public function setFile($setFolder, $setFile)
    {
        $path = HOME . DS . 'src/Views' . DS . $setFolder . DS;
        $fileName =  $setFile . '.tpl';
        $this->file = $path . $fileName;
    }
    
    /**
    * Output rendered file with date
    *
    * @return string
    */
    public function output()
    {
        if (!file_exists($this->file)) {
            throw new \Exception("Missing template.");
        }
        extract($this->date);
        ob_start();
        include($this->file);
        $output = ob_get_contents();
        ob_end_clean();
        echo $output;
    }
}
