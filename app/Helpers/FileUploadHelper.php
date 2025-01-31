<?php
if (!function_exists('uploadFile')) {
    /**
     * Helper function to handle file uploads.
     *
     * @param \CodeIgniter\HTTP\UploadedFile $file
     * @param string $uploadPath
     * @return string|false The uploaded file name or false on failure
     */
    function uploadFile($file, $uploadPath = 'uploads') {
        if ($file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            if ($file->move(FCPATH . $uploadPath, $fileName)) {
                return $fileName;
            }
        }
        return false; 
    }
}
