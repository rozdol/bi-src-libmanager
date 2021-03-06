<?php
namespace Rozdol\Router;

use Rozdol\Html\Html;
use Rozdol\Db\Db;
use Rozdol\Data\Data;
use Rozdol\Dates\Dates;
use Rozdol\Utils\Utils;

class project extends Router
{
    private static $hInstance;
    public function __construct(DB $db)
    {
        $this->db=$db;
        $this->utils = Utils::getInstance();
        $this->dates = Dates::getInstance();
        $this->html = Html::getInstance();
        //$this->crypt = Crypt::getInstance();
        $this->data = Data::getInstance($db);
    }
    public static function getInstance($db)
    {
        if (!self::$hInstance) {
            self::$hInstance = new project($db);
        }
        return self::$hInstance;
    }
    
    function sample_function($arg = ''){$f=__FUNCTION__;return include(FW_DIR.'/helpers/f.php');}
    function gen_transactions($args=['year'=>2018, 'qty'=>30]){$f=__FUNCTION__;return include(FW_DIR.'/helpers/f.php');}
    function get_book_descr($id = 1){$f=__FUNCTION__;return include(FW_DIR.'/helpers/f.php');}

    function reuters_import($data=[]){$f=__FUNCTION__;return include(FW_DIR.'/helpers/f.php');}
    function ric_encode($index='',$df='',$dt=''){$f=__FUNCTION__;return include(FW_DIR.'/helpers/f.php');}
    function ric_decode($ric){$f=__FUNCTION__;return include(FW_DIR.'/helpers/f.php');}
    function get_reuters_quote($index='',$df='',$dt=''){$f=__FUNCTION__;return include(FW_DIR.'/helpers/f.php');}
    function update_reuters_quotes($indexes){$f=__FUNCTION__;return include(FW_DIR.'/helpers/f.php');}
    function export_to_xlsx(){$f=__FUNCTION__;return include(FW_DIR.'/helpers/f.php');}



    //replace_placeholder
}
