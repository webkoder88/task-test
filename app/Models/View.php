<?php


namespace App\Models;


class View
{

    private $layout = 'layout';
    private $title = 'Default title';

    /**
     * @param $template
     * @param array $params
     * @return false|string
     */
    private function fetchPartial($template, $params = array())
    {
        extract($params);
        ob_start();
        include VIEWS_DIR . $template . '.php';
        return ob_get_clean();
    }

    /**
     * @param $template
     * @param array $params
     * @return false|string
     */
    private function fetch($template, $params = array())
    {
        $content = $this->fetchPartial($template, $params);
        return $this->fetchPartial($this->layout, [
            'title' => $this->title,
            'content' => $content
        ]);
    }

    /**
     * @param $layout
     * @return View
     */
    public function layout($layout)
    {
        $this->layout = $layout;
        return $this;
    }

    /**
     * @param $title
     * @return View
     */
    public function title($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param $template
     * @param array $params
     */
    public function render($template, $params = array())
    {
        echo $this->fetch($template, $params);
    }
}