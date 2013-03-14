<?php
/**
 * LICENSE (BSD)
 *
 * Copyright (c) 2013, Gerd Christian Kunze
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
 * Directory
 * 13.02.2013 09:07
 */
namespace MOC\Module\Drive;
use MOC\Api;
/**
 *
 */
class Directory implements \MOC\Generic\Device\Module {

	/** @var null|\MOC\Core\Drive\Directory $Resource */
	private $Resource = null;

	/**
	 * Get Singleton/Instance
	 *
	 * @static
	 * @return Directory
	 */
	public static function InterfaceInstance() {
		$Directory = new Directory();
		$Directory->Resource = Api::Core()->Drive()->Directory();
		return $Directory;
	}

	/**
	 * Get Changelog
	 *
	 * @static
	 * @return \MOC\Core\Changelog
	 */
	public static function InterfaceChangelog() {
		return Api::Core()->Changelog()->Create( __CLASS__ )
			->Fix()->DocFix( '19.02.2013 11:05', 'Wrong Parameter-Types' )
		;
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
	 * @param string $Location
	 *
	 * @return Directory
	 */
	public function Open( $Location ) {
		$this->Resource()->Handle( $Location );
		return $this;
	}

	/**
	 * @return null|string
	 */
	public function GetName() {
		return $this->Resource()->Name();
	}

	/**
	 * @return null|string
	 */
	public function GetLocation() {
		return $this->Resource()->Location();
	}

	/**
	 * @return null|string
	 */
	public function GetPath() {
		return $this->Resource()->Path();
	}

	/**
	 * @return int|null
	 */
	public function GetTime() {
		return $this->Resource()->Time();
	}

	/**
	 * @return null|string
	 */
	public function GetHash() {
		return $this->Resource()->Hash();
	}

	/**
	 * @param bool $doRecursive
	 *
	 * @return File[]
	 */
	public function FileList( $doRecursive = false ) {
		if( $doRecursive ) {
			$List = $this->Resource()->FileListRecursive();
			array_walk( $List,
				function ( &$File ) {
					/** @var \MOC\Core\Drive\File $File */
					$File = File::InterfaceInstance()->Open( $File->Location() );
				}
			);
		} else {
			$List = $this->Resource()->FileList();
			array_walk( $List,
				function ( &$File ) {
					/** @var \MOC\Core\Drive\File $File */
					$File = File::InterfaceInstance()->Open( $File->Location() );
				}
			);
		}
		return $List;
	}

	/**
	 * @param bool $doRecursive
	 *
	 * @return Directory[]
	 */
	public function DirectoryList( $doRecursive = false ) {
		if( $doRecursive ) {
			$List = $this->Resource()->DirectoryListRecursive();
			array_walk( $List,
				function ( &$Directory ) {
					/** @var \MOC\Core\Drive\Directory $Directory */
					$Directory = Directory::InterfaceInstance()->Open( $Directory->Location() );
				}
			);
		} else {
			$List = $this->Resource()->DirectoryList();
			array_walk( $List,
				function ( &$Directory ) {
					/** @var \MOC\Core\Drive\Directory $Directory */
					$Directory = Directory::InterfaceInstance()->Open( $Directory->Location() );
				}
			);
		}
		return $List;
	}

	/**
	 * @return \MOC\Core\Drive\Directory|null
	 */
	private function Resource() {
		return $this->Resource;
	}
}
