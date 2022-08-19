<?php

namespace App\Libraries;

class Breadcrumb
{
    private string $heading;
    private array $crumb;
    private string $template = '<!-- Heading -->
                                <div class="p-5 bg-light mb-4">
                                    <h1 class="">{{HEADING}}</h1>
                                    <!-- Breadcrumb -->
                                    <nav class="d-flex">
                                    <h6 class="mb-0">
                                        {{CRUMBS}}
                                    </h6>
                                    </nav>
                                    <!-- Breadcrumb -->
                                </div>
                                <!-- Heading -->';

    public function __construct(string $heading="Dashboard", array $crumb=null ) 
    {
        $this->heading = $heading;
        $this->crumb   = $crumb ?? [];
    }

    public function add(string $name, string $link)
    {
        $this->crumb[$name] = $link;
    }

    public function addHeading($heading)
    {
        $this->heading = $heading;
    }

    public function render()
    {
        $crumbs = '';
        $last = array_key_last($this->crumb);
        foreach($this->crumb as $key=> $link) {
            $crumbs .= '<a href="'.base_url($link).'" class="text-reset">'.$key.'</a>';
            if($key != $last) {
                $crumbs .= '<span> / </span>';
            }
        }
        
        $this->template = str_replace('{{HEADING}}', $this->heading, $this->template);
        $this->template = str_replace('{{CRUMBS}}', $crumbs, $this->template);
        echo $this->template;
    }

}
/* Breadcrumb */