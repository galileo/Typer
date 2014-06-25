<?php

namespace Galileo\BootstrapBundle\Twig;

use Twig_Function_Method;

class PanelTwigExtension extends \Twig_Extension
{

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        $options = array('pre_escape' => 'html', 'is_safe' => array('html'));

        return array(
            'panel' => new Twig_Function_Method($this, 'labelFunction', $options),
        );
    }

    /**
     *
     * @param $title
     * @param $content
     * @param null $options
     *
     * @return string The HTML code of the label
     */
    public function labelFunction($title, $content, $options = null)
    {
        $template = <<<PANEL
<div class="panel panel-default">
    <div class="panel-heading">%s</div>
    %s
</div>
PANEL;
        $content = $this->processContent($content, $options);

        return sprintf($template, $title, $content);
    }

    /**
     * @param string $text
     *
     * @return string
     */
    public function labelPrimaryFunction($text)
    {
        return $this->labelFunction($text, 'primary');
    }

    /**
     * Returns the HTML code for a success label.
     *
     * @param string $text The text of the label
     *
     * @return string The HTML code of the label
     */
    public function labelSuccessFunction($text)
    {
        return $this->labelFunction($text, 'success');
    }

    /**
     * Returns the HTML code for a warning label.
     *
     * @param string $text The text of the label
     *
     * @return string The HTML code of the label
     */
    public function labelWarningFunction($text)
    {
        return $this->labelFunction($text, 'warning');
    }

    /**
     * Returns the HTML code for a important label.
     *
     * @param string $text The text of the label
     *
     * @return string The HTML code of the label
     */
    public function labelDangerFunction($text)
    {
        return $this->labelFunction($text, 'danger');
    }

    /**
     * Returns the HTML code for a info label.
     *
     * @param string $text The text of the label
     *
     * @return string The HTML code of the label
     */
    public function labelInfoFunction($text)
    {
        return $this->labelFunction($text, 'info');
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'galileo_bootstrap_panel';
    }

    protected function processContent($content, $options)
    {
        if ($this->optionsAreCorrect($options)) {
            if (array_key_exists('skipBody', $options) && $options['skipBody']) {
                return $content;
            }
        }

        $content = sprintf('<div class="panel-body">%s</div>', $content);

        return $content;
    }

    protected function optionsAreCorrect($options)
    {
        if (is_array($options)) {
            return true;
        }

        return false;
    }
}
