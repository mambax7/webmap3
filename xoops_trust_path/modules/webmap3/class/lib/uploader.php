<?php
// $Id: uploader.php,v 1.1.1.1 2012/03/17 09:28:15 ohwada Exp $

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
//=========================================================

if (!defined('XOOPS_TRUST_PATH')) {
    die('not permit');
}

//=========================================================
// class webmap3_lib_uploader
// base on myalbum's myuploader.php
//=========================================================

// myuploader.php,v 1.12+
// Security & Bug fixed version of class XoopsMediaUploader by GIJOE

/*!
Example

  include_once 'myuploader.php';
  $allowed_mimetypes = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/x-png');
  $maxfilesize = 50000;
  $maxfilewidth = 120;
  $maxfileheight = 120;
  $uploader = new XoopsMediaUploader('/home/xoops/uploads', $allowed_mimetypes, $maxfilesize, $maxfilewidth, $maxfileheight, $allowed_exts);
  if ($uploader->fetchMedia($_POST['uploade_file_name'])) {
    if (!$uploader->upload()) {
       echo $uploader->getErrors();
    } else {
       echo '<h4>File uploaded successfully!</h4>'
       echo 'Saved as: ' . $uploader->getSavedFileName() . '<br />';
       echo 'Full path: ' . $uploader->getSavedDestination();
    }
  } else {
    echo $uploader->getErrors();
  }

*/

class webmap3_lib_uploader
{
    public $mediaName;
    public $mediaType;
    public $mediaSize;
    public $mediaTmpName;
    public $mediaError;

    // set param
    public $uploadDir         = '';
    public $allowedMimeTypes  = array();
    public $allowedExtensions = array();
    public $maxFileSize       = 0;
    public $maxWidth          = 0;
    public $maxHeight         = 0;

    public $targetFileName;
    public $prefix;

    // result
    public $savedDestination = null;
    public $savedFileName    = null;
    public $mediaWidth       = 0;
    public $mediaHeight      = 0;

    // error
    public $errors     = array();
    public $errorCodes = array();

    public $errorMsgs = array(
        1  => 'Uploaded File not found',
        2  => 'Invalid File Size',
        3  => 'Filename Is Empty',
        4  => 'No file uploaded',
        5  => 'Upload directory not set',
        6  => 'Extension not allowed',
        7  => 'Error occurred: Error #', // mediaError
        8  => 'Failed opening directory: ', // uploadDir
        9  => 'Failed opening directory with write permission: ', // uploadDir
        10 => 'MIME type not allowed: ', // mediaType
        11 => 'File size too large: ', // mediaSize
        12 => 'File width must be smaller than ', // maxWidth
        13 => 'File height must be smaller than ', // maxHeight
        14 => 'Failed uploading file: ', // mediaName
    );

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    /**
     * Constructor
     *
     * @param   string $uploadDir
     * @param   array  $allowedMimeTypes
     * @param   int    $maxFileSize
     * @param   int    $maxWidth
     * @param   int    $maxHeight
     * @param   int    $cmodvalue
     * @param   array  $allowedExtensions
     **/
    public function __construct()
    {
        // dummy
    }

    public static function getInstance()
    {
        static $instance;
        if (!isset($instance)) {
            $instance = new webmap3_lib_uploader();
        }
        return $instance;
    }

    //  function MyXoopsMediaUploader($uploadDir, $allowedMimeTypes, $maxFileSize, $maxWidth=null, $maxHeight=null, $allowedExtensions=null )
    //  {
    //      if (is_array($allowedMimeTypes)) {
    //          $this->allowedMimeTypes = $allowedMimeTypes;
    //      }
    //      $this->uploadDir = $uploadDir;
    //      $this->maxFileSize = intval($maxFileSize);
    //      if(isset($maxWidth)) {
    //          $this->maxWidth = intval($maxWidth);
    //      }
    //      if(isset($maxHeight)) {
    //          $this->maxHeight = intval($maxHeight);
    //      }
    //      if( isset( $allowedExtensions ) && is_array( $allowedExtensions ) ) {
    //          $this->allowedExtensions = $allowedExtensions ;
    //      }
    //  }

    //---------------------------------------------------------
    // functions
    //---------------------------------------------------------
    public function setUploadDir($uploadDir)
    {
        $this->uploadDir = $uploadDir;
    }

    public function setMaxFileSize($maxFileSize)
    {
        $this->maxFileSize = (int)$maxFileSize;
    }

    public function setMaxWidth($maxWidth)
    {
        $this->maxWidth = (int)$maxWidth;
    }

    public function setMaxHeight($maxHeight)
    {
        $this->maxHeight = (int)$maxHeight;
    }

    public function setAllowedMimeTypes($allowedMimeTypes)
    {
        if (isset($allowedMimeTypes) && is_array($allowedMimeTypes)) {
            $this->allowedMimeTypes = $allowedMimeTypes;
        }
    }

