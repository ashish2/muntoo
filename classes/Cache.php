<?php

// include "../functions/func.php";

// Simple Cache Class
// Defining class Cache
// The class has been made, considering only arrays are coming in to
// be written to a cache file
// hasn't been tested for strings
// Also, by default json_encoding & decoding is happening,
// not in all cases you will need json encode & decoding
class Cache
{
	
	// Defining config for Cache class
	// Folder for cache files
	var $folder = "dumps/cache/";
	
	// 600 seconds
	var $timeGap = 600;
	
	// Cache file Extension
	var $ext = ".cache";
	
	// Caache file name
	var $cacheFile = null;
	
	// Contents of the Cache file
	var $contents = null;
	
	// Takes the MD5 hash of the query string
	// and makes a filename with that string
	// prepending folder name and appending file extension
	function __construct($fileName)
	{
		// Preparing filename
		$this->cacheFile = $this->folder.$fileName.$this->ext;
	}
	
	// Will take md5 hash of an sql query & 
	// check in cacheFolder if that file exists
	function fileExists()
	{
		return file_exists($this->cacheFile);
	}
	
	// Will say whether file is valid
	// by checking the timeGap
	function fileValid()
	{
		// if exists but filemtime not suffice then unlink file
		$mtime = filemtime( $this->cacheFile);
		
		if ( ( time() - $this->timeGap ) < $mtime )
			return true;
		else
		{
			unlink( $this->cacheFile );
			return false;
		}
		
	}
	
	// Take output buffer &
	// write into a file
	// of md5 hash of the query
	function writeFile($contentToWrite)
	{
		$contentToWrite = json_encode($contentToWrite);
		// Open and write a file
		openAndWriteInFile($this->cacheFile, $contentToWrite, "wb");
		//return $this;
	}
	
	// Getting contents of cache file, & setting it to a variable
	function getContents()
	{
		$this->contents = file_get_contents( $this->cacheFile );
		
		// return json object as associative array as second parameter set to true
		$this->contents = json_decode( $this->contents, true );
		
		// Cant return $this if i am not setting it in a class variable(property)
		// instead return the content
		return $this;
	}
	
	// Executing the cache procedures
	// Either will return null , if no file exists & nothing in cache
	// Else, will return the content
	// Execute procedure
	function exProcGet()
	{
		
		if ( $this->fileExists() && $this->fileValid())
		{
			$this->getContents();
			return $this;
		}
		// else does not exists and not valid so return Null
		return Null;
		
	}
	
	// Else write content, as file does not exists as return by function exProc1()
	function exProcWrite($contentToWrite)
	{
		// File exists but not Valid, then write a new file.
		// Write the file
		$this->writeFile($contentToWrite);
		// So again content will be null, as 
		// rite now, we have only written the file
		//return $this;
		return Null;
	}
	
	
}



?>
