# Functions

1. loadscript helper

# Loadscript Helper
helps to load css and js file in your html template.

`loadStyles` loads css files.
`loadScripts` loads js files.

### How to use
lets take an example of datatable.
first of all, add datatable cdn links in `/rentBlog/Config/Script.php`
```php
<?php
namespace RentBlog\Config;
use CodeIgniter\Config\BaseConfig;

class Script extends BaseConfig
{
    public $style = [
        "datatable" => "https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css",
        "label" => "link"
    ];

    public $script = [
        "datatable" => "https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js",
        "label" => "link"
    ];
}
```

Then you can use them using helper functions by passing label as an argument corresponding to it like,

```php
loadStyles('datatable');
// generates <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

loadScripts('datatable');
// generates <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
```