    public function setAllowedExtensions($allowedExtensions)
    {
        if (isset($allowedExtensions) && is_array($allowedExtensions)) {
            $this->allowedExtensions = $allowedExtensions;
        }
    }

    /**
     * Fetch the uploaded file
     *
     * @param   string $media_name Name of the file field
     * @param   int    $index      Index of the file (if more than one uploaded under that name)
     * @return  bool
     **/
    public function fetchMedia($media_name, $index = null)
    {
        // clear error
        $this->errors     = array();
        $this->errorCodes = array();

        if (!isset($_FILES[$media_name])) {
            $this->setErrorCodes(1);
            return false;
        } elseif (is_array($_FILES[$media_name]['name']) && isset($index)) {
            $index              = (int)$index;
            $this->mediaName    = $_FILES[$media_name]['name'][$index];
            $this->mediaType    = $_FILES[$media_name]['type'][$index];
            $this->mediaSize    = $_FILES[$media_name]['size'][$index];
            $this->mediaTmpName = $_FILES[$media_name]['tmp_name'][$index];
            $this->mediaError   = !empty($_FILES[$media_name]['error'][$index]) ? $_FILES[$media_name]['errir'][$index] : 0;
        } else {
            $media_name         = $_FILES[$media_name];
            $this->mediaName    = $media_name['name'];
            $this->mediaType    = $media_name['type'];
            $this->mediaSize    = $media_name['size'];
            $this->mediaTmpName = $media_name['tmp_name'];
            $this->mediaError   = !empty($media_name['error']) ? $media_name['error'] : 0;
        }

        if ((int)$this->mediaSize < 0) {
            $this->setErrorCodes(2);
            return false;
        }

        if ($this->mediaName == '') {
            $this->setErrorCodes(3);
            return false;
        }

        if ($this->mediaError > 0) {
            $this->setErrorCodes(7, $this->mediaError);
            return false;
        }

        if ($this->mediaTmpName == 'none' || !is_uploaded_file($this->mediaTmpName) || $this->mediaSize == 0) {
            $this->setErrorCodes(4);
            return false;
        }

        return true;
    }

    /**
     * Set the target filename
     *
     * @param   string $value
     **/
    public function setTargetFileName($value)
    {
        $this->targetFileName = (string)trim($value);
    }

    /**
     * Set the prefix
     *
     * @param   string $value
     **/
    public function setPrefix($value)
    {
        $this->prefix = (string)trim($value);
    }

    /**
     * Get the uploaded filename
     *
     * @return  string
     **/
    public function getMediaName()
    {
        return $this->mediaName;
    }

    /**
     * Get the type of the uploaded file
     *
     * @return  string
     **/
    public function getMediaType()
    {
        return $this->mediaType;
    }

    /**
     * Get the size of the uploaded file
     *
     * @return  int
     **/
    public function getMediaSize()
    {
        return $this->mediaSize;
    }

    /**
     * Get the temporary name that the uploaded file was stored under
     *
     * @return  string
     **/
    public function getMediaTmpName()
    {
        return $this->mediaTmpName;
    }

    /**
     * Get the saved filename
     *
     * @return  string
     **/
    public function getSavedFileName()
    {
        return $this->savedFileName;
    }

    /**
     * Get the destination the file is saved to
     *
     * @return  string
     **/
    public function getSavedDestination()
    {
        return $this->savedDestination;
    }

    public function getMediaError()
    {
        return $this->mediaError;
    }

    public function getUploadDir()
    {
        return $this->uploadDir;
    }

    public function getMaxWidth()
    {
        return $this->maxWidth;
    }

    public function getMaxHeight()
    {
        return $this->maxHeight;
    }

    public function getMediaWidth()
    {
        return $this->mediaWidth;
    }

    public function getMediaHeight()
    {
        return $this->mediaHeight;
    }

    public function isReadableSavedDestination()
    {
        $file = $this->savedDestination;
        if ($file && is_readable($file)) {
            return true;
        }
        return false;
    }

    public function unlinkSavedDestination()
    {
        $file = $this->savedDestination;
        if ($file && is_file($file)) {
            unlink($file);
        }
        return false;
    }

