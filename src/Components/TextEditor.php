<?php

namespace JeroenNoten\LaravelAdminLte\Components;

class TextEditor extends InputGroupComponent
{
    /**
     * The Summernote plugin configuration parameters. Array with key => value
     * pairs, where the key should be an existing configuration property of
     * the plugin.
     *
     * @var array
     */
    public $config;

    /**
     * Create a new component instance.
     * Note this component requires the 'Summernote' plugin.
     * TODO: the append/prepend addon slots are not supported.
     *
     * @return void
     */
    public function __construct(
        $name, $label = null, $size = null, $labelClass = null,
        $topClass = null, $inputGroupClass = null, $disableFeedback = null,
        $config = []
    ) {
        parent::__construct(
            $name, $label, $size, $labelClass, $topClass,
            $inputGroupClass, $disableFeedback
        );

        $this->config = is_array($config) ? $config : [];

        // Setup the default plugin width option.

        $this->config['width'] = $this->config['width'] ?? 'inherit';
    }

    /**
     * Make the class attribute for the "input-group" element. Note we overwrite
     * the method of the parent class.
     *
     * @param string $invalid
     * @return string
     */
    public function makeInputGroupClass($invalid = null)
    {
        $classes = ['input-group'];

        if (isset($this->size) && in_array($this->size, ['sm', 'lg'])) {
            $classes[] = "input-group-{$this->size}";
        }

        if (! empty($invalid) && ! isset($this->disableFeedback)) {
            $classes[] = 'adminlte-invalid-itegroup';
        }

        if (isset($this->inputGroupClass)) {
            $classes[] = $this->inputGroupClass;
        }

        return implode(' ', $classes);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('adminlte::components.text-editor');
    }
}
