<?php
/**
 * LICENSE (BSD)
 *
 * Copyright (c) 2012, Gerd Christian Kunze
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are
 * met:
 *
 *  * Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 *
 *  * Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 *
 *  * Neither the name of Gerd Christian Kunze nor the names of the
 *    contributors may be used to endorse or promote products derived from
 *    this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS
 * IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO,
 * THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR
 * PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR
 * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 * EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
 * PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
 * PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
 * LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 * NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * File
 * 30.08.2012 13:37
 */
namespace MOC\Core\Drive;
use \MOC\Api;
/**
 *
 */
class File extends \MOC\Core\Drive\File\Read implements \MOC\Generic\Common\Instance {

	/**
	 * Get Singleton/Instance
	 *
	 * @static
	 * @return File
	 */
	public static function InterfaceInstance() {
		return new File();
	}

	/**
	 * Get Dependencies
	 *
	 * @static
	 * @return \MOC\Core\Depending
	 */
	public static function InterfaceDepending() {
		return Api::Core()->Depending();
	}

	/**
	 * Get Changelog
	 *
	 * @static
	 * @return \MOC\Core\Changelog
	 */
	public static function InterfaceChangelog() {
		return Api::Core()->Changelog()->Create( __CLASS__ )
			->Fix()->DocFix( '19.02.2013 11:05', 'Correct Parameter-Types' )
			->Build()->Clearance( '19.02.2013 11:05', 'Alpha' )
		;
	}

	/**
	 * File-to-Handle
	 *
	 * @param string $Location
	 *
	 * @return \MOC\Core\Drive\File
	 */
	public function Handle( $Location ) {
		$this->Location( $Location );
		$this->UpdateProperties();
		return $this;
	}

	/**
	 * File-Exists
	 *
	 * @return bool
	 */
	public function Exists() {
		if( file_exists( $this->Location() ) ) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * File-Content
	 *
	 * @param array|null|string $Content
	 * @param int  $Type
	 *
	 * @return array|null|string|File
	 */
	public function Content( $Content = null, $Type = self::AS_STRING ) {
		if( $Content !== null ) {
			if( $this->Content !== null ) { $this->Changed( true ); }
			$this->Content = $Content;
			$this->Changed( true );
			return $this;
		} elseif( $this->Content === null ) {
			switch( $Type ) {
				case self::AS_STRING: { $this->ReadAsString(); break; }
				case self::AS_ARRAY: { $this->ReadAsArray(); break; }
				case self::AS_PHP: { $this->ReadAsPhpCode(); break; }
			}
			$this->Changed( false );
			return $this->Content;
		} else {
			return $this->Content;
		}
	}

	/**
	 * File-Hash
	 *
	 * @return null|string
	 */
	public function Hash() {
		return ( file_exists( $this->Location() ) ? sha1_file( $this->Location() ) : sha1( $this->Location() ) );
	}


	/**
	 * FIX: File-Name Special-Chars
	 */

	const FILE_NAME_ENCODING_UTF8 = 'utf-8';

	/**
	 * @param string $Encoding
	 *
	 * @return File
	 */
	public function SetFileNameEncoding( $Encoding = self::FILE_NAME_ENCODING_UTF8 ) {
		// Alles klein schreiben
		//$FileName = mb_strtolower( $this->Name(), $Encoding );
		$FileName = self::MixedToUtf8( $this->Name() );

		// Alle deutschen Umlaute und Sonderfälle austauschen
		$FileName = str_replace(
			array('ä', 'ö', 'ü', 'ß', 'ó', 'è', 'é'),
			array('ae', 'oe', 'ue', 'ss', 'o', 'e', 'e'),
		$FileName );

		// Alle restlichen Leerzeichen zu Bindestrichen
		$FileName = preg_replace( '/\s/s', '-', $FileName );

		// Alles löschen, was nicht alphanumerisch ist
		$FileName = preg_replace('/[^a-z0-9_-]/isU', '', $FileName);

		$FileName = trim($FileName);

		$this->Name( $FileName );

		$this->Location( dirname( $this->Location() ).DIRECTORY_SEPARATOR.$FileName.(strlen($this->Extension())?'.'.$this->Extension():'') );

		return $this;
	}

	private static $DictionaryLatin1ToUtf8 = null;
	private static $DictionaryUtf8ToLatin1 = null;

	private static function BuildDictionary() {
		if( self::$DictionaryUtf8ToLatin1 === null || self::$DictionaryLatin1ToUtf8 === null ) {
			for ($Run = 32; $Run <= 255; $Run++) {
				self::$DictionaryLatin1ToUtf8[chr($Run)] = utf8_encode(chr($Run));
				self::$DictionaryUtf8ToLatin1[utf8_encode(chr($Run))] = chr($Run);
			}
		}
	}

	/**
	 * @param string $Text
	 *
	 * @return string
	 */public static function MixedToLatin1( $Text ) {
		self::BuildDictionary();
		foreach ( self::$DictionaryUtf8ToLatin1 as $Key => $Val) {
			$Text = str_replace( $Key, $Val, $Text );
		}
		return $Text;
	}

	/**
	 * @param string $Text
	 *
	 * @return string
	 */public static function MixedToUtf8( $Text ) {
		self::BuildDictionary();
		return utf8_encode( self::MixedToLatin1( $Text ) );
	}
}
