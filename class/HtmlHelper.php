<?php


class HtmlHelper
{
    /**
     * @param $name
     * @param array $items
     * @param array $options
     * @return string
     */
    public static function selectList($name, array $items, array $options)
    {
        $str = '<select class="' . (isset($options['class']) ? $options['class'] : '') . '" name="' . $name . '">' . PHP_EOL;
        if (isset($options['prompt'])) {
            $str .= '<option value="">' . $options['prompt'] . '</option>' . PHP_EOL;
        }
        foreach ($items as $id => $value) {
            $str .= '<option value="' . $id . '">' . $value . '</option>' . PHP_EOL;
        }
        return $str . '</select>' . PHP_EOL;
    }
}