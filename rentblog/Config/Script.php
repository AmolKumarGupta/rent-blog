<?php
namespace RentBlog\Config;

use CodeIgniter\Config\BaseConfig;

class Script extends BaseConfig
{

    public $style = [
        "datatable" => "https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"
    ];

    public $script = [
        "datatable" => "https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"
    ];
}