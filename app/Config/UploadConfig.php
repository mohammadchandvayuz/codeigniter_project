<?php
namespace Config;

use CodeIgniter\Config\BaseConfig;

class UploadConfig extends BaseConfig
{
    public $maxSize = 1024; // Max file size in kilobytes
    public $allowedTypes = 'image/jpg,image/jpeg,image/png'; // Allowed MIME types
    public $uploadPath = WRITEPATH . 'uploads/';
}