    /**
     * Check the file and copy it to the destination
     *
     * @return  bool
     **/
    public function upload($chmod = 0644)
    {
        if ($this->uploadDir == '') {
            $this->setErrorCodes(5);
            return false;
        }

        if (!is_dir($this->uploadDir)) {
            $this->setErrorCodes(8, $this->uploadDir);
            return false;
        }

        if (!is_writable($this->uploadDir)) {
            $this->setErrorCodes(9, $this->uploadDir);
            return false;
        }

        if (!$this->checkMimeType()) {
            $this->setErrorCodes(10, $this->mediaType);
            return false;
        }

        if (!$this->checkExtension()) {
            $this->setErrorCodes(6);
            return false;
        }

        if (!$this->checkMaxFileSize()) {
            $this->setErrorCodes(11, $this->mediaSize);
        }

        if (!$this->checkMaxWidth()) {
            $this->setErrorCodes(12, $this->maxWidth);
        }

        if (!$this->checkMaxHeight()) {
            $this->setErrorCodes(13, $this->maxHeight);
        }

        if (count($this->errors) > 0) {
            return false;
        }

        if (!$this->_copyFile($chmod)) {
            $this->unlinkSavedDestination();
            $this->setErrorCodes(14, $this->mediaName);
            return false;
        }

        if (!$this->isReadableSavedDestination()) {
            $this->unlinkSavedDestination();
            $this->setErrorCodes(14, $this->mediaName);
            return false;
        }

        return true;
    }

    /**
     * Copy the file to its destination
     *
     * @return  bool
     **/
    public function _copyFile($chmod)
    {
        $matched = array();
        if (!preg_match("/\.([a-zA-Z0-9]+)$/", $this->mediaName, $matched)) {
            return false;
        }
        if (isset($this->targetFileName)) {
            $this->savedFileName = $this->targetFileName;
        } elseif (isset($this->prefix)) {
            $this->savedFileName = uniqid($this->prefix) . '.' . strtolower($matched[1]);
        } else {
            $this->savedFileName = strtolower($this->mediaName);
        }
        $this->savedDestination = $this->uploadDir . '/' . $this->savedFileName;
        if (!move_uploaded_file($this->mediaTmpName, $this->savedDestination)) {
            return false;
        }
        @chmod($this->savedDestination, $chmod);
        return true;
    }

    /**
     * Is the file the right size?
     *
     * @return  bool
     **/
    public function checkMaxFileSize()
    {
        if ($this->maxFileSize == 0) {
            return true;    // no check
        }
        if ($this->mediaSize > $this->maxFileSize) {
            return false;
        }
        return true;
    }

    /**
     * Is the picture the right width?
     *
     * @return  bool
     **/
    public function checkMaxWidth()
    {
        if ($this->maxWidth == 0) {
            return true;    // no check
        }

        if (false !== $dimension = getimagesize($this->mediaTmpName)) {
            $this->mediaWidth = $dimension[0];

            if ($this->mediaWidth > $this->maxWidth) {
                return false;
            }
        } else {
            trigger_error(sprintf('Failed fetching image size of %s, skipping max width check..', $this->mediaTmpName), E_USER_WARNING);
        }
        return true;
    }

    /**
     * Is the picture the right height?
     *
     * @return  bool
     **/
    public function checkMaxHeight()
    {
        if ($this->maxHeight == 0) {
            return true;    // no check
        }

        if (false !== $dimension = getimagesize($this->mediaTmpName)) {
            $dimension         = @getimagesize($this->mediaTmpName);
            $this->mediaHeight = $dimension[1];

            if ($this->mediaHeight > $this->maxHeight) {
                return false;
            }
        } else {
            trigger_error(sprintf('Failed fetching image size of %s, skipping max height check..', $this->mediaTmpName), E_USER_WARNING);
        }
        return true;
    }

    /**
     * Is the file the right Mime type
     *
     * (is there a right type of mime? ;-)
     *
     * @return  bool
     **/
    public function checkMimeType()
    {
        if (count($this->allowedMimeTypes) > 0 && !in_array($this->mediaType, $this->allowedMimeTypes)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Is the file the right extension
     *
     * @return  bool
     **/
    public function checkExtension()
    {
        $ext = substr(strrchr($this->mediaName, '.'), 1);
        if (!empty($this->allowedExtensions) && !in_array(strtolower($ext), $this->allowedExtensions)) {
            return false;
        } else {
            return true;
        }
    }

    public function setErrorCodes($code, $msg = null)
    {
        $this->setErrors($this->errorMsgs[$code] . $msg);
        $this->errorCodes[] = $code;
    }

    public function getErrorCodes()
    {
        return $this->errorCodes;
    }

    /**
     * Add an error
     *
     * @param   string $error
     **/
    public function setErrors($error)
    {
        $this->errors[] = trim($error);
    }

    /**
     * Get generated errors
     *
     * @param   bool $ashtml Format using HTML?
     *
     * @return  array|string    Array of array messages OR HTML string
     */
    public function &getErrors($ashtml = true)
    {
        if (!$ashtml) {
            return $this->errors;
        } else {
            $ret = '';
            if (count($this->errors) > 0) {
                $ret = '<h4>Errors Returned While Uploading</h4>';
                foreach ($this->errors as $error) {
                    $ret .= $error . '<br />';
                }
            }
            return $ret;
        }
    }

    // --- class end ---
}
