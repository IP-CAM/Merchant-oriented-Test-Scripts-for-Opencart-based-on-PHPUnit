<?php
namespace library;

class fql
{
    public function read($sql_filename="")
    {
        $sql = "";

        $file = __OCUNIT_ROOT__."/sql/".basename($sql_filename);
        if(is_file($file))
        {
            $sql = file_get_contents($file);
            $sql = str_replace("oc_", DB_PREFIX, $sql);
        }

        return $sql;
    }
}